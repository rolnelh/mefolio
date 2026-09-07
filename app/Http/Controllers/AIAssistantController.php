<?php

namespace App\Http\Controllers;

use Anthropic\Client;
use Anthropic\Core\Exceptions\APIStatusException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AIAssistantController extends Controller
{
    /**
     * Nombre maximum de messages d'historique renvoyés par le client
     * qui sont réellement pris en compte, pour limiter le coût par requête.
     */
    private const MAX_HISTORY = 12;

    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'history' => ['sometimes', 'array'],
            'history.*.role' => ['required_with:history', 'string', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string', 'max:2000'],
        ]);

        $apiKey = config('services.anthropic.api_key');

        if (empty($apiKey)) {
            return response()->json([
                'error' => 'not_configured',
                'message' => "L'assistant IA n'est pas encore configuré sur ce site. Revenez bientôt.",
            ], 503);
        }

        $user = Auth::user();
        $creatif = $user->creatif;

        $system = $this->buildSystemPrompt($user, $creatif);

        $history = collect($validated['history'] ?? [])
            ->slice(-self::MAX_HISTORY)
            ->map(fn ($m) => ['role' => $m['role'], 'content' => $m['content']])
            ->values()
            ->all();

        $messages = array_merge($history, [
            ['role' => 'user', 'content' => $validated['message']],
        ]);

        try {
            $client = new Client(apiKey: $apiKey);

            $response = $client->messages->create(
                model: 'claude-opus-5',
                maxTokens: 1024,
                system: $system,
                outputConfig: ['effort' => 'low'],
                messages: $messages,
            );

            $reply = '';
            foreach ($response->content as $block) {
                if ($block->type === 'text') {
                    $reply .= $block->text;
                }
            }

            if ($reply === '') {
                $reply = "Je n'ai pas pu formuler de réponse. Reformulez votre question ?";
            }

            return response()->json(['reply' => $reply]);
        } catch (APIStatusException $e) {
            Log::warning('Erreur assistant IA (Anthropic): ' . $e->getMessage());

            return response()->json([
                'error' => 'api_error',
                'message' => "L'assistant IA est momentanément indisponible. Réessayez dans un instant.",
            ], 502);
        } catch (\Throwable $e) {
            Log::error('Erreur inattendue assistant IA: ' . $e->getMessage());

            return response()->json([
                'error' => 'unknown',
                'message' => "Une erreur inattendue est survenue. Réessayez.",
            ], 500);
        }
    }

    private function buildSystemPrompt($user, $creatif): string
    {
        $profil = "Aucun profil créatif créé pour l'instant.";

        if ($creatif) {
            $champs = [
                'Prénom' => $creatif->prenom,
                'Nom' => $creatif->nom,
                'Spécialité' => $creatif->specialite,
                'Localisation' => $creatif->localisation,
                'Bio actuelle' => $creatif->bio,
                'Portfolio' => $creatif->portfolio_url,
                'Disponible pour missions' => $creatif->available_for_work ? 'Oui' : 'Non',
                'Score Builder' => $creatif->builder_score,
                'Nombre de projets publiés' => $creatif->projects()->count(),
            ];

            $profil = collect($champs)
                ->map(fn ($valeur, $label) => "- {$label} : " . ($valeur !== null && $valeur !== '' ? $valeur : 'non renseigné'))
                ->implode("\n");
        }

        return <<<SYSTEM
Tu es l'assistant IA de Mefolio, une plateforme portfolio et marketplace pour les créatifs africains (designers, développeurs, photographes, vidéastes, etc.).

Ton rôle : aider {$user->username} à peaufiner son profil créatif Mefolio pour qu'il attire davantage de clients et de missions. Tu peux : proposer une bio plus percutante, suggérer une formulation de spécialité, conseiller sur la présentation du portfolio, indiquer quels champs manquants remplir en priorité, et donner des conseils concrets et actionnables.

Voici l'état actuel de son profil :
{$profil}

Consignes :
- Réponds toujours en français, de façon chaleureuse mais concise (quelques phrases ou une courte liste, pas de pavé).
- N'utilise jamais d'emoji.
- Si on te demande de rédiger une bio ou un texte, propose directement une version prête à copier-coller, adaptée au secteur créatif africain.
- Reste concentré sur le profil Mefolio (bio, spécialité, portfolio, disponibilité). Si la question sort de ce cadre, réponds brièvement puis recentre la conversation.
- Ne prétends jamais avoir modifié le profil toi-même : tu ne fais que proposer, l'utilisateur applique les changements lui-même dans le formulaire d'édition.
SYSTEM;
    }
}

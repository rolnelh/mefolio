<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Services\BuilderScoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Gère les commentaires (et leurs réponses, réservées à l'auteur du
 * projet) affichés sur la page projet — voir resources/views/comment.blade.php.
 *
 * store() sert les deux modes de soumission du formulaire : en AJAX (le cas
 * normal, voir mefolioComments() dans comment.blade.php — aucun rechargement
 * de page), détecté via $request->wantsJson(), et en repli classique
 * (formulaire HTML natif, POST + redirection) si JavaScript est
 * indisponible. update()/destroy() sont eux exclusivement AJAX : ce sont
 * des actions nouvelles, sans équivalent avant ce changement, donc sans
 * repli à préserver.
 */
class CommentController extends Controller
{
    public function store(Request $request, Project $project, BuilderScoreService $scorer): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Si c'est une réponse : seul l'auteur du projet peut répondre, et
        // une seule fois par commentaire.
        if (! empty($validated['parent_id'])) {
            $parent = Comment::findOrFail($validated['parent_id']);

            if (auth()->id() !== $project->user_id) {
                return $this->fail($request, "Seul l'auteur du projet peut répondre aux commentaires.");
            }

            if ($parent->replies()->exists()) {
                return $this->fail($request, 'Vous avez déjà répondu à ce commentaire.');
            }
        }

        $comment = $project->comments()->create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        if (! $comment->parent_id && $project->creatif) {
            $scorer->addPoints($project->creatif, 'project_comment');
        }

        if ($request->wantsJson()) {
            return $this->listResponse($project);
        }

        return back()->with('success', 'Commentaire publié !');
    }

    /**
     * Modifie un commentaire (ou une réponse) existant. Réservé à son
     * auteur, et seulement pendant le délai de Comment::estModifiable().
     */
    public function update(Request $request, Project $project, Comment $comment): JsonResponse
    {
        abort_if($comment->project_id !== $project->id, 404);
        abort_if($comment->user_id !== auth()->id(), 403);

        if (! $comment->estModifiable()) {
            return response()->json([
                'success' => false,
                'message' => 'Le délai de modification (5 minutes) est dépassé.',
            ], 403);
        }

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update(['body' => $validated['body']]);

        return $this->listResponse($project);
    }

    /**
     * Supprime un commentaire (ou une réponse) existant. Réservé à son
     * auteur, et seulement pendant le délai de Comment::estModifiable().
     * Si le commentaire supprimé avait rapporté des points de score (un
     * commentaire racine), ces points sont retirés.
     */
    public function destroy(Project $project, Comment $comment, BuilderScoreService $scorer): JsonResponse
    {
        abort_if($comment->project_id !== $project->id, 404);
        abort_if($comment->user_id !== auth()->id(), 403);

        if (! $comment->estModifiable()) {
            return response()->json([
                'success' => false,
                'message' => 'Le délai de suppression (5 minutes) est dépassé.',
            ], 403);
        }

        if (! $comment->parent_id && $project->creatif) {
            $scorer->removePoints($project->creatif, 'project_comment');
        }

        $comment->delete();

        return $this->listResponse($project);
    }

    /**
     * Réponse JSON standard après une action réussie : le fragment HTML de
     * la liste des commentaires déjà à jour (voir resources/views/comment/list.blade.php)
     * et le nombre de commentaires racine, pour que le front (mefolioComments()
     * dans comment.blade.php) n'ait qu'à remplacer le DOM, sans recalculer
     * quoi que ce soit côté client.
     */
    private function listResponse(Project $project): JsonResponse
    {
        $project->load('comments');

        return response()->json([
            'success' => true,
            'html' => view('comment.list', ['project' => $project])->render(),
            'count' => $project->comments->count(),
        ]);
    }

    /**
     * Réponse d'échec commune à store() : JSON pour l'appel AJAX normal,
     * redirection classique + message flash pour le repli sans JS.
     */
    private function fail(Request $request, string $message): JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json(['success' => false, 'message' => $message], 422);
        }

        return back()->with('error', $message);
    }
}

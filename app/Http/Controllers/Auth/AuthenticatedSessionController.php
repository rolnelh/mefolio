<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Creatif;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Accroches affichées sur le panneau de marque de la page de connexion.
     * Une entrée est tirée au sort à chaque affichage de la page pour que
     * le message change à chaque tentative de connexion.
     */
    private const TAGLINES = [
        ['line1' => 'Votre portfolio', 'line2' => 'vous attend.', 'text' => "Vos projets, vos opportunités, votre communauté : tout est là où vous l'avez laissé."],
        ['line1' => 'Vos talents,', 'line2' => 'votre vitrine.', 'text' => 'Un profil clair, des projets qui parlent pour vous, une communauté qui vous soutient.'],
        ['line1' => 'Prêt à briller', 'line2' => 'à nouveau ?', 'text' => 'Vos missions, vos messages et votre classement vous attendent.'],
        ['line1' => 'De retour', 'line2' => 'parmi les créatifs.', 'text' => 'Reprenez où vous vous êtes arrêté : projets, missions et communauté.'],
        ['line1' => 'Votre travail', 'line2' => "mérite d'être vu.", 'text' => 'Connectez-vous pour retrouver votre profil et vos opportunités.'],
    ];

    /**
     * Display the login view.
     */
    public function create(): View
    {
        $creatifCount = Creatif::where('is_paused', false)->count();
        $recentCreatifs = Creatif::where('is_paused', false)->latest()->take(3)->get();
        $tagline = self::TAGLINES[array_rand(self::TAGLINES)];
        // Traduit ici (clé = texte français exact, voir lang/en.json) plutôt
        // que dans la vue, pour que la même accroche tirée au sort reste
        // cohérente sur ses 3 champs.
        $tagline = [
            'line1' => __($tagline['line1']),
            'line2' => __($tagline['line2']),
            'text' => __($tagline['text']),
        ];

        return view('auth.login', compact('creatifCount', 'recentCreatifs', 'tagline'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if (Auth::user()->is_banned) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => __("Ce compte a été suspendu. Contactez l'équipe Mefolio pour plus d'informations."),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

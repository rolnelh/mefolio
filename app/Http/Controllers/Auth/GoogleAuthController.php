<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleAuthController extends Controller
{
    /**
     * Redirige l'utilisateur vers l'écran de consentement Google.
     */
    public function redirect(): RedirectResponse
    {
        if (empty(config('services.google.client_id'))) {
            return redirect()->route('login')->with(
                'google_error',
                "La connexion avec Google n'est pas encore configurée sur ce site."
            );
        }

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    /**
     * Traite le retour de Google : connecte, relie, ou démarre l'inscription.
     */
    public function callback(Request $request): RedirectResponse
    {
        if (empty(config('services.google.client_id'))) {
            return redirect()->route('login')->with(
                'google_error',
                "La connexion avec Google n'est pas encore configurée sur ce site."
            );
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->with(
                'google_error',
                'La session de connexion Google a expiré. Réessayez.'
            );
        } catch (\Throwable $e) {
            Log::warning('Erreur de connexion Google : ' . $e->getMessage());

            return redirect()->route('login')->with(
                'google_error',
                'La connexion avec Google a échoué. Réessayez ou utilisez votre email.'
            );
        }

        // Compte déjà relié à ce compte Google : connexion directe.
        $user = User::where('google_id', $googleUser->getId())->first();

        if (! $user) {
            // Un compte existe déjà avec cet email (inscription classique) :
            // on relie le compte Google, l'adresse étant déjà vérifiée par Google.
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->forceFill([
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ])->save();
            }
        }

        if ($user) {
            Auth::login($user, true);

            return redirect()->intended(route('dashboard'));
        }

        // Nouveau compte : il manque encore le rôle (créatif ou client) pour
        // terminer l'inscription. On garde les infos Google en session le
        // temps de le demander, plutôt que de faire confiance à des champs
        // cachés soumis par le navigateur.
        $request->session()->put('google_pending_registration', [
            'google_id' => $googleUser->getId(),
            'name' => $googleUser->getName() ?: $googleUser->getNickname(),
            'email' => $googleUser->getEmail(),
        ]);

        return redirect()->route('google.role');
    }

    /**
     * Affiche le choix de rôle pour finaliser une inscription via Google.
     */
    public function showRoleForm(Request $request): View|RedirectResponse
    {
        $pending = $request->session()->get('google_pending_registration');

        if (! $pending) {
            return redirect()->route('register');
        }

        return view('auth.google-role', ['pending' => $pending]);
    }

    /**
     * Termine l'inscription démarrée via Google en créant le compte.
     */
    public function storeRole(Request $request): RedirectResponse
    {
        $pending = $request->session()->get('google_pending_registration');

        if (! $pending) {
            return redirect()->route('register');
        }

        $validated = $request->validate([
            'role' => ['required', 'string', 'in:creatif,client'],
        ]);

        // L'email a pu être pris entre-temps (double onglet, etc.).
        if (User::where('email', $pending['email'])->exists()) {
            $request->session()->forget('google_pending_registration');

            return redirect()->route('login')->with(
                'google_error',
                'Un compte existe déjà avec cette adresse email. Connectez-vous normalement.'
            );
        }

        $user = User::create([
            'username' => $this->uniqueUsernameFrom($pending['name'] ?? $pending['email']),
            'email' => $pending['email'],
            'google_id' => $pending['google_id'],
            // Compte créé via Google : aucun mot de passe local n'est utilisable.
            // On stocke un hash aléatoire (jamais nul) pour que la connexion par
            // email/mot de passe échoue proprement plutôt que de planter sur un
            // mot de passe absent.
            'password' => Hash::make(Str::random(40)),
            'role' => $validated['role'],
        ]);

        // email_verified_at n'est volontairement pas mass-assignable (voir
        // $fillable sur User) : Google a déjà vérifié cette adresse, on le
        // note explicitement après création.
        $user->forceFill(['email_verified_at' => now()])->save();

        $request->session()->forget('google_pending_registration');

        Auth::login($user, true);

        if ($user->role === User::ROLE_CREATIF) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('projects.index');
    }

    private function uniqueUsernameFrom(string $seed): string
    {
        $base = Str::slug($seed, '') ?: 'membre';
        $username = $base;
        $i = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base . (++$i);
        }

        return $username;
    }
}

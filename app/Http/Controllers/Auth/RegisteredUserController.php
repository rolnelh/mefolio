<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Creatif;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * À la toute première visite (pas encore de cookie "mefolio_onboarded"),
     * on redirige vers l'onboarding plutôt que d'afficher le formulaire
     * directement — quel que soit le lien qui a mené jusqu'ici. Le cookie est
     * posé dès que l'onboarding est affiché, donc ça ne se déclenche qu'une
     * fois par visiteur.
     */
    public function create(Request $request): View|RedirectResponse
    {
        if (! $request->cookie('mefolio_onboarded')) {
            return redirect()->route('onboarding');
        }

        $creatifCount = Creatif::where('is_paused', false)->count();
        $recentCreatifs = Creatif::where('is_paused', false)->latest()->take(3)->get();

        return view('auth.register', compact('creatifCount', 'recentCreatifs'));
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:creatif,client'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirection personnalisée selon le rôle choisi : un créatif est envoyé
        // compléter son portfolio, un client explore directement les projets.
        if ($user->role === 'creatif') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('projects.index');
    }
}

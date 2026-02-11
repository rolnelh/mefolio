<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:creatif,client'], // Validation stricte du rôle
        ]);

        // Création de l'utilisateur avec le rôle
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // On enregistre le rôle choisi
        ]);

        event(new Registered($user));

        Auth::login($user);

        // REDIRECTION PERSONNALISÉE
        // Si c'est un créatif, on peut l'envoyer vers la création de son profil/portfolio
        // Si c'est un client, on l'envoie explorer les projets
        if ($user->role === 'creatif') {
    // Redirige vers un formulaire spécial pour remplir son portfolio
    return redirect()->route('dashboard'); 
    } else {
        // Redirige vers la page d'accueil des projets
        return redirect()->route('projects.index'); 
    }
        }
}
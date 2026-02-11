<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creatif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Importé pour la suppression des fichiers

class CreatifController extends Controller
{
    // ✅ Liste des créatifs (Page d'accueil des talents)
    public function index()
    {
        $creatifs = Creatif::latest()->paginate(4);
        return view('creatifs.index', compact('creatifs'));
    }
    
    // ✅ Voir un profil spécifique
    public function show($slug)
    {
        $creatif = Creatif::where('slug', $slug)->firstOrFail();
        $projects = $creatif->projects;

        return view('creatifs.show', compact('creatif', 'projects'));
    }

    // ✅ Formulaire de création
    public function create()
    {
        if (Auth::user()->creatif) {
            return redirect()->route('creatifs.edit');
        }
        return view('creatifs.create');
    }

    // ✅ Enregistrement initial
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'bio' => 'required|string',
            'portfolio_url' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'couverture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072', // Validation couverture
        ]);

        // Gestion de la photo de profil
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos_creatifs', 'public');
        }

        // Gestion de la couverture
        if ($request->hasFile('couverture')) {
            $validated['couverture'] = $request->file('couverture')->store('couvertures_creatifs', 'public');
        }

        $user->creatif()->create($validated);

        return redirect()->route('dashboard')
            ->with('success', '🎉 Profil complété avec succès !');
    }

    // ✅ Formulaire d’édition
    public function edit()
    {
        $creatif = Auth::user()->creatif;
        return view('creatifs.edit', compact('creatif'));
    }

    // ✅ Mise à jour avec suppression des anciens fichiers
    public function update(Request $request)
    {
        $user = Auth::user();
        $creatif = $user->creatif;

        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'portfolio_url' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'couverture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        // Mise à jour Photo de Profil
        if ($request->hasFile('photo')) {
            if ($creatif && $creatif->photo) {
                Storage::disk('public')->delete($creatif->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos_creatifs', 'public');
        }

        // Mise à jour Couverture
        if ($request->hasFile('couverture')) {
            if ($creatif && $creatif->couverture) {
                Storage::disk('public')->delete($creatif->couverture);
            }
            $validated['couverture'] = $request->file('couverture')->store('couvertures_creatifs', 'public');
        }

        $user->creatif()->updateOrCreate(['user_id' => $user->id], $validated);

        return redirect()->route('dashboard')
            ->with('success', '✅ Profil mis à jour avec succès !');
    }
}
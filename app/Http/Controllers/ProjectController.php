<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Liste tous les projets (Public)
     */
    public function index()
    {
        $projects = Project::with('user.creatif')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('projects.index', compact('projects'));
    }

    /**
     * Recherche de projets
     */
    public function search(Request $request)
    {
        $query = Project::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('creator')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->creator . '%');
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $projects = $query->latest()->paginate(9);

        return view('projects.index', compact('projects'));
    }

    /**
     * Dashboard de l'utilisateur
     */
    public function dashboard()
    {
        $user = Auth::user();
        $creatif = $user->creatif; 
        $projects = $creatif ? $creatif->projects()->latest()->get() : collect();

        return view('dashboard', compact('creatif', 'projects'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Enregistrer un nouveau projet
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'media'       => 'required|array', // Vérifie qu'il y a des fichiers
        'media.*'     => 'file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480', // 20Mo max
    ]);

    $project = new Project();
    $project->user_id = auth()->id();
    $project->creatif_id = auth()->user()->creatif?->id;
    $project->title = $validated['title'];
    $project->description = $validated['description'];
    $project->slug = Str::slug($validated['title']) . '-' . uniqid();

    // Gestion du multi-upload
    if ($request->hasFile('media')) {
        $paths = [];
        foreach ($request->file('media') as $index => $file) {
            $path = $file->store('projects/gallery', 'public');
            
            // On définit le premier fichier comme l'image de couverture par défaut
            if ($index === 0) {
                $project->image = $path;
            }
            
            $paths[] = $path;
        }
        // On stocke tous les chemins dans la colonne 'fichiers' (ou 'media')
        $project->fichiers = json_encode($paths); 
    }

    $project->save();

    return redirect()->route('dashboard')->with('success', 'Chef-d\'œuvre propulsé ! 🚀');
}

    /**
     * Afficher un projet (via Slug)
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->with(['user.creatif'])
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }

    /**
     * Formulaire d'édition (via ID pour plus de simplicité en admin)
     */
    public function edit(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Mettre à jour le projet
     */
    public function update(Request $request, Project $project)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:4096',
        'media.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
    ]);

    // 1. Image de couverture principale
    if ($request->hasFile('image')) {
        if ($project->image) { Storage::disk('public')->delete($project->image); }
        $project->image = $request->file('image')->store('projects/covers', 'public');
    }

    // 2. Gestion de la galerie (fichiers supplémentaires)
    $currentFiles = json_decode($project->fichiers ?? '[]', true);

    if ($request->hasFile('media')) {
        foreach ($request->file('media') as $file) {
            $currentFiles[] = $file->store('projects/gallery', 'public');
        }
    }

    $project->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'image' => $project->image,
        'fichiers' => json_encode($currentFiles), // On sauvegarde le tableau fusionné
    ]);

    return redirect()->route('projects.show', $project->slug)->with('success', 'Projet mis à jour !');
}

    /**
     * Supprimer un projet
     */
    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        // Nettoyage Storage
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        if ($project->fichiers) {
            foreach (json_decode($project->fichiers, true) as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Projet supprimé définitivement.');
    }
}
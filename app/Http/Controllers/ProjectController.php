<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user.creatif')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('projects.index', compact('projects'));
    }

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

    public function dashboard()
    {
        $user = Auth::user();
        $creatif = $user->creatif;
        $projects = $creatif ? $creatif->projects()->latest()->get() : collect();
        return view('dashboard', compact('creatif', 'projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'media'       => 'required|array',
            'media.*'     => 'file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
        ]);

        $project = new Project();
        $project->user_id = auth()->id();
        $project->creatif_id = auth()->user()->creatif?->id;
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->slug = Str::slug($validated['title']) . '-' . uniqid();

        if ($request->hasFile('media')) {
            $paths = [];
            foreach ($request->file('media') as $index => $file) {
                $result = cloudinary()->upload($file->getRealPath(), [
                    'folder' => 'mefolio/projects',
                    'resource_type' => 'auto',
                ]);
                $url = $result->getSecurePath();

                if ($index === 0) {
                    $project->image = $url;
                }
                $paths[] = $url;
            }
            $project->fichiers = json_encode($paths);
        }

        $project->save();

        return redirect()->route('dashboard')->with('success', 'Chef-d\'œuvre propulsé ! 🚀');
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->with(['user.creatif'])
            ->firstOrFail();
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:4096',
            'media.*'     => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
        ]);

        if ($request->hasFile('image')) {
            $result = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'mefolio/projects/covers',
            ]);
            $project->image = $result->getSecurePath();
        }

        $currentFiles = json_decode($project->fichiers ?? '[]', true);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $result = cloudinary()->upload($file->getRealPath(), [
                    'folder' => 'mefolio/projects/gallery',
                    'resource_type' => 'auto',
                ]);
                $currentFiles[] = $result->getSecurePath();
            }
        }

        $project->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'image'       => $project->image,
            'fichiers'    => json_encode($currentFiles),
        ]);

        return redirect()->route('projects.show', $project->slug)
            ->with('success', 'Projet mis à jour !');
    }

    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }
        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Projet supprimé définitivement.');
    }
}
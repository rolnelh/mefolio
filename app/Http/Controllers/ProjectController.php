<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\Project;
use App\Notifications\ActivityNotification;
use App\Services\BuilderScoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['user.creatif', 'likes'])->orderBy('created_at', 'desc');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->paginate(9)->withQueryString();
        $categories = Project::whereNotNull('category')->distinct()->pluck('category');

        return view('projects.index', compact('projects', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Project::with(['user.creatif', 'likes']);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('creator')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->creator . '%');
            });
        }

        $projects = $query->latest()->paginate(9)->withQueryString();
        $categories = Project::whereNotNull('category')->distinct()->pluck('category');

        return view('projects.index', compact('projects', 'categories'));
    }

    public function toggleLike(Project $project)
    {
        $like = $project->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
        } else {
            $project->likes()->create(['user_id' => auth()->id()]);

            if ($project->user && $project->user_id !== auth()->id()) {
                $project->user->notify(new ActivityNotification(
                    title: 'Nouveau like',
                    message: auth()->user()->username . ' a aimé votre projet « ' . $project->title . ' ».',
                    url: route('projects.show', $project->slug),
                    icon: 'like',
                ));
            }
        }

        return back();
    }

    public function dashboard(BuilderScoreService $scorer)
    {
        $user = Auth::user();
        $creatif = $user->creatif;
        $projects = $creatif ? $creatif->projects()->withCount(['likes', 'comments'])->latest()->get() : collect();
        $totalLikes = $projects->sum('likes_count');
        $totalComments = $projects->sum('comments_count');

        $postedMissions = Mission::where('user_id', $user->id)
            ->with('applications.user')
            ->withCount('applications')
            ->latest()
            ->get();
        $appliedMissions = MissionApplication::with('mission.user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard', compact(
            'creatif', 'projects', 'totalLikes', 'totalComments', 'scorer',
            'postedMissions', 'appliedMissions'
        ));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request, BuilderScoreService $scorer)
    {
        $creatif = auth()->user()->creatif;
        if ($creatif && $creatif->projects()->count() >= 2) {
            return redirect()->route('dashboard')
                ->with('error', "Vous avez atteint la limite de 2 projets pour la phase de test. Merci de votre compréhension.");
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'nullable|string|max:100',
            'technologies'=> 'nullable|string|max:255',
            'lien_site'   => 'nullable|url|max:255',
            'lien_github' => 'nullable|url|max:255',
            'media'       => 'required|array',
            'media.*'     => 'file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
        ]);

        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);

        $project = new Project();
        $project->user_id = auth()->id();
        $project->creatif_id = $creatif?->id;
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->category = $validated['category'] ?? null;
        $project->technologies = $validated['technologies'] ?? null;
        $project->lien_site = $validated['lien_site'] ?? null;
        $project->lien_github = $validated['lien_github'] ?? null;
        $project->slug = Str::slug($validated['title']) . '-' . uniqid();

        if ($request->hasFile('media')) {
            $paths = [];
            foreach ($request->file('media') as $index => $file) {
                $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                    'folder' => 'mefolio/projects',
                    'resource_type' => 'auto',
                ]);
                $url = $result['secure_url'];
                if ($index === 0) {
                    $project->image = $url;
                }
                $paths[] = $url;
            }
            $project->fichiers = json_encode($paths);
        }

        $project->save();

        if ($creatif) {
            $scorer->addPoints($creatif, 'new_project');
        }

        auth()->user()->notify(new ActivityNotification(
            title: 'Projet publié',
            message: 'Votre projet « ' . $project->title . ' » a été publié avec succès.',
            url: route('projects.show', $project->slug),
            icon: 'project',
        ));

        return redirect()->route('dashboard')->with('success', "Votre projet a été publié avec succès.");
    }

    public function update(Request $request, Project $project, BuilderScoreService $scorer)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'nullable|string|max:100',
            'technologies'=> 'nullable|string|max:255',
            'lien_site'   => 'nullable|url|max:255',
            'lien_github' => 'nullable|url|max:255',
            'image'       => 'nullable|image|max:4096',
            'media.*'     => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
            'remove_fichiers'   => 'nullable|array',
            'remove_fichiers.*' => 'string',
        ]);

        $cloudinary = new \Cloudinary\Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);

        if ($request->hasFile('image')) {
            $result = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'mefolio/projects/covers',
            ]);
            $project->image = $result['secure_url'];
        }

        $currentFiles = json_decode($project->fichiers ?? '[]', true) ?: [];

        if ($request->filled('remove_fichiers')) {
            $currentFiles = array_values(array_diff($currentFiles, $validated['remove_fichiers']));
        }

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                    'folder' => 'mefolio/projects/gallery',
                    'resource_type' => 'auto',
                ]);
                $currentFiles[] = $result['secure_url'];
            }
        }

        $project->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'category'    => $validated['category'] ?? null,
            'technologies'=> $validated['technologies'] ?? null,
            'lien_site'   => $validated['lien_site'] ?? null,
            'lien_github' => $validated['lien_github'] ?? null,
            'image'       => $project->image,
            'fichiers'    => json_encode($currentFiles),
        ]);

        if ($project->creatif) {
            $scorer->addPoints($project->creatif, 'update_project');
        }

        auth()->user()->notify(new ActivityNotification(
            title: 'Projet modifié',
            message: 'Votre projet « ' . $project->title . ' » a été mis à jour.',
            url: route('projects.show', $project->slug),
            icon: 'project',
        ));

        return redirect()->route('projects.show', $project->slug)
            ->with('success', 'Projet mis à jour !');
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->with(['user.creatif', 'likes'])
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

    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }
        $title = $project->title;
        $project->delete();

        auth()->user()->notify(new ActivityNotification(
            title: 'Projet supprimé',
            message: 'Votre projet « ' . $title . ' » a été supprimé.',
            icon: 'project',
        ));

        return redirect()->route('dashboard')->with('success', 'Projet supprimé définitivement.');
    }
}

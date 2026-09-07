<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\MissionApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Mission::with('user')->withCount('applications')->open();

        if ($request->filled('domaine')) {
            $query->where('domaine', $request->domaine);
        }
        if ($request->filled('niveau')) {
            $query->where('niveau', $request->niveau);
        }
        if ($request->filled('lieu')) {
            $query->where('lieu', 'like', '%' . $request->lieu . '%');
        }
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $sort = $request->get('tri', 'recent');
        match ($sort) {
            'budget-desc' => $query->orderByDesc('budget_max'),
            'budget-asc' => $query->orderBy('budget_min'),
            default => $query->latest(),
        };

        $missions = $query->paginate(9)->withQueryString();

        $domaines = Mission::open()->whereNotNull('domaine')->distinct()->pluck('domaine');

        // Bandeau de confiance du hero : uniquement des données réelles (pas
        // d'avatars ni de notes inventées).
        $creatifCount = \App\Models\Creatif::where('is_paused', false)->count();
        $badgeCreatifs = \App\Models\Creatif::where('is_paused', false)
            ->whereNotNull('photo')
            ->latest()
            ->take(3)
            ->get();

        return view('missions.index', compact('missions', 'domaines', 'creatifCount', 'badgeCreatifs'));
    }

    public function show(Mission $mission)
    {
        $mission->load(['user', 'applications.user.creatif']);

        $userApplication = null;
        if (Auth::check()) {
            $userApplication = $mission->applications->firstWhere('user_id', Auth::id());
        }

        return view('missions.show', compact('mission', 'userApplication'));
    }

    public function create()
    {
        return view('missions.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['user_id'] = Auth::id();
        $validated['tags'] = $this->parseTags($request->input('tags'));

        $mission = Mission::create($validated);

        return redirect()->route('missions.show', $mission)->with('success', 'Mission publiée avec succès.');
    }

    public function edit(Mission $mission)
    {
        $this->authorizeOwner($mission);

        return view('missions.edit', compact('mission'));
    }

    public function update(Request $request, Mission $mission)
    {
        $this->authorizeOwner($mission);

        $validated = $this->validated($request);
        $validated['tags'] = $this->parseTags($request->input('tags'));

        $mission->update($validated);

        return redirect()->route('missions.show', $mission)->with('success', 'Mission mise à jour.');
    }

    public function destroy(Mission $mission)
    {
        $this->authorizeOwner($mission);

        $mission->delete();

        return redirect()->route('missions.mine')->with('success', 'Mission supprimée.');
    }

    public function mine()
    {
        $posted = Mission::where('user_id', Auth::id())->withCount('applications')->latest()->get();
        $applied = MissionApplication::with('mission')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('missions.mine', compact('posted', 'applied'));
    }

    public function apply(Request $request, Mission $mission)
    {
        if ($mission->user_id === Auth::id()) {
            return back()->with('error', "Vous ne pouvez pas postuler à votre propre mission.");
        }

        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        MissionApplication::updateOrCreate(
            ['mission_id' => $mission->id, 'user_id' => Auth::id()],
            ['message' => $validated['message'], 'status' => 'pending']
        );

        return back()->with('success', 'Candidature envoyée.');
    }

    public function updateApplicationStatus(Request $request, Mission $mission, MissionApplication $application)
    {
        $this->authorizeOwner($mission);

        if ($application->mission_id !== $mission->id) {
            abort(404);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application->update($validated);

        return back()->with('success', 'Candidature mise à jour.');
    }

    private function authorizeOwner(Mission $mission): void
    {
        if ($mission->user_id !== Auth::id()) {
            abort(403, "Action non autorisée.");
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domaine' => 'required|string|max:255',
            'budget_min' => 'nullable|integer|min:0',
            'budget_max' => 'nullable|integer|min:0|gte:budget_min',
            'duree' => 'nullable|string|max:100',
            'niveau' => 'nullable|string|max:100',
            'lieu' => 'nullable|string|max:255',
            'remote' => 'nullable|boolean',
            'urgent' => 'nullable|boolean',
        ]);
    }

    private function parseTags(?string $tags): array
    {
        if (! $tags) {
            return [];
        }
        return collect(explode(',', $tags))->map(fn ($t) => trim($t))->filter()->values()->all();
    }
}

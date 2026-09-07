<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::withCount('participants')->latest()->paginate(15);

        return view('admin.challenges.index', compact('challenges'));
    }

    public function create()
    {
        return view('admin.challenges.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['created_by'] = Auth::id();

        Challenge::create($validated);

        return redirect()->route('admin.challenges.index')->with('success', 'Challenge créé.');
    }

    public function edit(Challenge $challenge)
    {
        return view('admin.challenges.edit', compact('challenge'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        $challenge->update($this->validated($request));

        return redirect()->route('admin.challenges.index')->with('success', 'Challenge mis à jour.');
    }

    public function destroy(Challenge $challenge)
    {
        $challenge->delete();

        return back()->with('success', 'Challenge supprimé.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sponsor' => 'nullable|string|max:255',
            'prize' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'image' => 'nullable|url',
            'status' => 'required|in:open,closed',
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;
        while (Challenge::where('slug', $slug)->exists()) {
            $slug = $original . '-' . (++$i);
        }
        return $slug;
    }
}

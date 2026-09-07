<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(15);

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['created_by'] = Auth::id();
        $validated['tags'] = $this->parseTags($request->input('tags'));

        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Programme créé.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $this->validated($request);
        $validated['tags'] = $this->parseTags($request->input('tags'));

        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Programme mis à jour.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return back()->with('success', 'Programme supprimé.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url',
            'featured' => 'nullable|boolean',
            'status' => 'required|in:active,archived',
        ]);
    }

    private function parseTags(?string $tags): array
    {
        if (! $tags) {
            return [];
        }
        return collect(explode(',', $tags))->map(fn ($t) => trim($t))->filter()->values()->all();
    }

    private function uniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;
        while (Program::where('slug', $slug)->exists()) {
            $slug = $original . '-' . (++$i);
        }
        return $slug;
    }
}

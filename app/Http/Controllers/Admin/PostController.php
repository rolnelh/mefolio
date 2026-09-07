<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['author_id'] = Auth::id();

        if ($request->boolean('publish')) {
            $validated['status'] = 'published';
            $validated['published_at'] = now();
        } else {
            $validated['status'] = 'draft';
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Article créé.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $this->validated($request);

        if ($request->boolean('publish')) {
            $validated['status'] = 'published';
            $validated['published_at'] = $post->published_at ?? now();
        } else {
            $validated['status'] = 'draft';
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Article mis à jour.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Article supprimé.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'cover_image' => 'nullable|url',
            'reading_minutes' => 'nullable|integer|min:1|max:60',
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $original . '-' . (++$i);
        }
        return $slug;
    }
}

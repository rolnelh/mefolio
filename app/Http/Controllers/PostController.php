<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author')->published()->latest('published_at');

        if ($request->filled('categorie')) {
            $query->where('category', $request->categorie);
        }

        $posts = $query->paginate(9)->withQueryString();
        $featured = Post::published()->latest('published_at')->first();
        $categories = Post::published()->whereNotNull('category')->distinct()->pluck('category');

        return view('blog', compact('posts', 'featured', 'categories'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->take(3)
            ->get();

        return view('blog-show', compact('post', 'related'));
    }
}

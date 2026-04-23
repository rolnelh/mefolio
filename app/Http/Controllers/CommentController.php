<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
 public function store(Request $request, Project $project)
{
    $request->validate([
        'body' => 'required|string|max:1000',
        'parent_id' => 'nullable|exists:comments,id',
    ]);

    // Si c'est une réponse
    if ($request->filled('parent_id')) {
        $parent = Comment::findOrFail($request->parent_id);

        // Seul le propriétaire du projet peut répondre
        if (auth()->id() !== $project->user_id) {
            return back()->with('error', 'Seul l\'auteur du projet peut répondre aux commentaires.');
        }

        // Une seule réponse par commentaire
        if ($parent->replies()->exists()) {
            return back()->with('error', 'Vous avez déjà répondu à ce commentaire.');
        }
    }

    $project->comments()->create([
        'body' => $request->body,
        'user_id' => auth()->id(),
        'parent_id' => $request->parent_id ?? null,
    ]);

    return back()->with('success', 'Commentaire publié !');
}

public function storeAjax(Request $request, $projectId)
{
    $request->validate([
        'body' => 'required|string|max:1000',
        'parent_id' => 'nullable|exists:comments,id',
    ]);

    $project = Project::findOrFail($projectId);

    $comment = $project->comments()->create([
        'user_id' => auth()->id(),
        'body' => $request->body,
        'parent_id' => $request->parent_id,
    ]);

    $comment->load('user');

    return response()->json([
        'success' => true,
        'comment' => [
            'id' => $comment->id,
            'body' => $comment->body,
            'created_at' => $comment->created_at->diffForHumans(),
            'user' => [
                'prenom' => $comment->user->prenom ?? '',
                'nom' => $comment->user->nom ?? '',
                'photo' => $comment->user->photo
    ? $comment->user->photo
    : asset('img/default-avatar.png'),
            ],
        ],
    ]);
}

}

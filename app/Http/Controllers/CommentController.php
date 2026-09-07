<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Services\BuilderScoreService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Project $project, BuilderScoreService $scorer)
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
                return back()->with('error', "Seul l'auteur du projet peut répondre aux commentaires.");
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

        if (! $request->filled('parent_id') && $project->creatif) {
            $scorer->addPoints($project->creatif, 'project_comment');
        }

        return back()->with('success', 'Commentaire publié !');
    }

    public function storeAjax(Request $request, $projectId, BuilderScoreService $scorer)
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

        if (! $request->filled('parent_id') && $project->creatif) {
            $scorer->addPoints($project->creatif, 'project_comment');
        }

        $comment->load('user.creatif');

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'body' => $comment->body,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => [
                    'prenom' => $comment->user->creatif->prenom ?? $comment->user->username,
                    'nom' => $comment->user->creatif->nom ?? '',
                    'photo' => $comment->user->creatif->photo ?? null,
                ],
            ],
        ]);
    }
}

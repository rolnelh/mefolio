<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('user')->latest();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $projects = $query->paginate(20)->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Projet supprimé.');
    }
}

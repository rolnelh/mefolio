<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Comment;
use App\Models\Creatif;
use App\Models\Mission;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Program;
use App\Models\Project;
use App\Models\TalentNomination;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'creatifs' => Creatif::count(),
            'projects' => Project::count(),
            'comments' => Comment::count(),
            'posts' => Post::count(),
            'missions' => Mission::count(),
            'challenges' => Challenge::count(),
            'programs' => Program::count(),
            'newsletter' => NewsletterSubscriber::count(),
            'pending_nominations' => TalentNomination::where('status', 'pending')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentProjects = Project::with('user')->latest()->take(5)->get();
        $recentComments = Comment::with(['user', 'project'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentProjects', 'recentComments'));
    }
}

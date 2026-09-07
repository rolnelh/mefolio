<?php

namespace App\Http\Controllers;

use App\Models\Creatif;
use App\Services\BuilderScoreService;

class ClassementController extends Controller
{
    public function index(BuilderScoreService $scorer)
    {
        $creatifs = Creatif::where('is_paused', false)
            ->orderByDesc('builder_score')
            ->orderBy('created_at')
            ->get();

        return view('classement.index', compact('creatifs', 'scorer'));
    }
}

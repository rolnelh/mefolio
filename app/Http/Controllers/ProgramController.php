<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $featured = Program::active()->where('featured', true)->latest()->get();
        $programs = Program::active()->where('featured', false)->latest()->paginate(9);

        return view('hackathons.index', compact('featured', 'programs'));
    }
}

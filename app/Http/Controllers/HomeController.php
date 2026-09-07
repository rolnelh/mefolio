<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Project;
use App\Models\Creatif;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{

   public function index()
{

    $projects = Project::with(['creatif', 'likes']) // Vérifiez que la fonction s'appelle 'creatif' dans Project.php
        ->orderBy('created_at', 'desc')
        ->paginate(8);

    $creatifs = Creatif::where('is_paused', false)->orderBy('created_at', 'desc')->take(5)->get();
    $creatifCount = Creatif::where('is_paused', false)->count();

    $testimonials = Testimonial::active()->orderBy('position')->orderBy('created_at', 'desc')->get();

    return view('home', compact('projects', 'creatifs', 'creatifCount', 'testimonials'));
}

}

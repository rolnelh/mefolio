<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Project;
use App\Models\Creatif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
   public function index()
{
    // Récupérer les 6 derniers projets avec leurs auteurs
    $projects = Project::with('creatif') // Vérifiez que la fonction s'appelle 'creatif' dans Project.php
        ->orderBy('created_at', 'desc')
        ->paginate(8);

    // Récupérer quelques créatifs pour la section profil
    $creatifs = Creatif::orderBy('created_at', 'desc')->take(5)->get();

    return view('home', compact('projects', 'creatifs'));
}

}

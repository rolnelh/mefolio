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

   /**
    * Affiche la page d'accueil publique.
    *
    * Chaque section de la vue (hero, avantages, projets récents...) vit
    * dans son propre partial sous resources/views/home/ — voir le
    * commentaire en tête de home.blade.php pour le détail.
    */
   public function index()
{

    $projects = Project::with(['creatif', 'likes']) // Vérifiez que la fonction s'appelle 'creatif' dans Project.php
        ->orderBy('created_at', 'desc')
        ->paginate(8);

    // Section "Nos talents" (home/talents.blade.php) : le nombre de projets
    // s'affiche sur chaque carte de profil.
    $creatifs = Creatif::where('is_paused', false)->withCount('projects')->orderBy('created_at', 'desc')->take(8)->get();
    $creatifCount = Creatif::where('is_paused', false)->count();

    // Avatars de la preuve sociale du hero (home/hero.blade.php), et
    // complément de sa galerie s'il y a trop peu de projets avec image :
    // uniquement des créatifs avec une vraie photo (jamais d'avatars par
    // initiales).
    $heroCreatifs = Creatif::where('is_paused', false)
        ->whereNotNull('photo')
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

    $testimonials = Testimonial::active()->orderBy('position')->orderBy('created_at', 'desc')->get();

    return view('home', compact('projects', 'creatifs', 'creatifCount', 'testimonials', 'heroCreatifs'));
}

}

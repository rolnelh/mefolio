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

    $creatifs = Creatif::where('is_paused', false)->orderBy('created_at', 'desc')->take(8)->get();
    $creatifCount = Creatif::where('is_paused', false)->count();

    // Grappes de portraits du hero : uniquement des créatifs avec une vraie
    // photo (jamais d'avatars par initiales), puisées plus largement que les
    // 8 derniers pour ne pas laisser des grappes vides.
    $heroCreatifs = Creatif::where('is_paused', false)
        ->whereNotNull('photo')
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

    $testimonials = Testimonial::active()->orderBy('position')->orderBy('created_at', 'desc')->get();

    return view('home', compact('projects', 'creatifs', 'creatifCount', 'testimonials', 'heroCreatifs'));
}

}

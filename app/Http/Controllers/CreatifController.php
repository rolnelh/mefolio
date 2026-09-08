<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creatif;
use App\Notifications\ActivityNotification;
use App\Services\BuilderScoreService;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;

class CreatifController extends Controller
{
    private function getCloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => ['secure' => true]
        ]);
    }

    private function uploadToCloudinary($file, $folder)
    {
        $cloudinary = $this->getCloudinary();
        $result = $cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
        ]);
        return $result['secure_url'];
    }

    public function index(Request $request)
    {
        // Mots-clés utilisés pour rapprocher un domaine du champ "spécialité",
        // qui reste un texte libre saisi par chaque créatif.
        $domaineKeywords = [
            'design'      => 'design',
            'dev-web'     => 'web',
            'dev-mobile'  => 'mobile',
            'photo'       => 'photo',
            'video'       => 'vidéo',
            'marketing'   => 'marketing',
            'redaction'   => 'rédaction',
            'audio'       => 'audio',
        ];

        // Idem pour le pays, rapproché du champ "localisation" ("Ville, Pays").
        $paysNoms = [
            'bj' => 'Bénin',
            'sn' => 'Sénégal',
            'ci' => "Côte d'Ivoire",
            'gh' => 'Ghana',
            'ml' => 'Mali',
            'ng' => 'Nigeria',
            'cm' => 'Cameroun',
        ];

        $query = Creatif::where('is_paused', false)->withCount('projects');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($sub) use ($search) {
                $sub->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('specialite', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        if ($request->filled('domaine') && isset($domaineKeywords[$request->domaine])) {
            $query->where('specialite', 'like', '%' . $domaineKeywords[$request->domaine] . '%');
        }

        if ($request->filled('pays') && isset($paysNoms[$request->pays])) {
            $query->where('localisation', 'like', '%' . $paysNoms[$request->pays] . '%');
        }

        if ($request->boolean('disponible')) {
            $query->where('available_for_work', true);
        }

        match ($request->get('tri', 'recent')) {
            'populaire' => $query->orderByDesc('builder_score'),
            'projets'   => $query->orderByDesc('projects_count'),
            default     => $query->latest(),
        };

        $creatifs = $query->paginate(9)->withQueryString();

        return view('creatifs.index', compact('creatifs'));
    }

    public function show($slug)
    {
        $creatif = Creatif::where('slug', $slug)->firstOrFail();

        // Vue réelle : uniquement des visiteurs, jamais quand le créatif
        // consulte son propre profil.
        if (! Auth::check() || Auth::id() !== $creatif->user_id) {
            $creatif->increment('profile_views');
        }

        $projects = $creatif->projects()->withCount('likes')->latest()->get();
        $totalLikes = $projects->sum('likes_count');
        return view('creatifs.show', compact('creatif', 'projects', 'totalLikes'));
    }

    public function create()
    {
        if (Auth::user()->creatif) {
            return redirect()->route('creatifs.edit');
        }
        return view('creatifs.create');
    }

    public function store(Request $request, BuilderScoreService $scorer)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom'          => 'required|string|max:255',
            'prenom'       => 'required|string|max:255',
            'specialite'   => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'bio'          => 'required|string',
            'portfolio_url'=> 'nullable|url',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'couverture'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'available_for_work' => 'nullable|boolean',
        ]);

        $validated['available_for_work'] = $request->boolean('available_for_work');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadToCloudinary(
                $request->file('photo'),
                'mefolio/photos_creatifs'
            );
        }

        if ($request->hasFile('couverture')) {
            $validated['couverture'] = $this->uploadToCloudinary(
                $request->file('couverture'),
                'mefolio/couvertures_creatifs'
            );
        }

        $creatif = $user->creatif()->create($validated);

        $scorer->addPoints($creatif, 'profile_complete');

        return redirect()->route('dashboard')
            ->with('success', 'Profil complété avec succès !');
    }

    public function edit()
    {
        // Le formulaire de profil vit désormais directement dans le tableau
        // de bord (onglet "Mon profil"), pour rester à côté de la navigation
        // au lieu de naviguer vers une page séparée.
        return redirect()->route('dashboard', ['tab' => 'profil']);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $wasComplete = $this->isProfileComplete($user->creatif);

        $validated = $request->validate([
            'nom'          => 'nullable|string|max:255',
            'prenom'       => 'nullable|string|max:255',
            'specialite'   => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'bio'          => 'nullable|string',
            'portfolio_url'=> 'nullable|url',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'couverture'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'available_for_work' => 'nullable|boolean',
        ]);

        $validated['available_for_work'] = $request->boolean('available_for_work');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadToCloudinary(
                $request->file('photo'),
                'mefolio/photos_creatifs'
            );
        }

        if ($request->hasFile('couverture')) {
            $validated['couverture'] = $this->uploadToCloudinary(
                $request->file('couverture'),
                'mefolio/couvertures_creatifs'
            );
        }

        $creatif = $user->creatif()->updateOrCreate(['user_id' => $user->id], $validated);

        if (! $wasComplete && $this->isProfileComplete($creatif)) {
            app(BuilderScoreService::class)->addPoints($creatif, 'profile_complete');
        }

        if ($request->hasFile('photo')) {
            $user->notify(new ActivityNotification(
                title: 'Photo de profil mise à jour',
                message: 'Votre photo de profil a bien été changée.',
                url: $creatif->slug ? route('creatifs.show', $creatif->slug) : null,
                icon: 'profile',
            ));
        }

        return redirect()->route('dashboard', ['tab' => 'profil'])
            ->with('success', 'Profil mis à jour avec succès !');
    }

    public function togglePause()
    {
        $creatif = Auth::user()->creatif;

        if (! $creatif) {
            abort(404);
        }

        $creatif->update(['is_paused' => ! $creatif->is_paused]);

        return redirect()->route('dashboard', ['tab' => 'parametres'])->with('success', $creatif->is_paused
            ? 'Votre profil est maintenant en pause : il est masqué des listes publiques.'
            : 'Votre profil est de nouveau visible publiquement.');
    }

    private function isProfileComplete(?Creatif $creatif): bool
    {
        return $creatif
            && $creatif->nom
            && $creatif->prenom
            && $creatif->specialite
            && $creatif->localisation
            && $creatif->bio
            && $creatif->portfolio_url
            && $creatif->photo;
    }
}

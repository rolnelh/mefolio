<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creatif;
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

    public function index()
    {
        $creatifs = Creatif::where('is_paused', false)->latest()->paginate(4);
        return view('creatifs.index', compact('creatifs'));
    }

    public function show($slug)
    {
        $creatif = Creatif::where('slug', $slug)->firstOrFail();
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
        $creatif = auth()->user()->creatif ?? new \App\Models\Creatif();

        return view('creatifs.edit', compact('creatif'));
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

        return redirect()->route('dashboard')
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creatif;
use Illuminate\Support\Facades\Auth;

class CreatifController extends Controller
{
    public function index()
    {
        $creatifs = Creatif::latest()->paginate(4);
        return view('creatifs.index', compact('creatifs'));
    }

    public function show($slug)
    {
        $creatif = Creatif::where('slug', $slug)->firstOrFail();
        $projects = $creatif->projects;
        return view('creatifs.show', compact('creatif', 'projects'));
    }

    public function create()
    {
        if (Auth::user()->creatif) {
            return redirect()->route('creatifs.edit');
        }
        return view('creatifs.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'bio' => 'required|string',
            'portfolio_url' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'couverture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $result = cloudinary()->upload($request->file('photo')->getRealPath(), [
                'folder' => 'mefolio/photos_creatifs',
                'transformation' => ['width' => 400, 'height' => 400, 'crop' => 'fill']
            ]);
            $validated['photo'] = $result->getSecurePath();
        }

        if ($request->hasFile('couverture')) {
            $result = cloudinary()->upload($request->file('couverture')->getRealPath(), [
                'folder' => 'mefolio/couvertures_creatifs',
                'transformation' => ['width' => 1200, 'height' => 400, 'crop' => 'fill']
            ]);
            $validated['couverture'] = $result->getSecurePath();
        }

        $user->creatif()->create($validated);

        return redirect()->route('dashboard')
            ->with('success', '🎉 Profil complété avec succès !');
    }

    public function edit()
    {
        $creatif = Auth::user()->creatif;
        return view('creatifs.edit', compact('creatif'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'portfolio_url' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'couverture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $result = cloudinary()->upload($request->file('photo')->getRealPath(), [
                'folder' => 'mefolio/photos_creatifs',
                'transformation' => ['width' => 400, 'height' => 400, 'crop' => 'fill']
            ]);
            $validated['photo'] = $result->getSecurePath();
        }

        if ($request->hasFile('couverture')) {
            $result = cloudinary()->upload($request->file('couverture')->getRealPath(), [
                'folder' => 'mefolio/couvertures_creatifs',
                'transformation' => ['width' => 1200, 'height' => 400, 'crop' => 'fill']
            ]);
            $validated['couverture'] = $result->getSecurePath();
        }

        $user->creatif()->updateOrCreate(['user_id' => $user->id], $validated);

        return redirect()->route('dashboard')
            ->with('success', '✅ Profil mis à jour avec succès !');
    }
}
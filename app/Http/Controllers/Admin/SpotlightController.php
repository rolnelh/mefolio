<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creatif;
use App\Models\Spotlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpotlightController extends Controller
{
    public function index()
    {
        $spotlights = Spotlight::with('creatif')->latest()->paginate(15);
        $creatifs = Creatif::orderBy('prenom')->get();

        return view('admin.spotlights.index', compact('spotlights', 'creatifs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'creatif_id' => 'required|exists:creatifs,id',
            'week_label' => 'required|string|max:100',
            'note' => 'nullable|string',
        ]);

        Spotlight::query()->update(['is_current' => false]);

        Spotlight::create($validated + [
            'created_by' => Auth::id(),
            'is_current' => true,
        ]);

        return back()->with('success', 'Talent de la semaine mis en avant.');
    }

    public function setCurrent(Spotlight $spotlight)
    {
        Spotlight::query()->update(['is_current' => false]);
        $spotlight->update(['is_current' => true]);

        return back()->with('success', 'Talent de la semaine mis à jour.');
    }

    public function destroy(Spotlight $spotlight)
    {
        $spotlight->delete();

        return back()->with('success', 'Mise en avant supprimée.');
    }
}

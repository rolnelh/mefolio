<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creatif;
use Illuminate\Http\Request;

class CreatifController extends Controller
{
    public function index(Request $request)
    {
        $query = Creatif::with('user')->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('specialite', 'like', "%{$search}%");
            });
        }

        $creatifs = $query->paginate(20)->withQueryString();

        return view('admin.creatifs.index', compact('creatifs'));
    }

    public function destroy(Creatif $creatif)
    {
        $creatif->delete();

        return back()->with('success', 'Profil créatif supprimé.');
    }
}

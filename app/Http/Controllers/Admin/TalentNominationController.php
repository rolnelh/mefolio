<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TalentNomination;
use Illuminate\Http\Request;

class TalentNominationController extends Controller
{
    public function index()
    {
        $nominations = TalentNomination::with('nominator')->latest()->paginate(20);

        return view('admin.nominations.index', compact('nominations'));
    }

    public function updateStatus(Request $request, TalentNomination $nomination)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $nomination->update($validated);

        return back()->with('success', 'Nomination mise à jour.');
    }

    public function destroy(TalentNomination $nomination)
    {
        $nomination->delete();

        return back()->with('success', 'Nomination supprimée.');
    }
}

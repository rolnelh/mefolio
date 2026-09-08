<?php

namespace App\Http\Controllers;

use App\Models\Spotlight;
use App\Models\TalentNomination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TalentOfTheWeekController extends Controller
{
    public function index()
    {
        $current = Spotlight::with('creatif.projects')->where('is_current', true)->first();
        $hallOfFame = Spotlight::with('creatif')
            ->when($current, fn ($q) => $q->where('id', '!=', $current->id))
            ->latest()
            ->take(6)
            ->get();

        return view('talentoftheweek.index', compact('current', 'hallOfFame'));
    }

    public function nominate(Request $request)
    {
        $validated = $request->validate([
            'creatif_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'reason' => 'required|string|max:2000',
        ]);

        TalentNomination::create($validated + [
            'nominated_by' => Auth::id(),
        ]);

        return back()->with('nomination_success', true);
    }
}

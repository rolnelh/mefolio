<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::withCount('participants')->latest()->paginate(9);

        return view('challenges.index', compact('challenges'));
    }

    public function show(Challenge $challenge)
    {
        $challenge->load(['participants.user']);

        $userParticipation = null;
        if (Auth::check()) {
            $userParticipation = $challenge->participants->firstWhere('user_id', Auth::id());
        }

        return view('challenges.show', compact('challenge', 'userParticipation'));
    }

    public function participate(Request $request, Challenge $challenge)
    {
        if ($challenge->status !== 'open') {
            return back()->with('error', "Ce challenge n'accepte plus de participations.");
        }

        $validated = $request->validate([
            'submission_url' => 'nullable|url',
            'submission_note' => 'required|string|max:2000',
        ]);

        ChallengeParticipant::updateOrCreate(
            ['challenge_id' => $challenge->id, 'user_id' => Auth::id()],
            $validated
        );

        return back()->with('success', 'Votre participation a été enregistrée.');
    }
}

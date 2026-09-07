<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with('user')->withCount('applications')->latest()->paginate(20);

        return view('admin.missions.index', compact('missions'));
    }

    public function updateStatus(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,completed,cancelled',
        ]);

        $mission->update($validated);

        return back()->with('success', 'Statut de la mission mis à jour.');
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();

        return back()->with('success', 'Mission supprimée.');
    }
}

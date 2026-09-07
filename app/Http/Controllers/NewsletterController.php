<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'source' => 'nullable|string|max:100',
        ]);

        NewsletterSubscriber::firstOrCreate(
            ['email' => $validated['email']],
            ['source' => $validated['source'] ?? 'site']
        );

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Inscription confirmée.']);
        }

        return back()->with('success', 'Merci ! Vous êtes inscrit(e) à la newsletter Mefolio.');
    }
}

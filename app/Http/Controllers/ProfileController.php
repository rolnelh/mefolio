<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's preferred payment methods.
     */
    public function updatePaymentMethods(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'paiements' => 'nullable|array',
            'paiements.*' => 'string',
            'payment_phone_prefix' => 'nullable|string|max:10',
            'payment_phone' => 'nullable|string|max:30',
        ]);

        $request->user()->update([
            'payment_methods' => $validated['paiements'] ?? [],
            'payment_phone_prefix' => $validated['payment_phone_prefix'] ?? null,
            'payment_phone' => $validated['payment_phone'] ?? null,
        ]);

        return back()->with('success', 'Vos moyens de paiement ont été enregistrés.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

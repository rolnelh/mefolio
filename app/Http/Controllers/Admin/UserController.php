<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('creatif')->latest();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:' . implode(',', User::ROLES),
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Rôle mis à jour pour ' . $user->username . '.');
    }

    public function toggleBan(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Impossible de bannir un administrateur.');
        }

        $user->update(['is_banned' => ! $user->is_banned]);

        return back()->with('success', $user->is_banned
            ? $user->username . ' a été suspendu.'
            : $user->username . ' a été réactivé.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Impossible de supprimer un administrateur.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }
}

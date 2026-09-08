<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Utilisateurs</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $users->total() }} compte(s) enregistré(s).</p>
    </x-slot>

    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un nom ou un email..."
            class="flex-1 min-w-[200px] px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <select name="role" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Tous les rôles</option>
            @foreach (\App\Models\User::ROLES as $role)
                <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        <button class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-indigo-600 transition-colors">
            Filtrer
        </button>
    </form>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Utilisateur</th>
                    <th class="px-5 py-3">Rôle</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3">Inscrit le</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3">
                            <p class="font-semibold text-gray-900">{{ $user->username }}</p>
                            <p class="text-xs text-gray-400">{{ $user->email }}</p>
                        </td>
                        <td class="px-5 py-3">
                            <form method="POST" action="{{ route('admin.users.role', $user) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit()" @if($user->isAdmin()) disabled @endif
                                    class="text-xs font-semibold border border-gray-200 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-50">
                                    @foreach (\App\Models\User::ROLES as $role)
                                        <option value="{{ $role }}" @selected($user->role === $role)>{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-5 py-3">
                            @if ($user->is_banned)
                                <span class="text-[10px] font-bold uppercase bg-red-50 text-red-600 px-2 py-1 rounded-full">Suspendu</span>
                            @else
                                <span class="text-[10px] font-bold uppercase bg-green-50 text-green-600 px-2 py-1 rounded-full">Actif</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                @unless ($user->isAdmin())
                                    <form method="POST" action="{{ route('admin.users.ban', $user) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="text-xs font-semibold text-amber-600 hover:text-amber-800">
                                            {{ $user->is_banned ? 'Réactiver' : 'Suspendre' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Supprimer définitivement cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-300">-</span>
                                @endunless
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucun utilisateur trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
</x-admin-layout>

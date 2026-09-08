<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Missions</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $missions->total() }} mission(s) publiée(s) sur la plateforme.</p>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Mission</th>
                    <th class="px-5 py-3">Client</th>
                    <th class="px-5 py-3">Candidatures</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($missions as $mission)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3 font-semibold text-gray-900">{{ $mission->title }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $mission->user->username ?? '-' }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $mission->applications_count }}</td>
                        <td class="px-5 py-3">
                            <form method="POST" action="{{ route('admin.missions.status', $mission) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-xs font-semibold border border-gray-200 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @foreach (['open' => 'Ouverte', 'in_progress' => 'En cours', 'completed' => 'Terminée', 'cancelled' => 'Annulée'] as $val => $label)
                                        <option value="{{ $val }}" @selected($mission->status === $val)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('missions.show', $mission) }}" target="_blank" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Voir</a>
                                <form method="POST" action="{{ route('admin.missions.destroy', $mission) }}"
                                    onsubmit="return confirm('Supprimer cette mission ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucune mission publiée pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $missions->links() }}</div>
</x-admin-layout>

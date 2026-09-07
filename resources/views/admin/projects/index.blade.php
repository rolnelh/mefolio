<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Projets</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $projects->total() }} projet(s) publié(s) sur la plateforme.</p>
    </x-slot>

    <form method="GET" class="flex gap-3 mb-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un projet..."
            class="flex-1 max-w-sm px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-indigo-600 transition-colors">
            Rechercher
        </button>
    </form>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Projet</th>
                    <th class="px-5 py-3">Auteur</th>
                    <th class="px-5 py-3">Publié le</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($projects as $project)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3 font-semibold text-gray-900">{{ $project->title }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $project->user->username ?? '—' }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $project->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('projects.show', $project->slug) }}" target="_blank"
                                    class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Voir</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                    onsubmit="return confirm('Supprimer ce projet ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-400">Aucun projet trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $projects->links() }}</div>
</x-admin-layout>

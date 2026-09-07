<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-gray-900">Programmes & Hackathons</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $programs->total() }} programme(s) référencé(s).</p>
            </div>
            <a href="{{ route('admin.programs.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                Nouveau programme
            </a>
        </div>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Programme</th>
                    <th class="px-5 py-3">Pays</th>
                    <th class="px-5 py-3">Mis en avant</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($programs as $program)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3">
                            <p class="font-semibold text-gray-900">{{ $program->name }}</p>
                            <p class="text-xs text-gray-400">{{ $program->full_name }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $program->country ?? '—' }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $program->featured ? 'Oui' : 'Non' }}</td>
                        <td class="px-5 py-3">
                            @if ($program->status === 'active')
                                <span class="text-[10px] font-bold uppercase bg-green-50 text-green-600 px-2 py-1 rounded-full">Actif</span>
                            @else
                                <span class="text-[10px] font-bold uppercase bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Archivé</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.programs.edit', $program) }}" class="text-xs font-semibold text-gray-600 hover:text-gray-900">Modifier</a>
                                <form method="POST" action="{{ route('admin.programs.destroy', $program) }}"
                                    onsubmit="return confirm('Supprimer ce programme ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucun programme référencé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $programs->links() }}</div>
</x-admin-layout>

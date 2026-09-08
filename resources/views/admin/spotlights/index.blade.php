<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Talent de la semaine</h1>
        <p class="text-sm text-gray-500 mt-1">Choisissez le créatif mis en avant sur la page « Talent of the Week ».</p>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl p-6 mb-8 max-w-2xl">
        <h2 class="font-bold text-gray-900 text-sm mb-4">Mettre en avant un nouveau talent</h2>
        <form method="POST" action="{{ route('admin.spotlights.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Créatif</label>
                <select name="creatif_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Sélectionner un créatif</option>
                    @foreach ($creatifs as $creatif)
                        <option value="{{ $creatif->id }}">{{ $creatif->prenom }} {{ $creatif->nom }} · {{ $creatif->specialite }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Libellé de la semaine</label>
                <input type="text" name="week_label" placeholder="Semaine 01" required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Note (optionnelle)</label>
                <textarea name="note" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                Mettre en avant
            </button>
        </form>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Créatif</th>
                    <th class="px-5 py-3">Semaine</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($spotlights as $spotlight)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3 font-semibold text-gray-900">
                            {{ $spotlight->creatif->prenom ?? '-' }} {{ $spotlight->creatif->nom ?? '' }}
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $spotlight->week_label }}</td>
                        <td class="px-5 py-3">
                            @if ($spotlight->is_current)
                                <span class="text-[10px] font-bold uppercase bg-green-50 text-green-600 px-2 py-1 rounded-full">En avant</span>
                            @else
                                <span class="text-[10px] font-bold uppercase bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Archivé</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-3">
                                @unless ($spotlight->is_current)
                                    <form method="POST" action="{{ route('admin.spotlights.current', $spotlight) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Mettre en avant</button>
                                    </form>
                                @endunless
                                <form method="POST" action="{{ route('admin.spotlights.destroy', $spotlight) }}"
                                    onsubmit="return confirm('Supprimer cette mise en avant ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-400">Aucun talent mis en avant pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $spotlights->links() }}</div>
</x-admin-layout>

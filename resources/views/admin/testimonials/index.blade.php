<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-gray-900">Témoignages</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $testimonials->total() }} témoignage(s). Affichés sur la page d'accueil.</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                Ajouter un témoignage
            </a>
        </div>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Auteur</th>
                    <th class="px-5 py-3">Citation</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($testimonials as $testimonial)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3">
                            <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                            <p class="text-xs text-gray-400">{{ $testimonial->role }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-600 max-w-md"><p class="line-clamp-2">{{ $testimonial->quote }}</p></td>
                        <td class="px-5 py-3">
                            @if ($testimonial->is_active)
                                <span class="text-[10px] font-bold uppercase bg-green-50 text-green-600 px-2 py-1 rounded-full">Visible</span>
                            @else
                                <span class="text-[10px] font-bold uppercase bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Masqué</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-xs font-semibold text-gray-600 hover:text-gray-900">Modifier</a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                    onsubmit="return confirm('Supprimer ce témoignage ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-400">
                            Aucun témoignage pour le moment. La section n'apparaît pas sur le site tant qu'il n'y en a pas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $testimonials->links() }}</div>
</x-admin-layout>

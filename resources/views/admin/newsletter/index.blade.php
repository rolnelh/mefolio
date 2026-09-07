<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Newsletter</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $subscribers->total() }} abonné(s).</p>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Email</th>
                    <th class="px-5 py-3">Source</th>
                    <th class="px-5 py-3">Inscrit le</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($subscribers as $subscriber)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3 font-semibold text-gray-900">{{ $subscriber->email }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $subscriber->source ?? '—' }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $subscriber->created_at->format('d/m/Y') }}</td>
                        <td class="px-5 py-3 text-right">
                            <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}"
                                onsubmit="return confirm('Retirer cet abonné ?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-semibold text-red-500 hover:text-red-700">Retirer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-400">Aucun abonné pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $subscribers->links() }}</div>
</x-admin-layout>

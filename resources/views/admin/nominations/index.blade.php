<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Nominations de talents</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $nominations->total() }} nomination(s) reçue(s) de la communauté.</p>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Talent proposé</th>
                    <th class="px-5 py-3">Raison</th>
                    <th class="px-5 py-3">Proposé par</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($nominations as $nomination)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3">
                            <p class="font-semibold text-gray-900">{{ $nomination->creatif_name }}</p>
                            <p class="text-xs text-gray-400">{{ $nomination->contact_email }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-600 max-w-sm"><p class="line-clamp-2">{{ $nomination->reason }}</p></td>
                        <td class="px-5 py-3 text-gray-500">{{ $nomination->nominator->username ?? 'Anonyme' }}</td>
                        <td class="px-5 py-3">
                            <form method="POST" action="{{ route('admin.nominations.status', $nomination) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-xs font-semibold border border-gray-200 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    @foreach (['pending' => 'En attente', 'approved' => 'Approuvée', 'rejected' => 'Rejetée'] as $val => $label)
                                        <option value="{{ $val }}" @selected($nomination->status === $val)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <form method="POST" action="{{ route('admin.nominations.destroy', $nomination) }}"
                                onsubmit="return confirm('Supprimer cette nomination ?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucune nomination reçue pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $nominations->links() }}</div>
</x-admin-layout>

<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-gray-900">Commentaires</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $comments->total() }} commentaire(s) publié(s).</p>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Auteur</th>
                    <th class="px-5 py-3">Commentaire</th>
                    <th class="px-5 py-3">Projet</th>
                    <th class="px-5 py-3">Date</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($comments as $comment)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3 font-semibold text-gray-900">{{ $comment->user->username ?? '-' }}</td>
                        <td class="px-5 py-3 text-gray-600 max-w-sm">
                            <p class="line-clamp-2">{{ $comment->body }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-500">
                            @if ($comment->project)
                                <a href="{{ route('projects.show', $comment->project->slug) }}" target="_blank" class="hover:text-indigo-600">
                                    {{ $comment->project->title }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-5 py-3 text-right">
                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}"
                                onsubmit="return confirm('Supprimer ce commentaire ?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucun commentaire trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $comments->links() }}</div>
</x-admin-layout>

<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-gray-900">Blog</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $posts->total() }} article(s).</p>
            </div>
            <a href="{{ route('admin.posts.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                Nouvel article
            </a>
        </div>
    </x-slot>

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-[11px] font-bold uppercase tracking-wider text-gray-400">
                <tr>
                    <th class="px-5 py-3">Titre</th>
                    <th class="px-5 py-3">Catégorie</th>
                    <th class="px-5 py-3">Statut</th>
                    <th class="px-5 py-3">Auteur</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($posts as $post)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-5 py-3 font-semibold text-gray-900">{{ $post->title }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $post->category ?? '—' }}</td>
                        <td class="px-5 py-3">
                            @if ($post->status === 'published')
                                <span class="text-[10px] font-bold uppercase bg-green-50 text-green-600 px-2 py-1 rounded-full">Publié</span>
                            @else
                                <span class="text-[10px] font-bold uppercase bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Brouillon</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $post->author->username ?? '—' }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-3">
                                @if ($post->status === 'published')
                                    <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Voir</a>
                                @endif
                                <a href="{{ route('admin.posts.edit', $post) }}" class="text-xs font-semibold text-gray-600 hover:text-gray-900">Modifier</a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                    onsubmit="return confirm('Supprimer cet article ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400">Aucun article pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
</x-admin-layout>

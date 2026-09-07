<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-8">
            <h1 class="text-2xl font-black text-gray-900">Messages</h1>
            <p class="text-sm text-gray-400 mt-1">Vos conversations avec les autres membres de Mefolio.</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            @forelse ($conversations as $conversation)
                @php $other = $conversation->other; $creatif = $other->creatif; @endphp
                <a href="{{ route('messages.show', $other) }}"
                    class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0 {{ $conversation->unread ? 'bg-indigo-50/40' : '' }}">
                    <img src="{{ $creatif?->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($other->username) . '&background=6366f1&color=fff' }}"
                        class="w-11 h-11 rounded-full object-cover flex-shrink-0">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <p class="text-sm font-bold text-gray-900 truncate">
                                {{ $creatif?->prenom ? $creatif->prenom . ' ' . $creatif->nom : $other->username }}
                            </p>
                            <span class="text-[11px] text-gray-400 flex-shrink-0">{{ $conversation->last->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-gray-500 truncate mt-0.5">
                            {{ $conversation->last->sender_id === auth()->id() ? 'Vous : ' : '' }}{{ $conversation->last->body }}
                        </p>
                    </div>
                    @if ($conversation->unread)
                        <span class="w-2 h-2 rounded-full bg-indigo-600 flex-shrink-0"></span>
                    @endif
                </a>
            @empty
                <div class="text-center py-16 text-gray-400">
                    <p class="text-sm font-medium">Aucune conversation pour le moment.</p>
                    <a href="{{ route('creatifs.index') }}"
                        class="inline-block mt-2 text-indigo-600 font-semibold text-xs hover:underline">
                        Découvrir des créatifs →
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @php $creatif = $otherUser->creatif; @endphp

        <a href="{{ route('messages.index') }}"
            class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour aux messages
        </a>

        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100">
            <img src="{{ $creatif?->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->username) . '&background=6366f1&color=fff' }}"
                class="w-11 h-11 rounded-full object-cover">
            <div>
                <p class="font-bold text-gray-900">
                    {{ $creatif?->prenom ? $creatif->prenom . ' ' . $creatif->nom : $otherUser->username }}
                </p>
                @if ($creatif?->slug)
                    <a href="{{ route('creatifs.show', $creatif->slug) }}" class="text-xs text-indigo-600 hover:underline">
                        Voir le profil
                    </a>
                @endif
            </div>
        </div>

        <div class="space-y-3 mb-6">
            @forelse ($messages as $message)
                <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] rounded-2xl px-4 py-2.5 text-sm leading-relaxed {{ $message->sender_id === auth()->id() ? 'bg-indigo-600 text-white rounded-br-sm' : 'bg-gray-100 text-gray-800 rounded-bl-sm' }}">
                        <p class="whitespace-pre-line">{{ $message->body }}</p>
                        <p class="text-[10px] mt-1 opacity-60">{{ $message->created_at->format('d M à H:i') }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-sm text-gray-400 py-10">Aucun message pour le moment. Envoyez le premier !</p>
            @endforelse
        </div>

        <form method="POST" action="{{ route('messages.store', $otherUser) }}" class="flex items-end gap-2">
            @csrf
            <textarea name="body" rows="2" required placeholder="Écrire un message..."
                class="flex-1 px-4 py-3 border border-gray-200 rounded-2xl text-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            <button type="submit"
                class="flex-shrink-0 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl transition-all">
                Envoyer
            </button>
        </form>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
    </div>
</x-app-layout>

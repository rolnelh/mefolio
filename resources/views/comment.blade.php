<div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">
        <h2 class="text-xl font-black text-gray-900">Commentaires</h2>
        <span class="bg-indigo-50 text-indigo-600 text-xs font-bold px-2.5 py-1 rounded-lg border border-indigo-100">
            {{ $project->comments->whereNull('parent_id')->count() }}
        </span>
    </div>

    {{-- Messages flash --}}
    @if (session('success'))
        <div
            class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div
            class="mb-6 flex items-center gap-3 p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl text-sm font-medium">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    {{-- Formulaire en haut --}}
    <div class="mb-8 pb-8 border-b border-gray-100">
        @auth
            <form action="{{ route('comments.store', $project->id) }}" method="POST">
                @csrf
                <div class="flex gap-4 items-start">
                    @php $userPhoto = Auth::user()->creatif?->photo; @endphp
                    @if ($userPhoto)
                        <img src="{{ $userPhoto }}"
                            class="w-10 h-10 rounded-xl object-cover flex-shrink-0 ring-2 ring-indigo-50">
                    @else
                        <div
                            class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-sm font-black flex-shrink-0">
                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1">
                        <textarea name="body" rows="3"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent py-3 px-4 resize-none transition-all placeholder:text-gray-400"
                            placeholder="Partagez vos impressions sur ce projet..." required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-md shadow-indigo-200 hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                </svg>
                                Publier
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="flex items-center gap-4 p-5 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                <div class="w-10 h-10 rounded-xl bg-gray-200 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 flex-1">
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Connectez-vous</a>
                    pour laisser un commentaire.
                </p>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-indigo-600 text-white text-xs font-bold rounded-xl hover:bg-indigo-700 transition-all whitespace-nowrap">
                    S'inscrire
                </a>
            </div>
        @endauth
    </div>

    {{-- Liste commentaires --}}
    <div class="space-y-8">
        @forelse($project->comments->whereNull('parent_id') as $comment)
            <div x-data="{ showReply: false }" class="group">
                <div class="flex items-start gap-4">

                    {{-- Avatar --}}
                    @php
                        $commentPhoto = $comment->user->creatif?->photo;
                        $commentName = $comment->user->creatif?->prenom ?? ($comment->user->username ?? 'Utilisateur');
                        $commentSlug = $comment->user->creatif?->slug;
                    @endphp

                    @if ($commentSlug)
                        <a href="{{ route('creatifs.show', $commentSlug) }}" class="flex-shrink-0">
                        @else
                            <div class="flex-shrink-0">
                    @endif
                    @if ($commentPhoto)
                        <img src="{{ $commentPhoto }}" alt="{{ $commentName }}"
                            class="w-11 h-11 rounded-2xl object-cover ring-2 ring-gray-100 shadow-sm">
                    @else
                        <div
                            class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-black text-sm">
                            {{ strtoupper(substr($commentName, 0, 1)) }}
                        </div>
                    @endif
                    @if ($commentSlug)
                        </a>
                    @else
                </div>
        @endif

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2 mb-1">
                <div class="flex items-center gap-2">
                    @if ($commentSlug)
                        <a href="{{ route('creatifs.show', $commentSlug) }}"
                            class="text-sm font-bold text-gray-900 hover:text-indigo-600 transition-colors">
                            {{ $commentName }} {{ $comment->user->creatif?->nom ?? '' }}
                        </a>
                    @else
                        <span class="text-sm font-bold text-gray-900">{{ $commentName }}</span>
                    @endif
                    @if ($comment->user_id === $project->user_id)
                        <span
                            class="text-[9px] bg-indigo-600 text-white font-black px-2 py-0.5 rounded-full uppercase tracking-wide">Auteur</span>
                    @endif
                </div>
                <span
                    class="text-[11px] text-gray-400 whitespace-nowrap">{{ $comment->created_at->diffForHumans() }}</span>
            </div>

            <p class="text-sm text-gray-600 leading-relaxed">{{ $comment->body }}</p>

            {{-- Bouton répondre (propriétaire du projet uniquement) --}}
            @auth
                @if (auth()->id() === $project->user_id && $comment->replies->isEmpty() && $comment->user_id !== auth()->id())
                    <button @click="showReply = !showReply"
                        class="inline-flex items-center gap-1.5 mt-3 text-xs font-semibold text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        <span x-text="showReply ? 'Annuler' : 'Répondre'"></span>
                    </button>

                    <div x-show="showReply" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0" class="mt-4">
                        <form action="{{ route('comments.store', $project->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <div class="flex gap-3">
                                <textarea name="body" rows="2"
                                    class="flex-1 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent py-2.5 px-3 resize-none"
                                    placeholder="Votre réponse..." required></textarea>
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all self-end">
                                    Répondre
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            @endauth

            {{-- Réponse --}}
            @if ($comment->replies->count() > 0)
                @php $reply = $comment->replies->first(); @endphp
                <div class="mt-4 ml-2 bg-indigo-50/60 border border-indigo-100/50 rounded-2xl p-4">
                    <div class="flex items-start gap-3">
                        @php
                            $replyPhoto = $reply->user->creatif?->photo;
                            $replyName = $reply->user->creatif?->prenom ?? ($reply->user->username ?? 'Auteur');
                            $replySlug = $reply->user->creatif?->slug;
                        @endphp
                        @if ($replyPhoto)
                            <img src="{{ $replyPhoto }}" class="w-8 h-8 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div
                                class="w-8 h-8 rounded-xl bg-indigo-200 text-indigo-700 flex items-center justify-center font-black text-xs flex-shrink-0">
                                {{ strtoupper(substr($replyName, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-gray-900">{{ $replyName }}</span>
                                <span
                                    class="text-[9px] bg-indigo-600 text-white font-black px-2 py-0.5 rounded-full uppercase">Auteur</span>
                                <span
                                    class="text-[10px] text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $reply->body }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@empty
<div class="text-center py-12">
    <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
    </div>
    <p class="text-sm text-gray-400 font-medium">Aucun commentaire pour l'instant.</p>
    <p class="text-xs text-gray-300 mt-1">Soyez le premier à donner votre avis !</p>
</div>
@endforelse
</div>
</div>

<div
    class="max-w-3xl mx-auto mt-16 bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
            Commentaires
            <span class="text-indigo-500 text-sm font-bold bg-indigo-50 dark:bg-indigo-900/30 px-2 py-1 rounded-lg">
                {{ $project->comments->count() }}
            </span>
        </h2>
    </div>


    <div class="space-y-10">
        @forelse ($project->comments as $comment)

        <div x-data="{ showReply: false }" class="group">
                <div class="flex items-start gap-4">

                    <a href="{{ route('creatifs.show', $comment->user->creatif->id) }}"
                        class="flex-shrink-0 transition-transform hover:scale-110">
                        <img src="{{ $comment->user->creatif->photo ? asset('storage/' . $comment->user->creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=6366f1&color=fff' }}"
                            alt="avatar"
                            class="w-12 h-12 rounded-2xl object-cover border-2 border-white dark:border-gray-700 shadow-sm">
                    </a>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">

                            <a href="{{ route('creatifs.show', $comment->user->creatif->id) }}"
                                class="font-bold text-gray-900 dark:text-white hover:text-indigo-600 transition-colors">
                                {{ $comment->user->creatif->prenom ?? $comment->user->name }}
                                {{ $comment->user->creatif->nom ?? '' }}
                            </a>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <p class="text-gray-600 dark:text-gray-400 mt-2 leading-relaxed text-sm">
                            {{ $comment->body }}
                        </p>


                        @auth
                            @if (auth()->id() === $project->user_id && $comment->replies->isEmpty())
                                <button type="button" @click="showReply = !showReply"
                                    class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-tighter text-gray-400 mt-3 hover:text-indigo-600 transition-colors cursor-pointer">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    <span x-text="showReply ? 'Annuler' : 'Répondre'"></span>
                                </button>

                                <div x-show="showReply" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0" class="mt-4">
                                    <form action="{{ route('comments.store', $project->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <div class="relative">
                                            <input type="text" name="body"
                                                class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 py-3 pl-4 pr-12 shadow-inner"
                                                placeholder="Écrivez votre réponse..." required>
                                            <button type="submit"
                                                class="absolute right-2 top-2 p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-xl transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>


                @if ($comment->replies->count())
                    <div
                        class="mt-6 ml-14 bg-indigo-50/50 dark:bg-indigo-900/10 p-5 rounded-3xl border border-indigo-100/50 dark:border-indigo-800/30">
                        @php $reply = $comment->replies->first(); @endphp
                        <div class="flex items-start gap-4">
                            <a href="{{ route('creatifs.show', $reply->user->creatif->id) }}" class="flex-shrink-0">
                                <img src="{{ $reply->user->creatif->photo ? asset('storage/' . $reply->user->creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}"
                                    alt="avatar"
                                    class="w-8 h-8 rounded-xl object-cover border border-white shadow-sm">
                            </a>
                            <div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('creatifs.show', $reply->user->creatif->id) }}"
                                        class="text-sm font-bold text-gray-900 dark:text-white hover:text-indigo-600 transition-colors">
                                        {{ $reply->user->creatif->prenom ?? $reply->user->name }}
                                    </a>
                                    <span
                                        class="px-2 py-0.5 bg-indigo-600 text-[9px] font-black text-white uppercase tracking-widest rounded-md">Auteur</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                    {{ $reply->body }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-12">
                <div
                    class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Soyez le premier à donner votre avis.</p>
            </div>
        @endforelse
    </div>


    <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-700">
        @auth
            <form action="{{ route('comments.store', $project->id) }}" method="POST">
                @csrf
                <div class="flex gap-4">
                    <img src="{{ auth()->user()->creatif->photo ? asset('storage/' . auth()->user()->creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                        alt="avatar"
                        class="w-12 h-12 rounded-2xl object-cover border-2 border-white dark:border-gray-700 shadow-sm">
                    <div class="flex-1 relative group">
                        <textarea name="body" rows="1"
                            class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-indigo-500 py-3 px-4 pr-14 transition-all resize-none shadow-inner"
                            placeholder="Partagez vos impressions..." required></textarea>
                        <button type="submit"
                            class="absolute right-2 top-2 p-2 bg-indigo-600 text-white rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition transform active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div
                class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-3xl text-center border border-dashed border-gray-200 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Vous avez un avis ?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Connectez-vous</a>
                    pour participer.
                </p>
            </div>
        @endauth
    </div>
</div>

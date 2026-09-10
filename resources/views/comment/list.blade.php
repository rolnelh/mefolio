{{--
    Fragment "liste des commentaires" d'un projet.

    Utilisé de deux façons : inclus depuis comment.blade.php pour le rendu
    initial de la page, ET renvoyé tel quel (rendu côté serveur, voir
    CommentController::listResponse()) comme réponse JSON après un
    ajout/modification/suppression en AJAX — mefolioComments() (dans
    comment.blade.php) remplace alors le contenu de #comments-list par ce
    HTML, sans recharger la page. D'où l'importance de garder ce fragment
    autonome (pas de dépendance à un état déjà présent dans la page).

    Variable attendue : $project (\App\Models\Project), avec sa relation
    "comments" chargée — voir Project::comments(), qui filtre déjà les
    commentaires racine et charge leurs réponses + auteurs.
--}}
@forelse ($project->comments as $comment)
    <div x-data="{ showReply: false, editing: false }" class="group">
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
            <span class="text-[11px] text-gray-400 whitespace-nowrap">
                {{ $comment->created_at->diffForHumans() }}
                @if ($comment->created_at->ne($comment->updated_at))
                    <span class="italic text-gray-300">(modifié)</span>
                @endif
            </span>
        </div>

        <p class="text-sm text-gray-600 leading-relaxed" x-show="!editing">{{ $comment->body }}</p>

        @auth
            @if (auth()->id() === $comment->user_id && $comment->estModifiable())
                <form x-show="editing" @submit.prevent="submitEdit($event, {{ $comment->id }})" class="mt-1">
                    <textarea name="body" rows="2" required maxlength="1000"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent py-2.5 px-3 resize-none">{{ $comment->body }}</textarea>
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" @click="editing = false"
                            class="px-3 py-1.5 text-xs font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all">
                            Enregistrer
                        </button>
                    </div>
                </form>
            @endif
        @endauth

        <div class="flex items-center gap-4 mt-3">
            {{-- Bouton répondre (propriétaire du projet uniquement) --}}
            @auth
                @if (auth()->id() === $project->user_id && $comment->replies->isEmpty() && $comment->user_id !== auth()->id())
                    <button @click="showReply = !showReply"
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        <span x-text="showReply ? 'Annuler' : 'Répondre'"></span>
                    </button>
                @endif

                {{-- Modifier / Supprimer (auteur du commentaire, pendant le délai) --}}
                @if (auth()->id() === $comment->user_id && $comment->estModifiable())
                    <button type="button" x-show="!editing" @click="editing = true"
                        class="text-xs font-semibold text-gray-400 hover:text-indigo-600 transition-colors">
                        Modifier
                    </button>
                    <button type="button" @click="deleteComment({{ $comment->id }})"
                        class="text-xs font-semibold text-gray-400 hover:text-red-600 transition-colors">
                        Supprimer
                    </button>
                @endif
            @endauth
        </div>

        <div x-show="showReply" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0" class="mt-4">
            <form @submit.prevent="submitReply($event, {{ $comment->id }})">
                <div class="flex gap-3">
                    <textarea name="body" rows="2" required maxlength="1000"
                        class="flex-1 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent py-2.5 px-3 resize-none"
                        placeholder="Votre réponse..."></textarea>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition-all self-end">
                        Répondre
                    </button>
                </div>
            </form>
        </div>

        {{-- Réponse --}}
        @if ($comment->replies->count() > 0)
            @php $reply = $comment->replies->first(); @endphp
            <div x-data="{ editing: false }" class="mt-4 ml-2 bg-indigo-50/60 border border-indigo-100/50 rounded-2xl p-4">
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
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold text-gray-900">{{ $replyName }}</span>
                            <span
                                class="text-[9px] bg-indigo-600 text-white font-black px-2 py-0.5 rounded-full uppercase">Auteur</span>
                            <span class="text-[10px] text-gray-400">
                                {{ $reply->created_at->diffForHumans() }}
                                @if ($reply->created_at->ne($reply->updated_at))
                                    <span class="italic text-gray-300">(modifié)</span>
                                @endif
                            </span>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed" x-show="!editing">{{ $reply->body }}</p>

                        @auth
                            @if (auth()->id() === $reply->user_id && $reply->estModifiable())
                                <form x-show="editing" @submit.prevent="submitEdit($event, {{ $reply->id }})" class="mt-1">
                                    <textarea name="body" rows="2" required maxlength="1000"
                                        class="w-full bg-white border border-indigo-100 rounded-xl text-xs text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent py-2 px-3 resize-none">{{ $reply->body }}</textarea>
                                    <div class="flex justify-end gap-2 mt-2">
                                        <button type="button" @click="editing = false"
                                            class="px-3 py-1 text-[11px] font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                                            Annuler
                                        </button>
                                        <button type="submit"
                                            class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-[11px] rounded-lg transition-all">
                                            Enregistrer
                                        </button>
                                    </div>
                                </form>

                                <button type="button" x-show="!editing" @click="editing = true"
                                    class="mt-2 text-[11px] font-semibold text-gray-400 hover:text-indigo-600 transition-colors">
                                    Modifier
                                </button>
                                <button type="button" @click="deleteComment({{ $reply->id }})"
                                    class="mt-2 ml-3 text-[11px] font-semibold text-gray-400 hover:text-red-600 transition-colors">
                                    Supprimer
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endif
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

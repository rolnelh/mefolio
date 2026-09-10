{{--
    Section "Commentaires" d'une page projet (resources/views/projects/show.blade.php).

    Orchestrateur : affiche l'en-tête, le formulaire de nouveau commentaire,
    puis inclut resources/views/comment/list.blade.php pour la liste
    elle-même. L'ajout, la modification et la suppression d'un commentaire
    se font en AJAX (voir mefolioComments() plus bas) : #comments-list est
    remplacé par le fragment HTML renvoyé par le serveur, sans rechargement
    de page. Le formulaire principal garde malgré tout une action/méthode
    HTML classiques en repli si JavaScript est indisponible (voir
    CommentController::store()).

    Variable attendue : $project (\App\Models\Project).
--}}
<div x-data="mefolioComments(@js(route('comments.store', $project)))" class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-8">
        <h2 class="text-xl font-black text-gray-900">Commentaires</h2>
        <span id="comments-count"
            class="bg-indigo-50 text-indigo-600 text-xs font-bold px-2.5 py-1 rounded-lg border border-indigo-100">
            {{ $project->comments->count() }}
        </span>
    </div>

    {{-- Messages flash (repli sans JS) --}}
    @if (session('success'))
        <div
            class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl text-sm font-medium">
             {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div
            class="mb-6 flex items-center gap-3 p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl text-sm font-medium">
             {{ session('error') }}
        </div>
    @endif

    {{-- Erreur d'une action AJAX (ajout, modification, suppression) --}}
    <div x-show="errorMessage" x-cloak
        class="mb-6 flex items-center gap-3 p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl text-sm font-medium">
        <span x-text="errorMessage"></span>
    </div>

    {{-- Formulaire en haut --}}
    <div class="mb-8 pb-8 border-b border-gray-100">
        @auth
            <form action="{{ route('comments.store', $project) }}" method="POST"
                @submit.prevent="submitComment($event)">
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
                        <textarea name="body" rows="3" maxlength="1000"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent py-3 px-4 resize-none transition-all placeholder:text-gray-400"
                            placeholder="Partagez vos impressions sur ce projet..." required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" :disabled="posting"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50 text-white font-bold text-sm rounded-xl transition-all shadow-md shadow-indigo-200 hover:scale-105">
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
    <div id="comments-list" class="space-y-8">
        @include('comment.list', ['project' => $project])
    </div>
</div>

<script>
    // Composant Alpine autonome pour la section commentaires d'un projet :
    // publication, modification et suppression en AJAX, sans rechargement
    // de page (voir le commentaire en tête de fichier). En cas de succès,
    // le serveur renvoie le fragment HTML déjà à jour de la liste
    // (resources/views/comment/list.blade.php) : on remplace #comments-list
    // avec, plutôt que de reconstruire le DOM à la main côté client — une
    // seule source de vérité pour le rendu (le Blade), sur le premier
    // chargement comme sur chaque action AJAX.
    //
    // commentsUrl est l'URL de route('comments.store', $project) — déjà
    // résolue côté serveur (via la directive Blade @@js) plutôt que
    // reconstruite ici à partir de l'id du projet : Project utilise son
    // "slug" comme clé de route (voir Project::getRouteKeyName()), pas
    // son id.
    function mefolioComments(commentsUrl) {
        return {
            posting: false,
            errorMessage: '',

            csrfHeaders(extra = {}) {
                return {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    ...extra,
                };
            },

            applyResponse(data) {
                const list = document.getElementById('comments-list');
                list.innerHTML = data.html;
                window.Alpine.initTree(list);

                const badge = document.getElementById('comments-count');
                if (badge) badge.textContent = data.count;
            },

            async request(url, method, body) {
                this.errorMessage = '';

                try {
                    const res = await fetch(url, {
                        method,
                        headers: this.csrfHeaders(body ? { 'Content-Type': 'application/json' } : {}),
                        body: body ? JSON.stringify(body) : undefined,
                    });
                    const data = await res.json();

                    if (res.ok && data.success) {
                        this.applyResponse(data);
                    } else {
                        this.errorMessage = data.message || 'Une erreur est survenue.';
                    }
                } catch (e) {
                    this.errorMessage = 'Connexion impossible. Vérifiez votre connexion et réessayez.';
                }
            },

            async submitComment(event) {
                if (this.posting) return;
                this.posting = true;

                const form = event.target;
                const body = new FormData(form).get('body');

                await this.request(commentsUrl, 'POST', { body, parent_id: null });

                this.posting = false;
                form.reset();
            },

            async submitReply(event, parentId) {
                const form = event.target;
                const body = new FormData(form).get('body');

                await this.request(commentsUrl, 'POST', { body, parent_id: parentId });
            },

            async submitEdit(event, commentId) {
                const form = event.target;
                const body = new FormData(form).get('body');

                await this.request(`${commentsUrl}/${commentId}`, 'PATCH', { body });
            },

            async deleteComment(commentId) {
                if (! confirm('Supprimer ce commentaire ?')) return;

                await this.request(`${commentsUrl}/${commentId}`, 'DELETE');
            },
        };
    }
</script>

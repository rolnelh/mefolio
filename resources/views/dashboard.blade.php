{{--
    Tableau de bord du créatif connecté.

    Cette vue est volontairement un ORCHESTRATEUR fin : elle calcule les
    variables communes à plusieurs onglets (progression du profil, onglet
    actif...) puis délègue chaque section à une vue dédiée sous
    resources/views/dashboard/. Voir le commentaire en tête de chaque
    partial pour la liste des variables qu'il attend.

    Variables reçues du contrôleur (ProjectController::dashboard) :
    - $creatif          \App\Models\Creatif|null
    - $projects         Collection  Projets du créatif, avec compteurs likes/comments.
    - $totalLikes       int
    - $totalComments    int
    - $scorer           \App\Services\BuilderScoreService
    - $postedMissions   Collection  Missions publiées par l'utilisateur.
    - $appliedMissions  Collection  Candidatures envoyées par l'utilisateur.

    L'onglet affiché par défaut (avant toute interaction JS) est piloté par
    le query param ?tab=... — utile pour un lien profond ou un premier
    chargement de page. Onglets valides : projets (défaut), profil,
    productivite, missions, services, stats, parametres, paiements,
    assistant.

    Changer d'onglet ENSUITE ne recharge pas la page : les 9 onglets sont
    tous rendus côté serveur au premier chargement (leurs variables sont de
    toute façon déjà calculées, peu coûteux), puis affichés/masqués côté
    client via Alpine (x-show sur "activeTab") — voir x-dashboard-sidebar
    pour les clics qui pilotent ce state partagé, initialisé sur le conteneur
    ci-dessous et propagé à la sidebar par chaînage de scope Alpine (ne pas
    redéclarer "activeTab" dans un x-data imbriqué, ça romprait le partage).
--}}
<style>
    .hide-scrollbar {
        scrollbar-width: none;
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<x-app-layout>
    @php
        $couverturePath =
            $creatif && $creatif->couverture
                ? $creatif->couverture
                : 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?q=80&w=1200&auto=format&fit=crop';

        // Un profil est "complet" quand tous les champs qui le rendent
        // présentable publiquement sont renseignés. Cette même règle est
        // dupliquée dans home.blade.php et navigation.blade.php (calcul
        // local, pas de scope partagé entre vues) : si elle change, mettre
        // à jour les trois emplacements.
        $profilComplet =
            $creatif &&
            $creatif->nom &&
            $creatif->prenom &&
            $creatif->specialite &&
            $creatif->localisation &&
            $creatif->bio &&
            $creatif->portfolio_url &&
            $creatif->photo;

        $aDesProjets = !empty($projects) && count($projects) > 0;

        // Checklist d'onboarding affichée tant qu'elle n'est pas à 100%.
        $etapes = [
            'profil' => (bool) $profilComplet,
            'projet' => (bool) $aDesProjets,
        ];
        $progression = collect($etapes)->filter()->count();
        $total = count($etapes);
        $pourcentage = ($progression / $total) * 100;

        $activeTab = request()->get('tab', 'projets');

        // Le bandeau de couverture remonte visuellement derrière la nav
        // flottante (comme le hero de l'accueil), sauf s'il y a un message
        // flash au-dessus : dans ce cas on ne le fait pas remonter, pour ne
        // pas passer sous le message.
        $hasFlash = session('success') || session('error') || $errors->any();
    @endphp


    <div
        class="relative z-0 w-full h-48 sm:h-56 overflow-hidden bg-gray-200 {{ $hasFlash ? '' : '-mt-[76px] sm:-mt-[80px]' }}">
        <img src="{{ $couverturePath }}" alt="Couverture" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        <div class="absolute bottom-3 right-3">
            <a href="{{ route('creatifs.edit') }}"
                class="inline-flex items-center gap-1.5 bg-white/90 hover:bg-white text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-md transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $creatif && $creatif->couverture ? __('Changer') : __('Ajouter couverture') }}
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{--
            x-data partagé par la sidebar (aside) et la zone d'onglets
            (main) ci-dessous : voir le commentaire en tête de fichier.
        --}}
        <div class="flex flex-col lg:flex-row gap-6 items-start" x-data="{ activeTab: @js($activeTab) }">

            <aside class="w-full lg:w-auto flex-shrink-0 lg:sticky lg:top-24">
                <div class="flex flex-row items-start gap-3">
                    <x-dashboard-sidebar :active="$activeTab" />
                    @include('dashboard.profile-card')
                </div>
            </aside>

            <main class="flex-1 min-w-0 space-y-6">

                {{-- Raccourcis + stats rapides : seulement sur l'onglet Projets --}}
                <div x-show="activeTab === 'projets'" @unless ($activeTab === 'projets') style="display:none" @endunless>
                    @include('dashboard.tabs.projets-quick-actions')
                </div>

                {{-- Checklist d'onboarding : sur tous les onglets tant que le profil n'est pas complet --}}
                @if ($pourcentage < 100)
                    @include('dashboard.onboarding-checklist')
                @endif

                {{--
                    Les 9 onglets sont tous rendus ici (leurs variables sont
                    déjà calculées pour la page, coût négligeable) et
                    basculés côté client sans rechargement — voir le
                    commentaire en tête de fichier.
                --}}
                @foreach ([
                    'projets' => 'dashboard.tabs.projets-list',
                    'profil' => 'dashboard.tabs.profil-form',
                    'productivite' => 'dashboard.tabs.productivite',
                    'missions' => 'dashboard.tabs.missions',
                    'services' => 'dashboard.tabs.services',
                    'stats' => 'dashboard.tabs.stats',
                    'parametres' => 'dashboard.tabs.parametres',
                    'paiements' => 'dashboard.tabs.paiements',
                    'assistant' => 'dashboard.tabs.assistant',
                ] as $tabKey => $tabView)
                    <div x-show="activeTab === '{{ $tabKey }}'" @unless ($activeTab === $tabKey) style="display:none" @endunless>
                        @include($tabView)
                    </div>
                @endforeach

            </main>

        </div>
    </div>

</x-app-layout>

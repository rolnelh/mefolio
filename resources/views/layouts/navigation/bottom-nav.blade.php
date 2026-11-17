{{--
    Barre de navigation flottante mobile (< lg), fixée en bas de l'écran,
    sur le modèle d'une maquette fournie : pilule blanche, icônes seules
    (au trait), et un petit trait sous l'icône de la page active
    ("underline indicator"). Pas de libellé visible : chaque lien porte un
    aria-label et un title pour l'accessibilité.

    Cinq raccourcis : Accueil, Projets (loupe : explorer), Talents (coeur),
    Missions (mallette) et Profil (tableau de bord si connecté, connexion
    sinon). Aucune variable externe requise.
--}}
@php
    $liensBas = [
        [
            'libelle' => __('Accueil'),
            'href' => route('home'),
            'actif' => request()->routeIs('home'),
            'icone' => 'M3 10.5L12 3l9 7.5M5 9v10.5a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V9',
        ],
        [
            'libelle' => __('Projets'),
            'href' => route('projects.index'),
            'actif' => request()->routeIs('projects.*'),
            'icone' => 'M21 21l-5.2-5.2m0 0A7.5 7.5 0 105.2 5.2a7.5 7.5 0 0010.6 10.6z',
        ],
        [
            'libelle' => __('Talents'),
            'href' => route('creatifs.index'),
            'actif' => request()->routeIs('creatifs.*'),
            'icone' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',
        ],
        [
            'libelle' => __('Missions'),
            'href' => route('missions.index'),
            'actif' => request()->routeIs('missions.*'),
            'icone' => 'M3.75 8.25h16.5a.75.75 0 01.75.75v9.75a1.5 1.5 0 01-1.5 1.5H4.5a1.5 1.5 0 01-1.5-1.5V9a.75.75 0 01.75-.75zM8.25 8.25V6A1.5 1.5 0 019.75 4.5h4.5A1.5 1.5 0 0115.75 6v2.25M3 13.5h18',
        ],
        [
            'libelle' => auth()->check() ? __('Mon espace') : __('Connexion'),
            'href' => auth()->check() ? route('dashboard') : route('login'),
            'actif' => request()->routeIs('dashboard', 'login', 'register'),
            'icone' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0',
        ],
    ];
@endphp

<nav aria-label="{{ __('Navigation principale') }}"
    class="lg:hidden fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-xs">
    <div class="flex items-center justify-between rounded-full bg-white/95 px-3 py-2 shadow-[0_10px_30px_-10px_rgba(17,24,39,0.25)] ring-1 ring-gray-900/5 backdrop-blur-xl">
        @foreach ($liensBas as $lien)
            <a href="{{ $lien['href'] }}" aria-label="{{ $lien['libelle'] }}" title="{{ $lien['libelle'] }}"
                @if ($lien['actif']) aria-current="page" @endif
                class="group relative flex h-11 flex-1 flex-col items-center justify-center {{ $lien['actif'] ? 'text-gray-900' : 'text-gray-500 hover:text-gray-900' }} transition-colors">
                <svg class="h-[22px] w-[22px]" fill="none" stroke="currentColor" stroke-width="{{ $lien['actif'] ? '2' : '1.7' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $lien['icone'] }}" />
                </svg>
                <span class="absolute bottom-1 h-0.5 rounded-full bg-gray-900 transition-all duration-300 {{ $lien['actif'] ? 'w-4 opacity-100' : 'w-0 opacity-0' }}" aria-hidden="true"></span>
            </a>
        @endforeach
    </div>
</nav>

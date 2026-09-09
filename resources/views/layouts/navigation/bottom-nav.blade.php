{{--
    Barre de navigation flottante mobile (< lg), fixée en bas de l'écran.
    Volontairement limitée à 4 raccourcis (Accueil/Projets/Talents/Missions)
    pour ne pas surcharger l'espace disponible — chaque lien occupe 1/4 de
    la largeur (flex-1) et ne porte le fond coloré "actif" que sur son
    pastille interne (<span>), pas sur toute la colonne. Aucune variable
    externe requise.
--}}
<div class="lg:hidden fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-sm">
    <div class="bg-white/95 backdrop-blur-xl rounded-full shadow-2xl border border-gray-100 px-2 py-2 flex items-center justify-between">

        {{-- Accueil --}}
        <a href="{{ route('home') }}" class="flex-1 flex justify-center">
            <span
                class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('home') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
                <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[9px] font-bold">{{ __('Accueil') }}</span>
            </span>
        </a>

        {{-- Projets --}}
        <a href="{{ route('projects.index') }}" class="flex-1 flex justify-center">
            <span
                class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('projects.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
                <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('projects.index') ? 'currentColor' : 'none' }}"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="text-[9px] font-bold">{{ __('Projets') }}</span>
            </span>
        </a>

        {{-- Talents --}}
        <a href="{{ route('creatifs.index') }}" class="flex-1 flex justify-center">
            <span
                class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('creatifs.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
                <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('creatifs.index') ? 'currentColor' : 'none' }}"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-[9px] font-bold">{{ __('Talents') }}</span>
            </span>
        </a>

        {{-- Missions --}}
        <a href="{{ route('missions.index') }}" class="flex-1 flex justify-center">
            <span
                class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('missions.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
                <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('missions.index') ? 'currentColor' : 'none' }}"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-[9px] font-bold">{{ __('Missions') }}</span>
            </span>
        </a>

    </div>
</div>

<nav x-data="{
    open: false,
    lastPos: window.scrollY,
    showNav: true,
    openProfile: false,
    openMore: false
}" x-init="window.addEventListener('scroll', () => {
    let currentPos = window.scrollY;
    showNav = currentPos < lastPos || currentPos < 50;
    lastPos = currentPos;
})"
    :class="{ 'translate-y-0': showNav, '-translate-y-full': !showNav && !open }"
    class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-gray-800 transition-transform duration-300 ease-in-out">

    <div class="max-w-auto mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="transition-transform hover:scale-105">
                    <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                </a>
                <a href="{{ route('vision') }}"
                    class="hidden lg:inline-flex items-center gap-1.5 bg-indigo-950 border border-indigo-800 text-indigo-300 text-[10px] font-bold px-2.5 py-1 rounded-full hover:border-indigo-600 transition-all">
                    🚧 2.0
                </a>

                <div class="hidden lg:flex items-center gap-1 ml-4">

                    {{-- Explorer --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                            Explorer
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-2 z-50">
                            <a href="{{ route('projects.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">🎨</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Projets créatifs</p>
                                    <p class="text-xs text-gray-400">Explorez les réalisations</p>
                                </div>
                            </a>
                            <a href="{{ route('services.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">🛠️</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Services <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Commandez des services</p>
                                </div>
                            </a>
                            <a href="{{ route('talentoftheweek.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">🏆</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Talent of the Week</p>
                                    <p class="text-xs text-gray-400">Le talent de la semaine</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Talents --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                            Découvrez les Talents
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-2 z-50">
                            <a href="{{ route('creatifs.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">👥</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Tous les créatifs</p>
                                    <p class="text-xs text-gray-400">Découvrez les talents</p>
                                </div>
                            </a>
                            <a href="{{ route('creatifs.localisation') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 opacity-60 transition-colors">
                                <span class="text-lg">📍</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Par localisation <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Trouvez près de chez vous</p>
                                </div>
                            </a>
                            <a href="{{ route('creatifs.domaine') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 opacity-60 transition-colors">
                                <span class="text-lg">🎯</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Par domaine <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Design, Dev, Photo...</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('missions.index') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                        Trouver des Missions
                    </a>

                    {{-- Communauté --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                            Notre Communauté
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-2 z-50">
                            <a href="{{ route('blog') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">📝</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Blog</p>
                                    <p class="text-xs text-gray-400">Actualités et inspiration</p>
                                </div>
                            </a>
                            <a href="{{ route('challenges.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 opacity-60 transition-colors">
                                <span class="text-lg">⚡</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Challenges <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Compétitions et défis</p>
                                </div>
                            </a>
                            <a href="{{ route('hackathons.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">🚀</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Programmes & Hackathons</p>
                                    <p class="text-xs text-gray-400">ASSIN, Sèmè City et plus</p>
                                </div>
                            </a>
                            <div class="border-t border-gray-100 my-2"></div>
                            <a href="{{ route('vision') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                <span class="text-lg">🌍</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Notre Vision</p>
                                    <p class="text-xs text-gray-400">Africa 2030</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- DROITE DESKTOP --}}
            <div class="hidden lg:flex items-center gap-2">
                @auth
                    @php
                        $creatif = Auth::user()->creatif;
                        $profilComplet =
                            $creatif &&
                            $creatif->nom &&
                            $creatif->prenom &&
                            $creatif->specialite &&
                            $creatif->localisation &&
                            $creatif->bio &&
                            $creatif->portfolio_url &&
                            $creatif->photo;
                    @endphp

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    @if ($profilComplet)
                        <a href="{{ route('projets.create') }}"
                            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-md shadow-indigo-200 transition-all hover:scale-105">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Partager
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}"
                            class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 border border-amber-200 text-xs font-semibold px-4 py-2 rounded-full transition-all hover:bg-amber-100">
                            ⚠️ Compléter profil
                        </a>
                    @endif

                    {{-- Notifs --}}
                    <div class="relative" x-data="{ openNotify: false }">
                        <button @click="openNotify = !openNotify"
                            class="p-2 text-gray-500 hover:text-indigo-600 transition-colors relative">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                        </button>
                        <div x-show="openNotify" @click.outside="openNotify = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl py-2 border border-gray-100 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Notifications</h3>
                            </div>
                            <div class="px-4 py-8 text-center text-sm text-gray-400">
                                Aucune notification pour le moment.
                            </div>
                        </div>
                    </div>

                    {{-- User dropdown --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-1.5 bg-gray-50 py-1 pl-2 pr-1 rounded-full border border-gray-200 hover:bg-gray-100 transition-all">
                                <span class="text-xs font-semibold text-gray-700">
                                    {{ $creatif?->prenom ?? Auth::user()->username }}
                                </span>
                                @if ($creatif?->photo)
                                    <img src="{{ $creatif->photo }}"
                                        class="h-7 w-7 rounded-full object-cover border-2 border-white shadow-sm">
                                @else
                                    <div
                                        class="h-7 w-7 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                    </div>
                                @endif
                                <svg class="w-3 h-3 text-gray-400 mr-1" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-400">Connecté en tant que</p>
                                <p class="text-sm font-bold truncate text-gray-800">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">🏠 Tableau de bord</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">👤 Mon Profil</x-dropdown-link>
                            @if (!$profilComplet)
                                <x-dropdown-link :href="route('creatifs.edit')" class="text-amber-600 font-semibold">
                                    ⚠️ Compléter mon profil
                                </x-dropdown-link>
                            @endif
                            <hr class="border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500">
                                    Déconnexion
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm mr-5 font-semibold text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition hover:scale-105">
                        S'inscrire
                    </a>
                @endauth
            </div>

            <div class="flex items-center lg:hidden">
                @auth
                    @php
                        $creatif = Auth::user()->creatif ?? null;
                        $profilComplet =
                            $creatif &&
                            $creatif->nom &&
                            $creatif->prenom &&
                            $creatif->specialite &&
                            $creatif->localisation &&
                            $creatif->bio &&
                            $creatif->portfolio_url &&
                            $creatif->photo;
                    @endphp
                    <div class="relative" x-data="{ openProfile: false }">
                        <button @click="openProfile = !openProfile" @click.outside="openProfile = false"
                            class="flex items-center gap-1.5">
                            @if ($creatif?->photo)
                                <img src="{{ $creatif->photo }}"
                                    class="h-8 w-8 rounded-full object-cover border-2 border-indigo-100">
                            @else
                                <div
                                    class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                                    {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                            @endif
                            <svg class="w-3.5 h-3.5 text-gray-400 transition-transform"
                                :class="{ 'rotate-180': openProfile }" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="openProfile" @click.outside="openProfile = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 top-full mt-3 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden">

                            {{-- Header --}}
                            <div class="px-4 py-3 bg-gradient-to-r from-indigo-50 to-violet-50 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    @if ($creatif?->photo)
                                        <img src="{{ $creatif->photo }}" class="h-10 w-10 rounded-xl object-cover">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-black">
                                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $creatif?->prenom ?? Auth::user()->username }}</p>
                                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-2">
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <span>🏠</span><span class="text-sm font-semibold text-gray-700">Dashboard</span>
                                </a>
                                <a href="{{ route('talentoftheweek.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <span>🏆</span><span class="text-sm font-semibold text-gray-700">Talent of the
                                        Week</span>
                                </a>
                                <a href="{{ route('hackathons.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <span>🚀</span><span class="text-sm font-semibold text-gray-700">Programmes &
                                        Hackathons</span>
                                </a>
                                <a href="{{ route('blog') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <span>📝</span><span class="text-sm font-semibold text-gray-700">Blog</span>
                                </a>
                                <a href="{{ route('challenges.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <span>⚡</span>
                                    <span class="text-sm font-semibold text-gray-700">Challenges</span>
                                    <span
                                        class="ml-auto text-[10px] bg-amber-100 text-amber-600 font-semibold px-1.5 py-0.5 rounded-full">Bientôt</span>
                                </a>
                                <a href="{{ route('vision') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <span>🌍</span><span class="text-sm font-semibold text-gray-700">Notre Vision</span>
                                </a>

                                <div class="border-t border-gray-100 my-2"></div>

                                @if (!$profilComplet)
                                    <a href="{{ route('creatifs.edit') }}"
                                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 transition-colors mb-1">
                                        <span>⚠️</span><span class="text-sm font-semibold text-amber-700">Compléter mon
                                            profil</span>
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-50 transition-colors text-red-500">
                                        <span>🚪</span><span class="text-sm font-semibold">Déconnexion</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-indigo-600">Connexion</a>
                @endauth
            </div>

        </div>
    </div>
</nav>


<div class="lg:hidden fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-sm">
    <div
        class="bg-white/95 backdrop-blur-xl rounded-full shadow-2xl border border-gray-100 px-2 py-2 flex items-center justify-around">

        {{-- Accueil --}}
        <a href="{{ route('home') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('home') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-bold">Accueil</span>
        </a>

        {{-- Projets --}}
        <a href="{{ route('projects.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('projects.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('projects.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="text-[10px] font-bold">Projets</span>
        </a>

        {{-- Talents --}}
        <a href="{{ route('creatifs.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('creatifs.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('creatifs.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-[10px] font-bold">Talents</span>
        </a>

        {{-- Missions --}}
        <a href="{{ route('missions.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('missions.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('missions.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="text-[10px] font-bold">Missions</span>
        </a>

        {{-- Services --}}
        <a href="{{ route('services.index') }}"
            class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-full {{ request()->routeIs('services.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-5 h-5" fill="{{ request()->routeIs('services.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
            </svg>
            <span class="text-[10px] font-bold">Services</span>
        </a>

    </div>
</div>

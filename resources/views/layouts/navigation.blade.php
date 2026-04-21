<nav x-data="{
    open: false,
    lastPos: window.scrollY,
    showNav: true
}" x-init="window.addEventListener('scroll', () => {
    let currentPos = window.scrollY;
    showNav = currentPos < lastPos || currentPos < 50;
    lastPos = currentPos;
})"
    :class="{ 'translate-y-0': showNav, '-translate-y-full': !showNav && !open }"
    class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-gray-800 transition-transform duration-300 ease-in-out">

    <div class="max-w-auto mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LOGO --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="transition-transform hover:scale-105">
                    <x-application-logo class="block h-8 w-auto fill-current text-indigo-600" />
                </a>

                {{-- LIENS DESKTOP --}}
                <div class="hidden lg:flex items-center gap-1">

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
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors group">
                                <span class="text-lg">🎨</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Projets créatifs</p>
                                    <p class="text-xs text-gray-400">Explorez les réalisations</p>
                                </div>
                            </a>

                            <a href="{{ route('services.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                <span class="text-lg">🛠️</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Services</p>
                                    <p class="text-xs text-gray-400">Commandez des services</p>
                                </div>
                            </a>
                            <a href="{{ route('talentoftheweek.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                <span class="text-lg">🏆</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Talent of the Week
                                    </p>
                                    <p class="text-xs text-gray-400">Le talent de la semaine</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                            Talents
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-2 z-50">
                            <a href="{{ route('creatifs.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                <span class="text-lg">👥</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Tous les créatifs</p>
                                    <p class="text-xs text-gray-400">Découvrez les talents</p>
                                </div>
                            </a>
                            <a href="creatifs.localisation"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 opacity-60 transition-colors">
                                <span class="text-lg">📍</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Par localisation
                                        <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Trouvez près de chez vous</p>
                                </div>
                            </a>
                            <a href="creatifs.domaine"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 opacity-60 transition-colors">
                                <span class="text-lg">🎯</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Par domaine <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Design, Dev, Photo...</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('missions.index') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
                        Trouver les Missions
                    </a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">Notre
                            Communauté
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-2 z-50">
                            <a href="{{ route('blog') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                <span class="text-lg">📝</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Blog</p>
                                    <p class="text-xs text-gray-400">Actualités et inspiration</p>
                                </div>
                            </a>
                            <a href="challenges.index"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 opacity-60 transition-colors">
                                <span class="text-lg">⚡</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Challenges créatifs
                                        <span
                                            class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span>
                                    </p>
                                    <p class="text-xs text-gray-400">Compétitions et défis</p>
                                </div>
                            </a>
                            <a href="{{ route('hackathons.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                <span class="text-lg">🚀</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Programmes &
                                        Hackathons
                                    </p>
                                    <p class="text-xs text-gray-400">ASSIN, Sèmè City et plus</p>
                                </div>
                            </a>
                            <div class="border-t border-gray-100 dark:border-gray-700 my-2"></div>
                            <a href="{{ route('register') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 transition-colors">
                                <span class="text-lg">🤝</span>
                                <div>
                                    <p class="text-sm font-semibold text-indigo-700">Rejoindre Mefolio</p>
                                    <p class="text-xs text-indigo-400">Créer mon profil gratuit</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('vision') }}"
                        class="hidden lg:inline-flex items-center gap-1.5 bg-indigo-950 border border-indigo-800 text-indigo-300 text-[10px] font-bold px-3 py-1 rounded-full hover:border-indigo-600 transition-all">
                        🚧 Mefolio 2.0
                    </a>

                </div>
            </div>

            <div class="hidden lg:flex items-center gap-3">
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

                    @if ($profilComplet)
                        <a href="{{ route('projets.create') }}"
                            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-md shadow-indigo-200 transition-all hover:scale-105">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Partager un projet
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}"
                            class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 border border-amber-200 text-xs font-semibold px-4 py-2 rounded-full transition-all hover:bg-amber-100">
                            ⚠️ Compléter profil
                        </a>
                    @endif

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
                            class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-2xl shadow-xl py-2 border border-gray-100 dark:border-gray-700 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Notifications</h3>
                            </div>
                            <div class="px-4 py-8 text-center text-sm text-gray-400">
                                Aucune notification pour le moment.
                            </div>
                        </div>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 bg-gray-50 dark:bg-gray-800 py-1.5 pl-3 pr-1.5 rounded-full border border-gray-200 hover:bg-gray-100 transition-all">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
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
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-400">Connecté en tant que</p>
                                <p class="text-sm font-bold truncate text-gray-800">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">Tableau de bord</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">Mon Profil</x-dropdown-link>
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
                        class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition hover:scale-105">
                        S'inscrire
                    </a>
                @endauth
            </div>

            <div class="flex items-center lg:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-xl bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 transition">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden lg:hidden bg-white dark:bg-gray-900 border-t border-gray-100">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('projects.index') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Explorer les
                Projets
            </a>
            <a href="{{ route('creatifs.index') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Découvrir les
                Créatifs</a>
            <a href="{{ route('missions.index') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Missions
                Freelance</a>
            <a href="{{ route('vision.index') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Missions
                Vision Mefolio</a>
            <a href="{{ route('services.index') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Missions
                Servies</a>
            <a href="{{ route('talentoftheweek.index') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Missions
                Talents oh the week</a>
            <a href="{{ route('blog') }}"
                class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg"> Blog</a>
            <div class="opacity-60">
                <a href="{{ route('hackathons.index') }}"
                    class="block px-3 py-2 text-sm font-medium text-gray-700 hover:bg-indigo-50 rounded-lg">Programmes
                    &
                    Hackathons</a>
                <span class="block px-3 py-2 text-sm font-medium text-gray-700">⚡ Challenges <span
                        class="text-[10px] bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded-full ml-1">Bientôt</span></span>
            </div>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
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
                <div class="flex items-center gap-3 mb-3">
                    @if ($creatif?->photo)
                        <img src="{{ $creatif->photo }}" class="h-9 w-9 rounded-full object-cover">
                    @else
                        <div
                            class="h-9 w-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $creatif?->prenom ?? Auth::user()->username }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                @if ($profilComplet)
                    <a href="{{ route('projets.create') }}"
                        class="block w-full text-center py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl mb-2">+
                        Partager un projet</a>
                @else
                    <a href="{{ route('creatifs.edit') }}"
                        class="block w-full text-center py-2.5 bg-amber-50 text-amber-600 border border-amber-200 text-sm font-bold rounded-xl mb-2">⚠️
                        Compléter mon profil</a>
                @endif
                <a href="{{ route('dashboard') }}"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg">Tableau de bord</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button onclick="event.preventDefault(); this.closest('form').submit();"
                        class="w-full text-left px-3 py-2 text-sm text-red-500 hover:bg-red-50 rounded-lg">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block w-full text-center py-2.5 border border-gray-200 text-gray-700 text-sm font-bold rounded-xl mb-2">Connexion</a>
                <a href="{{ route('register') }}"
                    class="block w-full text-center py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl">S'inscrire
                    gratuitement</a>
            @endauth
        </div>
    </div>
</nav>

<nav x-data="{
    open: false,
    lastPos: window.scrollY,
    showNav: true
}" x-init="window.addEventListener('scroll', () => {
    let currentPos = window.scrollY;
    showNav = currentPos < lastPos || currentPos < 50;
    lastPos = currentPos;
})"
    :class="{
        'translate-y-0': showNav,
        '-translate-y-full': !showNav && !open
    }"
    class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-gray-800 transition-transform duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="transition-transform hover:scale-105">
                        <x-application-logo class="block h-10 w-auto fill-current text-indigo-600 dark:text-white" />
                    </a>
                </div>

                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">Explorer les projets</x-nav-link>
                    <x-nav-link :href="route('creatifs.index')" :active="request()->routeIs('creatifs.index')">Créatifs</x-nav-link>
                    <x-nav-link :href="route('missions.index')" :active="request()->routeIs('missions.index')">Missions Freelance</x-nav-link>
                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')">Blog</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                @auth
                    {{-- Bouton Partager un projet --}}
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
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-full shadow-md shadow-indigo-200 dark:shadow-none transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Partager un projet
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}" x-data
                            @click.prevent="
                                $dispatch('notify', { message: 'Complétez votre profil avant de partager un projet.', type: 'warning' });
                                window.location.href = '{{ route('creatifs.edit') }}';
                            "
                            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-indigo-50 text-gray-500 hover:text-indigo-600 text-sm font-semibold px-4 py-2 rounded-full border border-gray-200 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Partager un projet
                        </a>
                    @endif

                    {{-- Notifications --}}
                    <div class="relative" x-data="{ openNotify: false }">
                        <button @click="openNotify = !openNotify"
                            class="p-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition-colors relative">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
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
                            class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg py-2 border border-gray-100 dark:border-gray-700 z-50">
                            <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Notifications</h3>
                            </div>
                            <div class="px-4 py-8 text-center text-sm text-gray-400">
                                Aucune notification pour le moment.
                            </div>
                        </div>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center space-x-3 bg-gray-50 dark:bg-gray-800 py-1.5 pl-3 pr-1 rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 transition-all shadow-sm">
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                    {{ Auth::user()->creatif?->prenom ?? Auth::user()->username }}
                                </span>
                                <div class="relative">
                                    @if (Auth::user()->creatif && Auth::user()->creatif->photo)
                                    <img src="{{ Auth::user()->creatif->photo }}" />
                                    @else
                                     <div
                                            class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                </div>
                                @endif
                </div>
                </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-400">Connecté en tant que</p>
                        <p class="text-sm font-bold truncate text-gray-800 dark:text-white">
                            {{ Auth::user()->email }}</p>
                    </div>
                    <x-dropdown-link :href="route('dashboard')">Tableau de bord</x-dropdown-link>
                    <x-dropdown-link :href="route('profile.edit')">Mon Profil</x-dropdown-link>
                    @if (!$profilComplet)
                        <x-dropdown-link :href="route('creatifs.edit')" class="text-amber-600 font-semibold">
                            ⚠️ Compléter mon profil
                        </x-dropdown-link>
                    @endif
                    <hr class="border-gray-100 dark:border-gray-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-500">
                            Déconnexion
                        </x-dropdown-link>
                    </form>
                </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition transform hover:-translate-y-0.5">
                    S'inscrire
                </a>
            @endauth
        </div>

        <div class="-me-2 flex items-center sm:hidden">
            @auth
                <button class="p-2 text-gray-400 hover:text-indigo-600 transition relative">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500"></span>
                </button>
            @endauth
            <button @click="open = ! open"
                class="p-2 rounded-xl bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">Explorer les projets</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('creatifs.index')" :active="request()->routeIs('creatifs.index')">Créatifs</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('missions.index')" :active="request()->routeIs('missions.index')">Missions Freelance</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')">Blog</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-100 dark:border-gray-800">
            @auth

                <div class="px-4 mb-3">
                    @if ($profilComplet)
                        <a href="{{ route('projets.create') }}"
                            class="flex items-center justify-center gap-2 w-full bg-indigo-600 text-white text-sm font-semibold px-4 py-2.5 rounded-xl">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Partager un projet
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}"
                            class="flex items-center justify-center gap-2 w-full bg-amber-50 text-amber-600 border border-amber-200 text-sm font-semibold px-4 py-2.5 rounded-xl">
                            ⚠️ Compléter mon profil pour partager
                        </a>
                    @endif
                </div>

                <div class="flex items-center px-4 mb-4">
                    <div class="flex-shrink-0">
                        @if (Auth::user()->creatif && Auth::user()->creatif->photo)
                            <img src="{{ Auth::user()->creatif->photo }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <div
                                class="h-10 w-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="ms-3">
                        <div class="font-bold text-base text-gray-800 dark:text-white">
                            {{ Auth::user()->creatif?->prenom ?? Auth::user()->username }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')">Tableau de bord</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">Mon Profil</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500">
                            Déconnexion
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="p-4 space-y-2">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center py-2 text-gray-600 font-bold border border-gray-200 rounded-xl">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center py-2 bg-indigo-600 text-white font-bold rounded-xl shadow-lg">Inscription</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

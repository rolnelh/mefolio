<nav x-data="{
    open: false,
    lastPos: window.scrollY,
    showNav: true
}" x-init="window.addEventListener('scroll', () => {
    let currentPos = window.scrollY;
    // On affiche si on remonte OU si on est tout en haut
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
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Accueil</x-nav-link>
                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">Explorer les projets</x-nav-link>

                    <x-nav-link :href="route('creatifs.index')" :active="request()->routeIs('creatifs.index')">
                        Tous les créatifs
                    </x-nav-link>

                    {{-- <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none transition duration-150 ease-in-out h-20">
                                <span>Créatifs</span>
                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-64 dark:bg-gray-800">
                                <x-dropdown-link :href="route('creatifs.index')"
                                    class="font-bold border-b border-gray-100 dark:border-gray-700 py-3">
                                    Tous les créatifs
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('creatifs.index', ['domaine' => 'design'])" class="whitespace-nowrap py-2.5">
                                    🎨 Design & Illustration
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('creatifs.index', ['domaine' => 'photo'])" class="whitespace-nowrap py-2.5">
                                    📸 Photographie
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('creatifs.index', ['domaine' => 'video'])" class="whitespace-nowrap py-2.5">
                                    🎥 Vidéo & Animation
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('creatifs.index', ['domaine' => 'web'])" class="whitespace-nowrap py-2.5">
                                    💻 Développement Web
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown> --}}

                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')">Blog</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                @auth
                    <div class="relative" x-data="{ openNotify: false }">
                        <button @click="openNotify = !openNotify"
                            class="p-2 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition-colors relative">
                            <span class="sr-only">Voir les notifications</span>

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
                            <div class="max-h-80 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
                                <a href="#"
                                    class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150 group">
                                    <div class="flex-shrink-0 relative">
                                        <div
                                            class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 8.25h9m-9 3h9m-9 3h3m-12.15 3.921a1.718 1.718 0 0 1-1.938-1.57c-.66-5.437.902-10.836 4.582-15.201M5.25 15h9a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-9a3 3 0 0 0-3 3v6a3 3 0 0 0 3 3Z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-gray-800 bg-blue-600"></span>
                                    </div>

                                    <div class="w-full ps-3">
                                        <div class="flex justify-between items-start mb-0.5">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Nouveau message
                                                reçu</h4>
                                            <span class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">À
                                                l'instant</span>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                            Sophie vous a envoyé un message : "Bonjour ! Votre projet m'intéresse beaucoup,
                                            pourrions-nous en discuter ?"
                                        </p>
                                    </div>
                                </a>

                                <a href="#"
                                    class="flex px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 flex items-center justify-center">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-full ps-3">
                                        <div class="flex justify-between items-start mb-0.5">
                                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200">Projet validé
                                            </h4>
                                            <span class="text-xs text-gray-500 dark:text-gray-500">Il y a 2h</span>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-500 line-clamp-1">
                                            Félicitations, votre projet "Portfolio Créatif" a été approuvé.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <a href="#"
                                class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 border-t border-gray-100 dark:border-gray-700">
                                <div class="inline-flex items-center">
                                    Voir toutes les notifications
                                </div>
                            </a>
                        </div>
                    </div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center space-x-3 bg-gray-50 dark:bg-gray-800 py-1.5 pl-3 pr-1 rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 transition-all shadow-sm">
                                <span class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                    {{ Auth::user()->creatif?->nom ?? Auth::user()->username }}
                                    {{ Auth::user()->creatif?->prenom ?? '' }}
                                    <div class="relative">
                                        @if (Auth::user()->creatif && Auth::user()->creatif->photo)
                                            <img src="{{ asset('storage/' . Auth::user()->creatif->photo) }}"
                                                class="h-8 w-8 rounded-full object-cover border-2 border-white dark:border-gray-700 shadow-sm">
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
                            <hr class="border-gray-100 dark:border-gray-700">
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
                    <div class="space-x-6"">
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition transform hover:-translate-y-0.5">
                            S'inscrire
                        </a>
                    </div>
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
        class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Accueil</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">Explorer les projets</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('creatifs.index')" :active="request()->routeIs('creatifs.index')">Créatifs</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')">Blog</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-100 dark:border-gray-800">
            @auth
                <div class="flex items-center px-4 mb-4">
                    <div class="flex-shrink-0">
                        @if (Auth::user()->creatif && Auth::user()->creatif->photo)
                            <img src="{{ asset('storage/' . Auth::user()->creatif->photo) }}"
                                class="h-10 w-10 rounded-full object-cover">
                        @else
                            <div
                                class="h-10 w-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="ms-3">
                        <div class="font-bold text-base text-gray-800 dark:text-white">{{ Auth::user()->username }}</div>
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

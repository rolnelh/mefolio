<nav x-data="{ open: false }"
    class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-gray-800">
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
                    <x-nav-link :href="route('creatifs.index')" :active="request()->routeIs('creatifs.index')">Créatifs</x-nav-link>
                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')">Blog</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center space-x-3 bg-gray-50 dark:bg-gray-800 py-1.5 pl-3 pr-1 rounded-full border border-gray-200 dark:border-gray-700 hover:bg-gray-100 transition-all shadow-sm">
                                <span
                                    class="text-sm font-bold text-gray-700 dark:text-gray-200">{{ Auth::user()->username }}</span>

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
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition transform hover:-translate-y-0.5">
                        S'inscrire
                    </a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
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

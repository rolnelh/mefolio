<div class="sticky top-0 z-50 pt-3 sm:pt-4 px-2 sm:px-6 lg:px-8 pointer-events-none">
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
    :class="{ 'translate-y-0': showNav, '-translate-y-24': !showNav && !open }"
    class="pointer-events-auto max-w-6xl mx-auto bg-white/95 backdrop-blur-md border border-gray-100 rounded-full shadow-lg shadow-gray-900/5 transition-transform duration-300 ease-in-out">

    <div class="px-4 sm:px-6">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 transition-transform hover:scale-[1.02]">
                    <x-application-logo class="block h-7 w-auto fill-current text-indigo-600" />
                    <span class="font-bold text-lg text-gray-900 tracking-tight">Mefolio</span>
                </a>

                <div class="hidden lg:flex items-center gap-1">

                    {{-- Explorer --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
                            Explorer
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute top-full left-0 mt-3 w-[440px] bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 grid grid-cols-2 gap-x-4">
                            <div>
                                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Découvrir</p>
                                <x-nav-dropdown-item :href="route('projects.index')" title="Projets créatifs" description="Explorez les réalisations" />
                                <x-nav-dropdown-item :href="route('creatifs.index')" title="Tous les créatifs" description="Découvrez les talents" />
                            </div>
                            <div>
                                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Reconnaissance</p>
                                <x-nav-dropdown-item :href="route('classement.index')" title="Classement" description="Les meilleurs Builder Score" />
                                <x-nav-dropdown-item :href="route('talentoftheweek.index')" title="Talent of the Week" description="Le talent de la semaine" />
                            </div>
                        </div>
                    </div>

                    {{-- Missions & services --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
                            Missions
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute top-full left-0 mt-3 w-[440px] bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 grid grid-cols-2 gap-x-4">
                            <div>
                                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Freelance</p>
                                <x-nav-dropdown-item :href="route('missions.index')" title="Trouver des missions" description="Freelance rémunéré" />
                            </div>
                            <div>
                                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Gérer</p>
                                @auth
                                    <x-nav-dropdown-item :href="route('missions.create')" title="Publier une mission" description="Trouvez un créatif" />
                                    <x-nav-dropdown-item :href="route('missions.mine')" title="Mes missions" description="Publications et candidatures" />
                                @endauth
                                <x-nav-dropdown-item :href="route('services.index')" title="Services" description="Commandez des services créatifs" badge="Bientôt" muted />
                            </div>
                        </div>
                    </div>

                    {{-- Challenges --}}
                    <a href="{{ route('challenges.index') }}"
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
                        Challenges
                    </a>

                    {{-- Communauté --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
                            Communauté
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute top-full left-0 mt-3 w-[440px] bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 grid grid-cols-2 gap-x-4">
                            <div>
                                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Contenu</p>
                                <x-nav-dropdown-item :href="route('blog')" title="Blog" description="Actualités et inspiration" />
                                <x-nav-dropdown-item :href="route('hackathons.index')" title="Programmes & Hackathons" description="ASSIN, Sèmè City et plus" />
                            </div>
                            <div>
                                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">À propos</p>
                                <a href="mailto:contact@mefolio.com"
                                    class="flex items-start px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group">
                                    <span class="min-w-0">
                                        <span class="text-sm font-semibold text-gray-900">Nous contacter</span>
                                        <span class="block text-xs text-gray-400 mt-0.5">contact@mefolio.com</span>
                                    </span>
                                </a>
                            </div>
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

                    {{-- Recherche rapide --}}
                    <div class="relative" x-data="{ openSearch: false }">
                        <button @click="openSearch = !openSearch; $nextTick(() => openSearch && $refs.navSearchInput.focus())"
                            class="p-2 text-gray-500 hover:text-indigo-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                        <div x-show="openSearch" @click.outside="openSearch = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-xl p-3 border border-gray-100 z-50">
                            <form method="GET" action="{{ route('projects.index') }}">
                                <input x-ref="navSearchInput" type="text" name="q" placeholder="Rechercher un projet..."
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </form>
                        </div>
                    </div>

                    {{-- Messages --}}
                    @php $navUnreadMessages = \App\Models\Message::where('recipient_id', Auth::id())->whereNull('read_at')->count(); @endphp
                    <a href="{{ route('messages.index') }}" class="p-2 text-gray-500 hover:text-indigo-600 transition-colors relative">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        @if ($navUnreadMessages > 0)
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                        @endif
                    </a>

                    {{-- Notifs --}}
                    @php
                        $navNotifications = Auth::user()->notifications()->latest()->take(8)->get();
                        $navUnreadCount = Auth::user()->unreadNotifications()->count();
                        $navNotifIcons = [
                            'project' => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653',
                            'project_updated' => 'M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10',
                            'project_deleted' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
                            'like' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                            'profile' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',
                            'message' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75',
                        ];
                    @endphp
                    <div class="relative" x-data="{ openNotify: false }">
                        <button @click="openNotify = !openNotify"
                            class="p-2 text-gray-500 hover:text-indigo-600 transition-colors relative">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                            @if ($navUnreadCount > 0)
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                            @endif
                        </button>
                        <div x-show="openNotify" @click.outside="openNotify = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">
                            <div class="flex items-center justify-between px-4 py-2.5 border-b border-gray-100">
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Notifications</h3>
                                @if ($navUnreadCount > 0)
                                    <form method="POST" action="{{ route('notifications.read-all') }}">
                                        @csrf
                                        <button type="submit" class="text-[11px] font-semibold text-indigo-600 hover:underline">
                                            Tout marquer comme lu
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @forelse ($navNotifications as $notification)
                                    <a href="{{ $notification->data['url'] ?? '#' }}"
                                        class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0 {{ is_null($notification->read_at) ? 'bg-indigo-50/40' : '' }}">
                                        <span class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="{{ $navNotifIcons[$notification->data['icon'] ?? 'project'] ?? $navNotifIcons['project'] }}" />
                                            </svg>
                                        </span>
                                        <span class="min-w-0 flex-1">
                                            <span class="block text-xs font-bold text-gray-900">{{ $notification->data['title'] ?? '' }}</span>
                                            <span class="block text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $notification->data['message'] ?? '' }}</span>
                                            <span class="block text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</span>
                                        </span>
                                        @if (is_null($notification->read_at))
                                            <span class="w-1.5 h-1.5 bg-indigo-600 rounded-full flex-shrink-0 mt-1.5"></span>
                                        @endif
                                    </a>
                                @empty
                                    <div class="px-4 py-8 text-center text-sm text-gray-400">
                                        Aucune notification pour le moment.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- User dropdown --}}
                    <x-dropdown align="right" width="52">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 pl-1 pr-1 py-1 rounded-full hover:bg-gray-50 transition-all">
                                <span class="relative flex-shrink-0">
                                    @if ($creatif?->photo)
                                        <img src="{{ $creatif->photo }}"
                                            class="h-8 w-8 rounded-full object-cover">
                                    @else
                                        <div
                                            class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-green-500 border-2 border-white"></span>
                                </span>
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-100">
                                <span class="flex-shrink-0">
                                    @if ($creatif?->photo)
                                        <img src="{{ $creatif->photo }}" class="h-9 w-9 rounded-full object-cover">
                                    @else
                                        <div class="h-9 w-9 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                                            {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                        </div>
                                    @endif
                                </span>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold truncate text-gray-800">
                                        Bonjour, {{ $creatif?->prenom ?? Auth::user()->username }}
                                    </p>
                                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">Tableau de bord</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">Mon Profil</x-dropdown-link>
                            @if ($creatif?->slug)
                                <x-dropdown-link :href="route('creatifs.show', $creatif->slug)">Voir mon profil public</x-dropdown-link>
                            @endif
                            @if (Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')">Administration</x-dropdown-link>
                            @endif
                            @if (!$profilComplet)
                                <x-dropdown-link :href="route('creatifs.edit')" class="text-amber-600 font-semibold">
                                    Compléter mon profil
                                </x-dropdown-link>
                            @endif
                            <hr class="border-gray-100">
                            <x-dropdown-link href="mailto:contact@mefolio.com">Aide</x-dropdown-link>
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
                        class="text-sm mr-2 font-semibold text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-full text-sm font-bold transition">
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
                            <span class="relative flex-shrink-0">
                                @if ($creatif?->photo)
                                    <img src="{{ $creatif->photo }}"
                                        class="h-8 w-8 rounded-full object-cover">
                                @else
                                    <div
                                        class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-green-500 border-2 border-white"></span>
                            </span>
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
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
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
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Dashboard</span>
                                </a>
                                <a href="{{ $profilComplet ? route('projets.create') : route('creatifs.edit') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Créer un projet</span>
                                </a>
                                @if ($creatif?->slug)
                                    <a href="{{ route('creatifs.show', $creatif->slug) }}"
                                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                        <span class="text-sm font-semibold text-gray-700">Voir mon profil public</span>
                                    </a>
                                @endif
                                <a href="{{ route('missions.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Missions</span>
                                </a>
                                <a href="{{ route('talentoftheweek.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Talent of the
                                        Week</span>
                                </a>
                                <a href="{{ route('hackathons.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Programmes &
                                        Hackathons</span>
                                </a>
                                <a href="{{ route('blog') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Blog</span>
                                </a>
                                <a href="{{ route('challenges.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Challenges</span>
                                </a>
                                <a href="{{ route('services.index') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Services</span>
                                </a>
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                        <span class="text-sm font-semibold text-gray-700">Administration</span>
                                    </a>
                                @endif

                                <div class="border-t border-gray-100 my-2"></div>

                                @if (!$profilComplet)
                                    <a href="{{ route('creatifs.edit') }}"
                                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 transition-colors mb-1">
                                        <span class="text-sm font-semibold text-amber-700">Compléter mon
                                            profil</span>
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-50 transition-colors text-red-500">
                                        <span class="text-sm font-semibold">Déconnexion</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="relative flex items-center gap-1" x-data="{ openMobileMenu: false }">
                        <button @click="openMobileMenu = !openMobileMenu" @click.outside="openMobileMenu = false"
                            class="p-2 text-gray-600 hover:text-indigo-600 transition-colors" aria-label="Menu">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                            </svg>
                        </button>
                        <a href="{{ route('login') }}" class="p-2 text-gray-600 hover:text-indigo-600 transition-colors" aria-label="Connexion">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </a>

                        {{-- Menu mobile (invité) --}}
                        <div x-show="openMobileMenu" @click.outside="openMobileMenu = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 top-full mt-3 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden">
                            <div class="p-2 max-h-[70vh] overflow-y-auto">
                                <p class="px-3 pt-2 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Découvrir</p>
                                <a href="{{ route('projects.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Projets créatifs</span>
                                </a>
                                <a href="{{ route('creatifs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Tous les créatifs</span>
                                </a>
                                <a href="{{ route('classement.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Classement</span>
                                </a>
                                <a href="{{ route('talentoftheweek.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Talent of the Week</span>
                                </a>

                                <p class="px-3 pt-3 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Missions & services</p>
                                <a href="{{ route('missions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Trouver des missions</span>
                                </a>
                                <a href="{{ route('challenges.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Challenges</span>
                                </a>
                                <a href="{{ route('services.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Services</span>
                                </a>

                                <p class="px-3 pt-3 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Communauté</p>
                                <a href="{{ route('blog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Blog</span>
                                </a>
                                <a href="{{ route('hackathons.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Programmes & Hackathons</span>
                                </a>
                                <a href="mailto:contact@mefolio.com" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Nous contacter</span>
                                </a>

                                <div class="border-t border-gray-100 my-2"></div>

                                <a href="{{ route('register') }}"
                                    class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-gray-900 hover:bg-black transition-colors">
                                    <span class="text-sm font-bold text-white">S'inscrire gratuitement</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</nav>
</div>


<div class="lg:hidden fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-sm">
    <div
        class="bg-white/95 backdrop-blur-xl rounded-full shadow-2xl border border-gray-100 px-1.5 py-1.5 flex items-center gap-0 overflow-x-auto [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

        {{-- Accueil --}}
        <a href="{{ route('home') }}"
            class="flex flex-col items-center gap-0.5 px-1.5 py-1.5 rounded-full shrink-0 {{ request()->routeIs('home') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[9px] font-bold">Accueil</span>
        </a>

        {{-- Projets --}}
        <a href="{{ route('projects.index') }}"
            class="flex flex-col items-center gap-0.5 px-1.5 py-1.5 rounded-full shrink-0 {{ request()->routeIs('projects.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('projects.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="text-[9px] font-bold">Projets</span>
        </a>

        {{-- Talents --}}
        <a href="{{ route('creatifs.index') }}"
            class="flex flex-col items-center gap-0.5 px-1.5 py-1.5 rounded-full shrink-0 {{ request()->routeIs('creatifs.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('creatifs.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-[9px] font-bold">Talents</span>
        </a>

        {{-- Missions --}}
        <a href="{{ route('missions.index') }}"
            class="flex flex-col items-center gap-0.5 px-1.5 py-1.5 rounded-full shrink-0 {{ request()->routeIs('missions.index') ? 'bg-indigo-600 text-white' : 'text-gray-500 hover:text-indigo-600' }} transition-all">
            <svg class="w-[18px] h-[18px]" fill="{{ request()->routeIs('missions.index') ? 'currentColor' : 'none' }}"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="text-[9px] font-bold">Missions</span>
        </a>

    </div>
</div>

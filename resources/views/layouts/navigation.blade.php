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
                            class="absolute top-full left-0 mt-3 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-50">
                            <x-nav-dropdown-item :href="route('projects.index')" color="indigo"
                                icon="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-19.5 0v6a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25v-6m-19.5 0h19.5M8.25 21v-9"
                                title="Projets créatifs" description="Explorez les réalisations" />
                            <x-nav-dropdown-item :href="route('creatifs.index')" color="violet"
                                icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                                title="Tous les créatifs" description="Découvrez les talents" />
                            <x-nav-dropdown-item :href="route('classement.index')" color="amber"
                                icon="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35"
                                title="Classement" description="Les meilleurs Builder Score" />
                            <x-nav-dropdown-item :href="route('talentoftheweek.index')" color="pink"
                                icon="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"
                                title="Talent of the Week" description="Le talent de la semaine" />
                        </div>
                    </div>

                    {{-- Missions & services --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
                            Missions
                            <span class="bg-indigo-100 text-indigo-600 text-[9px] font-bold uppercase px-1.5 py-0.5 rounded-full">Nouveau</span>
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute top-full left-0 mt-3 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-50">
                            <x-nav-dropdown-item :href="route('missions.index')" color="indigo"
                                icon="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653"
                                title="Trouver des missions" description="Freelance rémunéré" />
                            @auth
                                <x-nav-dropdown-item :href="route('missions.create')" color="green"
                                    icon="M12 4.5v15m7.5-7.5h-15"
                                    title="Publier une mission" description="Trouvez un créatif" />
                                <x-nav-dropdown-item :href="route('missions.mine')" color="gray"
                                    icon="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75"
                                    title="Mes missions" description="Publications et candidatures" />
                            @endauth
                            <x-nav-dropdown-item :href="route('challenges.index')" color="amber"
                                icon="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"
                                title="Challenges" description="Compétitions et défis" />
                            <x-nav-dropdown-item :href="route('services.index')" color="violet"
                                icon="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336"
                                title="Services" description="Commandez des services créatifs" badge="Bientôt" muted />
                        </div>
                    </div>

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
                            class="absolute top-full left-0 mt-3 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-50">
                            <x-nav-dropdown-item :href="route('blog')" color="indigo"
                                icon="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6 12l-1.5 1.5m1.5-1.5l1.5 1.5m-6-1.5l-1.5 1.5m0 0l-1.5-1.5m1.5 1.5V9"
                                title="Blog" description="Actualités et inspiration" />
                            <x-nav-dropdown-item :href="route('hackathons.index')" color="green"
                                icon="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347M12 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0a50.717 50.717 0 00-2.658-.814 59.906 59.906 0 0110.399-5.84"
                                title="Programmes & Hackathons" description="ASSIN, Sèmè City et plus" />
                            <div class="border-t border-gray-100 my-2"></div>
                            <x-nav-dropdown-item :href="route('vision')" color="blue"
                                icon="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m-15.432 0A8.959 8.959 0 013 12c0-.778.099-1.533.284-2.253"
                                title="Notre Vision" description="Africa 2030" />
                            <a href="mailto:contact@mefolio.com"
                                class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group">
                                <span class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center bg-gray-100 text-gray-500">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </span>
                                <span class="min-w-0">
                                    <span class="text-sm font-semibold text-gray-900">Nous contacter</span>
                                    <span class="block text-xs text-gray-400 mt-0.5">contact@mefolio.com</span>
                                </span>
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

                    <a href="{{ route('dashboard') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
                        Tableau de bord
                    </a>

                    <a href="{{ $profilComplet ? route('projets.create') : route('creatifs.edit') }}"
                        class="inline-flex items-center gap-1.5 bg-gray-900 hover:bg-black text-white text-sm font-semibold pl-3.5 pr-4 py-2 rounded-full transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.25" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Créer
                    </a>

                    {{-- Notifs --}}
                    <div class="relative" x-data="{ openNotify: false }">
                        <button @click="openNotify = !openNotify"
                            class="p-2 text-gray-500 hover:text-indigo-600 transition-colors relative">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                        </button>
                        <div x-show="openNotify" @click.outside="openNotify = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-xl py-2 border border-gray-100 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Notifications</h3>
                            </div>
                            <div class="px-4 py-8 text-center text-sm text-gray-400">
                                Aucune notification pour le moment.
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
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-400">Connecté en tant que</p>
                                <p class="text-sm font-bold truncate text-gray-800">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">Tableau de bord</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">Mon Profil</x-dropdown-link>
                            @if (Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')">Administration</x-dropdown-link>
                            @endif
                            @if (!$profilComplet)
                                <x-dropdown-link :href="route('creatifs.edit')" class="text-amber-600 font-semibold">
                                    Compléter mon profil
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
                                <a href="{{ route('vision') }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                                    <span class="text-sm font-semibold text-gray-700">Notre Vision</span>
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
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-indigo-600">Connexion</a>
                @endauth
            </div>

        </div>
    </div>
</nav>
</div>


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

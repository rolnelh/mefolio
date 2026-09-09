{{--
    Header du site : nav flottante desktop (pill, auto-hide au scroll vers
    le bas) + barre de navigation flottante mobile en bas d'écran.

    Chaque widget non trivial est délégué à une vue dédiée sous
    resources/views/layouts/navigation/ — voir le commentaire en tête de
    chaque partial pour les variables qu'il attend. Recherche rapide et
    icône Messages restent inline ici : trop courts pour mériter leur
    propre fichier.

    Aucune variable n'est attendue du contrôleur : cette vue interroge
    Auth::user() / app()->getLocale() / request() directement, comme le
    reste du layout partagé.
--}}
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

                @include('layouts.navigation.desktop-menu')
            </div>

            {{-- DROITE DESKTOP --}}
            <div class="hidden lg:flex items-center gap-2">
                @include('layouts.navigation.language-switcher')

                @auth
                    @php
                        $creatif = Auth::user()->creatif;
                        // Même règle de complétion que dashboard.blade.php / home.blade.php
                        // (calcul dupliqué localement à chaque vue, pas de scope partagé).
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
                                <input x-ref="navSearchInput" type="text" name="q" placeholder="{{ __('Rechercher un projet...') }}"
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

                    @include('layouts.navigation.notifications-dropdown')
                    @include('layouts.navigation.user-dropdown')
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm mr-2 font-semibold text-gray-600 hover:text-indigo-600 transition">{{ __('Connexion') }}</a>
                    <a href="{{ route('register') }}"
                        class="bg-gray-900 hover:bg-black text-white px-5 py-2 rounded-full text-sm font-bold transition">
                        {{ __("S'inscrire") }}
                    </a>
                @endauth
            </div>

            @include('layouts.navigation.mobile-menu')

        </div>
    </div>
</nav>
</div>

@include('layouts.navigation.bottom-nav')

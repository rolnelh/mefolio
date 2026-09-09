{{--
    Bloc mobile (< lg) à droite du header : bascule de langue, puis soit le
    menu déroulant du profil connecté, soit [icône connexion + hamburger]
    pour un invité. Aucune variable externe requise (recalcule son propre
    $creatif/$profilComplet — pas de scope partagé avec le desktop).
--}}
<div class="flex items-center gap-1 lg:hidden">
    {{-- Langue (mobile) --}}
    <a href="{{ route('locale.switch', app()->getLocale() === 'fr' ? 'en' : 'fr') }}"
        class="p-2 text-gray-500 hover:text-indigo-600 transition-colors text-[11px] font-bold uppercase"
        title="{{ app()->getLocale() === 'fr' ? 'English' : 'Français' }}">
        {{ app()->getLocale() }}
    </a>

    @auth
        @php
            $creatif = Auth::user()->creatif ?? null;
            // Même règle de complétion que dashboard.blade.php / home.blade.php.
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
                        <span class="text-sm font-semibold text-gray-700">{{ __('Créer un projet') }}</span>
                    </a>
                    @if ($creatif?->slug)
                        <a href="{{ route('creatifs.show', $creatif->slug) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                            <span class="text-sm font-semibold text-gray-700">{{ __('Voir mon profil public') }}</span>
                        </a>
                    @endif
                    <a href="{{ route('missions.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Missions') }}</span>
                    </a>
                    <a href="{{ route('talentoftheweek.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">Talent of the
                            Week</span>
                    </a>
                    <a href="{{ route('hackathons.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Programmes & Hackathons') }}</span>
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
                        <span class="text-sm font-semibold text-gray-700">{{ __('Services') }}</span>
                    </a>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                            <span class="text-sm font-semibold text-gray-700">{{ __('Administration') }}</span>
                        </a>
                    @endif

                    <div class="border-t border-gray-100 my-2"></div>

                    @if (!$profilComplet)
                        <a href="{{ route('creatifs.edit') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-amber-50 hover:bg-amber-100 transition-colors mb-1">
                            <span class="text-sm font-semibold text-amber-700">{{ __('Compléter mon profil') }}</span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-red-50 transition-colors text-red-500">
                            <span class="text-sm font-semibold">{{ __('Déconnexion') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="relative flex items-center gap-1" x-data="{ openMobileMenu: false }">
            <a href="{{ route('login') }}" class="p-2 text-gray-600 hover:text-indigo-600 transition-colors" aria-label="{{ __('Connexion') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </a>
            <button @click="openMobileMenu = !openMobileMenu" @click.outside="openMobileMenu = false"
                class="p-2 text-gray-600 hover:text-indigo-600 transition-colors" aria-label="{{ __('Menu') }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
            </button>

            {{-- Menu mobile (invité) --}}
            <div x-show="openMobileMenu" @click.outside="openMobileMenu = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="absolute right-0 top-full mt-3 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden">
                <div class="p-2 max-h-[70vh] overflow-y-auto">
                    <p class="px-3 pt-2 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ __('Découvrir') }}</p>
                    <a href="{{ route('projects.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Projets créatifs') }}</span>
                    </a>
                    <a href="{{ route('creatifs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Tous les créatifs') }}</span>
                    </a>
                    <a href="{{ route('classement.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Classement') }}</span>
                    </a>
                    <a href="{{ route('talentoftheweek.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">Talent of the Week</span>
                    </a>

                    <p class="px-3 pt-3 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ __('Missions & services') }}</p>
                    <a href="{{ route('missions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Trouver des missions') }}</span>
                    </a>
                    <a href="{{ route('challenges.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">Challenges</span>
                    </a>
                    <a href="{{ route('services.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Services') }}</span>
                    </a>

                    <p class="px-3 pt-3 pb-1 text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ __('Communauté') }}</p>
                    <a href="{{ route('blog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">Blog</span>
                    </a>
                    <a href="{{ route('hackathons.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Programmes & Hackathons') }}</span>
                    </a>
                    <a href="mailto:contact@mefolio.com" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="text-sm font-semibold text-gray-700">{{ __('Nous contacter') }}</span>
                    </a>

                    <div class="border-t border-gray-100 my-2"></div>

                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-gray-900 hover:bg-black transition-colors">
                        <span class="text-sm font-bold text-white">{{ __("S'inscrire gratuitement") }}</span>
                    </a>
                </div>
            </div>
        </div>
    @endauth
</div>

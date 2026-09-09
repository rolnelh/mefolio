{{--
    Liens de navigation desktop (Explorer / Missions & services / Challenges
    / Communauté), chacun avec son propre dropdown Alpine autonome
    (x-data local, pas de state partagé). Aucune variable externe requise.
--}}
<div class="hidden lg:flex items-center gap-1">

    {{-- Explorer --}}
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" @click.outside="open = false"
            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
            {{ __('Explorer') }}
            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute top-full left-0 mt-3 w-[440px] bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 grid grid-cols-2 gap-x-4">
            <div>
                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ __('Découvrir') }}</p>
                <x-nav-dropdown-item :href="route('projects.index')" :title="__('Projets créatifs')" :description="__('Explorez les réalisations')" />
                <x-nav-dropdown-item :href="route('creatifs.index')" :title="__('Tous les créatifs')" :description="__('Découvrez les talents')" />
            </div>
            <div>
                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ __('Reconnaissance') }}</p>
                <x-nav-dropdown-item :href="route('classement.index')" :title="__('Classement')" :description="__('Les meilleurs Builder Score')" />
                <x-nav-dropdown-item :href="route('talentoftheweek.index')" title="Talent of the Week" :description="__('Le talent de la semaine')" />
            </div>
        </div>
    </div>

    {{-- Missions & services --}}
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" @click.outside="open = false"
            class="flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 rounded-lg hover:bg-gray-50 transition-all">
            {{ __('Missions') }}
            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute top-full left-0 mt-3 w-[440px] bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 grid grid-cols-2 gap-x-4">
            <div>
                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ __('Freelance') }}</p>
                <x-nav-dropdown-item :href="route('missions.index')" :title="__('Trouver des missions')" :description="__('Freelance rémunéré')" />
            </div>
            <div>
                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ __('Gérer') }}</p>
                @auth
                    <x-nav-dropdown-item :href="route('missions.create')" :title="__('Publier une mission')" :description="__('Trouvez un créatif')" />
                    <x-nav-dropdown-item :href="route('missions.mine')" :title="__('Mes missions')" :description="__('Publications et candidatures')" />
                @endauth
                <x-nav-dropdown-item :href="route('services.index')" :title="__('Services')" :description="__('Commandez des services créatifs')" :badge="__('Bientôt')" muted />
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
            {{ __('Communauté') }}
            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute top-full left-0 mt-3 w-[440px] bg-white rounded-2xl shadow-xl border border-gray-100 p-4 z-50 grid grid-cols-2 gap-x-4">
            <div>
                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ __('Contenu') }}</p>
                <x-nav-dropdown-item :href="route('blog')" title="Blog" :description="__('Actualités et inspiration')" />
                <x-nav-dropdown-item :href="route('hackathons.index')" :title="__('Programmes & Hackathons')" :description="__('ASSIN, Sèmè City et plus')" />
            </div>
            <div>
                <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">{{ __('À propos') }}</p>
                <a href="mailto:contact@mefolio.com"
                    class="flex items-start px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group">
                    <span class="min-w-0">
                        <span class="text-sm font-semibold text-gray-900">{{ __('Nous contacter') }}</span>
                        <span class="block text-xs text-gray-400 mt-0.5">contact@mefolio.com</span>
                    </span>
                </a>
            </div>
        </div>
    </div>

</div>

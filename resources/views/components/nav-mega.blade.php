{{--
    Méga-menu de la nav desktop (layouts/navigation/desktop-menu.blade.php) :
    bouton + panneau blanc arrondi, liste de liens à gauche (slot "liens",
    des x-nav-mega-link) et cartes illustrées à droite (slot par défaut, des
    x-nav-mega-card).

    S'ouvre au survol (souris) comme au clic (clavier, tactile). Le wrapper
    n'est volontairement PAS en position relative : le panneau se positionne
    par rapport à la <nav> elle-même (la pilule, "relative" dans
    navigation.blade.php), ce qui le centre sous la nav quel que soit le
    bouton qui l'ouvre, sans déborder de l'écran pour les derniers menus.
    Le pt-3 du panneau sert de "pont" invisible : la souris peut descendre
    du bouton au panneau sans quitter le wrapper (pas de fermeture parasite).
--}}
@props(['label'])

<div x-data="{ open: false, minuterie: null }"
    @mouseenter="clearTimeout(minuterie); open = true"
    @mouseleave="minuterie = setTimeout(() => open = false, 120)"
    @keydown.escape.window="open = false">
    <button type="button" @click="open = !open" @click.outside="open = false" :aria-expanded="open"
        class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-full transition-all"
        :class="open ? 'text-gray-950 bg-gray-100' : 'text-gray-700 hover:text-gray-950 hover:bg-gray-50'">
        {{ $label }}
        <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none"
            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
        </svg>
    </button>

    <div x-show="open" x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2 scale-[0.98]"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute left-1/2 top-full z-50 -ml-[360px] w-[720px] pt-3 origin-top">
        <div class="flex rounded-[28px] bg-white p-3 shadow-2xl shadow-gray-900/15 ring-1 ring-gray-900/5">
            <div class="w-52 shrink-0 border-r border-gray-100 pr-3 py-2 space-y-4">
                {{ $liens }}
            </div>
            <div class="grid flex-1 grid-cols-2 gap-1 pl-3">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

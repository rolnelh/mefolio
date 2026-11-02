{{--
    Lien de la colonne de gauche d'un méga-menu de la nav desktop
    (layouts/navigation/desktop-menu.blade.php) : libellé seul, pastille
    grise au survol. Le détail (description, image) est porté par les
    cartes x-nav-mega-card de la colonne de droite.
--}}
@props(['href', 'badge' => null, 'muted' => false])

<a href="{{ $href }}"
    {{ $attributes->class(['flex items-center justify-between gap-2 px-3 py-2 rounded-xl text-[13px] font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-950 transition-colors', 'opacity-60' => $muted]) }}>
    <span>{{ $slot }}</span>
    @if ($badge)
        <span class="text-[10px] bg-amber-100 text-amber-600 font-bold px-1.5 py-0.5 rounded-full">{{ $badge }}</span>
    @endif
</a>

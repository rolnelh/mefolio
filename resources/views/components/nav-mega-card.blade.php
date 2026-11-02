{{--
    Carte illustrée de la colonne de droite d'un méga-menu de la nav desktop
    (layouts/navigation/desktop-menu.blade.php) : image, titre, description.
    Les images vivent dans public/images/*-menu.webp (versions réduites à
    480 px de large, chargées en lazy puisque le menu est masqué par défaut).
    Sans image (image = null), la carte affiche un aplat dégradé avec le
    titre en grand, plutôt qu'une photo.
--}}
@props(['href', 'image' => null, 'title', 'description'])

<a href="{{ $href }}" class="group block rounded-2xl p-2 hover:bg-gray-50 transition-colors">
    <span class="block aspect-[16/10] overflow-hidden rounded-xl bg-gray-100">
        @if ($image)
            <img src="{{ $image }}" alt="" loading="lazy"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <span class="flex h-full w-full items-end bg-gradient-to-br from-lime-200 via-amber-100 to-sky-200 p-4 transition-transform duration-500 group-hover:scale-105">
                <span class="font-accent text-4xl italic text-gray-900/80">{{ $title }}</span>
            </span>
        @endif
    </span>
    <span class="block mt-3 px-1 text-sm font-semibold text-gray-900">{{ $title }}</span>
    <span class="block mt-1 px-1 pb-1 text-xs leading-relaxed text-gray-500">{{ $description }}</span>
</a>

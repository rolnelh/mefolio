{{--
    Section "Tout votre parcours créatif, au même endroit" : titre centré
    sur deux lignes (la seconde en gris) et quatre tuiles cliquables
    (Portfolio, Talents, Missions, Classement). Chaque tuile montre une
    petite pile de cartes inclinées en guise d'illustration.

    Variables attendues (fournies par home.blade.php, partagées via
    @@include) :
    - $projects      Paginator   Projets récents : images de la tuile Portfolio.
    - $heroCreatifs  Collection  Créatifs avec photo : images de la tuile Talents.
    Les tuiles Missions et Classement utilisent des images fixes de
    public/images. Une tuile sans image affiche des cartes colorées.
--}}
@php
    $imagesProjets = collect($projects->items())->pluck('image')->filter()->take(3)->values();
    $imagesTalents = $heroCreatifs->pluck('photo')->filter()->take(3)->values();

    $tuiles = [
        ['titre' => __('Portfolio'), 'href' => route('projects.index'), 'images' => $imagesProjets, 'teinte' => 'bg-amber-100'],
        ['titre' => __('Talents'), 'href' => route('creatifs.index'), 'images' => $imagesTalents, 'teinte' => 'bg-sky-100'],
        ['titre' => __('Missions'), 'href' => route('missions.index'), 'images' => collect([asset('images/designer-menu.webp'), asset('images/vision-menu.webp')]), 'teinte' => 'bg-lime-100'],
        ['titre' => __('Classement'), 'href' => route('classement.index'), 'images' => collect([asset('images/challenges-menu.webp'), asset('images/talentoftheweek-menu.webp')]), 'teinte' => 'bg-violet-100'],
    ];

    // Position de chaque carte de la pile : arrière, milieu, avant.
    $pile = [
        'left-[18%] top-[22%] -rotate-[10deg]',
        'left-[34%] top-[16%] rotate-[2deg]',
        'left-[48%] top-[24%] rotate-[12deg]',
    ];
@endphp

<section class="bg-[#FAFAF8] py-24 px-6">
    <div class="max-w-3xl mx-auto text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-semibold tracking-tight leading-tight">
            <span class="text-gray-900">{{ __('Tout votre parcours créatif,') }}</span><br>
            <span class="text-gray-400">{{ __('au même endroit') }}</span>
        </h2>
    </div>

    <div class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($tuiles as $tuile)
            <a href="{{ $tuile['href'] }}"
                class="group rounded-3xl bg-white p-2 ring-1 ring-gray-900/5 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <span class="relative block aspect-square overflow-hidden rounded-[20px] bg-gray-50">
                    @for ($k = 0; $k < 3; $k++)
                        @php $image = $tuile['images'][$k] ?? null; @endphp
                        <span class="absolute {{ $pile[$k] }} w-[38%] aspect-[3/4] overflow-hidden rounded-lg bg-white p-0.5 shadow-md ring-1 ring-gray-900/5 transition-transform duration-500 group-hover:-translate-y-1"
                            style="z-index: {{ $k + 1 }}">
                            @if ($image)
                                <img src="{{ $image }}" alt="" loading="lazy" class="h-full w-full rounded-md object-cover">
                            @else
                                <span class="block h-full w-full rounded-md {{ $tuile['teinte'] }}"></span>
                            @endif
                        </span>
                    @endfor
                </span>
                <span class="block py-3 text-center text-sm font-semibold text-gray-900">{{ $tuile['titre'] }}</span>
            </a>
        @endforeach
    </div>
</section>

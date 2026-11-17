{{--
    Section "Projets récents" : grille de cartes, trois par ligne sur
    desktop (deux sur tablette, une sur mobile), sur le modèle d'une
    maquette fournie :
      - image arrondie avec une encoche en haut à droite qui porte deux
        étiquettes (technologies du projet, sinon sa catégorie) ;
      - encoche en bas à droite avec un bouton rond noir et une flèche
        vert citron vers le projet ;
      - sous l'image : titre, puis catégorie et auteur en gris.
    Les encoches sont des blocs de la couleur du fond de la section
    (blanc) posés sur l'image ; les petits arrondis "inversés" qui les
    raccordent à l'image sont des carrés dont un radial-gradient découpe
    un quart de cercle (classe .projet-coin). Si le fond de la section
    change, changer --fond-section en conséquence.

    Variables attendues : $projects (Paginator, injecté par HomeController,
    avec la relation creatif chargée). Les 6 premiers sont affichés.
--}}
@php
    $projetsAffiches = collect($projects->items())->take(6);
    $etiquettes = function ($p) {
        $techs = collect(explode(',', (string) $p->technologies))->map(fn ($t) => trim($t))->filter()->take(2);
        return $techs->isNotEmpty() ? $techs : collect([$p->category ?: __('Projet')]);
    };
@endphp

<style>
    .projet-carte { --fond-section: #ffffff; --r: 18px; }
    .projet-coin {
        position: absolute;
        width: var(--r);
        height: var(--r);
        pointer-events: none;
    }
    /* Coin à gauche de l'encoche du haut, et sous celle-ci */
    .projet-coin--haut-gauche { top: 0; right: 100%; background: radial-gradient(circle at 0 100%, transparent var(--r), var(--fond-section) calc(var(--r) + 0.5px)); }
    .projet-coin--haut-bas { top: 100%; right: 0; background: radial-gradient(circle at 0 100%, transparent var(--r), var(--fond-section) calc(var(--r) + 0.5px)); }
    /* Coin à gauche de l'encoche du bas, et au-dessus de celle-ci */
    .projet-coin--bas-gauche { bottom: 0; right: 100%; background: radial-gradient(circle at 0 0, transparent var(--r), var(--fond-section) calc(var(--r) + 0.5px)); }
    .projet-coin--bas-haut { bottom: 100%; right: 0; background: radial-gradient(circle at 0 0, transparent var(--r), var(--fond-section) calc(var(--r) + 0.5px)); }
</style>

<section class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-6">

        <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-3xl md:text-5xl font-medium tracking-tight text-gray-900">{{ __('Projets récents') }}</h2>
                <p class="mt-3 max-w-md text-gray-500">{{ __('Découvrez les dernières créations de notre communauté de talents.') }}</p>
            </div>
            <a href="{{ route('projects.index') }}"
                class="inline-flex items-center gap-2 self-start rounded-full px-5 py-2.5 text-sm font-semibold text-gray-700 ring-1 ring-gray-900/10 hover:ring-gray-900/25 transition sm:self-auto">
                {{ __('Voir toute la galerie') }} <span aria-hidden="true">→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projetsAffiches as $project)
                @php
                    $auteur = $project->creatif;
                    $lien = route('projects.show', $project->slug);
                    $sousTitre = collect([$project->category, $auteur ? trim($auteur->prenom . ' ' . $auteur->nom) : null])->filter()->implode(' · ');
                @endphp
                <article class="projet-carte group">
                    <div class="relative aspect-[4/3] overflow-hidden rounded-[28px] bg-gray-100">
                        <a href="{{ $lien }}" class="block h-full w-full" tabindex="-1" aria-hidden="true">
                            @if ($project->image)
                                <img src="{{ $project->image }}" alt="" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]">
                            @else
                                <span class="block h-full w-full bg-gradient-to-br from-gray-100 to-gray-200"></span>
                            @endif
                        </a>

                        {{-- Encoche du haut : étiquettes --}}
                        <div class="absolute right-0 top-0 flex gap-1.5 rounded-bl-[18px] bg-white pb-2 pl-2">
                            <span class="projet-coin projet-coin--haut-gauche" aria-hidden="true"></span>
                            <span class="projet-coin projet-coin--haut-bas" aria-hidden="true"></span>
                            @foreach ($etiquettes($project) as $etiquette)
                                <span class="whitespace-nowrap rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-800">{{ $etiquette }}</span>
                            @endforeach
                        </div>

                        {{-- Encoche du bas : bouton vers le projet --}}
                        <div class="absolute bottom-0 right-0 rounded-tl-[22px] bg-white pl-2 pt-2">
                            <span class="projet-coin projet-coin--bas-gauche" aria-hidden="true"></span>
                            <span class="projet-coin projet-coin--bas-haut" aria-hidden="true"></span>
                            <a href="{{ $lien }}" aria-label="{{ __('Voir le projet') }} {{ $project->title }}"
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-900 text-lime-300 transition-transform duration-300 group-hover:rotate-45">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M8 7h9v9" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <h3 class="mt-4 text-lg font-semibold text-gray-900">
                        <a href="{{ $lien }}" class="hover:underline">{{ $project->title }}</a>
                    </h3>
                    @if ($sousTitre)
                        <p class="mt-1 text-sm text-gray-500">{{ $sousTitre }}</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>

{{--
    Section "Projets récents" : carrousel horizontal de grandes cartes
    arrondies (défilement avec accroche, flèches précédent/suivant).
    Chaque carte montre l'image du projet avec son titre en bas à gauche et
    un bouton rond "+" en bas à droite. Le "+" retourne la carte : un voile
    sombre flouté affiche la description, l'auteur, les likes et un lien
    vers le projet, avec un bouton "−" pour revenir à l'image. État géré
    par un petit x-data local par carte (aucun état partagé).

    Variables attendues : $projects (Paginator, injecté par HomeController,
    avec les relations creatif et likes chargées).
--}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6" x-data>

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight leading-tight">
                    <span class="text-gray-900">{{ __('Projets récents') }}</span>
                </h2>
                <p class="mt-3 text-gray-500 max-w-md">
                    {{ __('Découvrez les dernières créations de notre communauté de talents.') }}
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('projects.index') }}"
                    class="mr-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">
                    {{ __('Voir toute la galerie') }} <span aria-hidden="true">→</span>
                </a>
                @foreach (['precedent' => -1, 'suivant' => 1] as $sens => $signe)
                    <button type="button" aria-label="{{ $sens === 'precedent' ? __('Précédent') : __('Suivant') }}"
                        @click="$refs.carrousel.scrollBy({ left: {{ $signe }} * ($refs.carrousel.clientWidth * 0.8), behavior: 'smooth' })"
                        class="flex h-10 w-10 items-center justify-center rounded-full ring-1 ring-gray-900/10 text-gray-700 hover:bg-gray-900 hover:text-white transition">
                        <svg class="h-4 w-4 {{ $signe < 0 ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endforeach
            </div>
        </div>

        <div x-ref="carrousel"
            class="-mx-6 flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth px-6 pb-4 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach ($projects as $project)
                @php
                    $auteur = $project->creatif;
                    $lien = route('projects.show', $project->slug);
                @endphp
                <article x-data="{ ouvert: false }"
                    class="relative h-[420px] w-[78vw] max-w-[340px] shrink-0 snap-start overflow-hidden rounded-[28px] bg-gray-900 shadow-lg shadow-gray-900/10">

                    {{-- Image du projet --}}
                    <a href="{{ $lien }}" class="absolute inset-0" tabindex="-1" aria-hidden="true">
                        @if ($project->image)
                            <img src="{{ $project->image }}" alt="" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-700"
                                :class="ouvert ? 'scale-110' : 'scale-100'">
                        @else
                            <span class="block h-full w-full bg-gradient-to-br from-gray-700 to-gray-900"></span>
                        @endif
                    </a>

                    {{-- Légende (face image) --}}
                    <div x-show="!ouvert" x-transition.opacity.duration.300ms
                        class="pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 via-black/30 to-transparent px-6 pb-6 pt-24 pr-20">
                        <h3 class="text-base font-semibold leading-snug text-white">
                            <a href="{{ $lien }}" class="pointer-events-auto hover:underline">{{ $project->title }}</a>
                        </h3>
                        @if ($auteur)
                            <p class="mt-1 text-xs text-white/70">{{ trim($auteur->prenom . ' ' . $auteur->nom) }}</p>
                        @endif
                    </div>

                    {{-- Description (face texte) --}}
                    <div x-show="ouvert" x-cloak x-transition.opacity.duration.300ms
                        class="absolute inset-0 flex flex-col bg-gray-900/80 p-7 pr-8 backdrop-blur-xl">
                        <p class="text-[10px] font-semibold uppercase tracking-widest text-white/50">{{ $project->category ?? __('Projet') }}</p>
                        <h3 class="mt-3 text-base font-semibold leading-snug text-white">{{ $project->title }}</h3>
                        <p class="mt-4 line-clamp-[8] text-sm leading-relaxed text-white/75">{{ $project->description }}</p>
                        <div class="mt-auto flex items-center gap-3 pr-14 pt-5 text-xs text-white/70">
                            @if ($auteur)
                                <a href="{{ route('creatifs.show', $auteur->slug) }}" class="truncate hover:text-white">{{ trim($auteur->prenom . ' ' . $auteur->nom) }}</a>
                                <span class="text-white/30">·</span>
                            @endif
                            <span class="shrink-0">{{ $project->likes->count() }} {{ trans_choice('like|likes', $project->likes->count()) }}</span>
                        </div>
                        <a href="{{ $lien }}" class="mt-3 text-sm font-semibold text-white hover:underline">{{ __('Voir le projet') }} <span aria-hidden="true">→</span></a>
                    </div>

                    {{-- Bouton + / − --}}
                    <button type="button" @click="ouvert = !ouvert" :aria-expanded="ouvert"
                        :aria-label="ouvert ? @js(__('Masquer la description')) : @js(__('Afficher la description'))"
                        class="absolute bottom-5 right-5 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-900 shadow-lg transition hover:scale-110">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" d="M5 12h14" />
                            <path x-show="!ouvert" stroke-linecap="round" d="M12 5v14" />
                        </svg>
                    </button>
                </article>
            @endforeach
        </div>
    </div>
</section>

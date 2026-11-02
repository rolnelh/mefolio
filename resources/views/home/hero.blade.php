{{--
    Section hero de la page d'accueil, mise en page centrée :
      - petit fil d'étapes ("Crée ton profil > Publie tes projets > ...") ;
      - titre centré avec un mot en italique d'accent (police font-accent) ;
      - sous-titre, bouton vert citron + bouton secondaire ;
      - preuve sociale (avatars + compteur de créatifs) ;
      - galerie de projets en perspective : une grande carte au centre,
        deux cartes empilées de chaque côté, une carte en bord d'écran de
        chaque côté, toutes inclinées vers le centre ;
      - bandeau des domaines créatifs qui défile, en fondu sur les bords.

    Variables attendues (fournies par home.blade.php) :
    - $projects      Paginator   Projets récents : ceux qui ont une image
                                  remplissent la galerie.
    - $heroCreatifs  Collection  Créatifs avec une vraie photo : avatars de la
                                  preuve sociale, et complément de la galerie
                                  s'il y a trop peu de projets avec image.
    - $creatifCount  int         Nombre total de créatifs actifs.
--}}
@php
    $heroImages = collect($projects->items())
        ->filter(fn ($p) => $p->image)
        ->map(fn ($p) => ['image' => $p->image, 'titre' => $p->title, 'url' => route('projects.show', $p->slug)])
        ->concat($heroCreatifs->map(fn ($c) => [
            'image' => $c->photo,
            'titre' => trim($c->prenom . ' ' . $c->nom),
            'url' => route('creatifs.show', $c->slug),
        ]))
        ->values();

    // Sept emplacements de la galerie, de gauche à droite. Si on a moins de
    // sept images, on les réutilise en boucle plutôt que de laisser des trous.
    $heroEmplacements = [
        ['zone' => 'bord-gauche'],
        ['zone' => 'gauche-haut'],
        ['zone' => 'gauche-bas'],
        ['zone' => 'centre'],
        ['zone' => 'droite-haut'],
        ['zone' => 'droite-bas'],
        ['zone' => 'bord-droit'],
    ];
    // La plus belle image (la plus récente) va au centre.
    $heroOrdre = [3, 1, 4, 0, 5, 2, 6];
    $heroCarte = fn (int $i) => $heroImages->count() ? $heroImages[$heroOrdre[$i] % $heroImages->count()] : null;

    $heroAvatars = $heroCreatifs->take(4);

    $heroDomaines = [
        __('Design graphique'), __('Développement web'), __('UI/UX'), __('Vidéo'),
        __('Photographie'), __('Illustration'), __('Motion design'), __('Rédaction'),
    ];
@endphp

<style>
    .hero-apparition {
        opacity: 0;
        transform: translateY(14px);
        animation: hero-apparition 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        animation-delay: var(--d, 0ms);
    }

    @keyframes hero-apparition {
        to { opacity: 1; transform: none; }
    }

    .hero-scene {
        perspective: 1600px;
        perspective-origin: 50% 40%;
    }

    .hero-carte {
        position: absolute;
        transform-style: preserve-3d;
        opacity: 0;
        transform: var(--t) translateY(60px);
        animation: hero-carte 1.1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        animation-delay: var(--d, 0ms);
    }

    @keyframes hero-carte {
        to { opacity: 1; transform: var(--t); }
    }

    .hero-carte:hover .hero-carte-cadre {
        transform: translateY(-6px);
        box-shadow: 0 30px 60px -20px rgba(17, 24, 39, 0.35);
    }

    .hero-defile {
        animation: hero-defile 40s linear infinite;
    }

    @keyframes hero-defile {
        to { transform: translateX(-50%); }
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-apparition, .hero-carte {
            animation: none;
            opacity: 1;
        }
        .hero-apparition { transform: none; }
        .hero-carte { transform: var(--t); }
        .hero-defile { animation: none; }
    }
</style>

<section class="relative overflow-hidden bg-[#FAFAF8] pt-10 sm:pt-16 pb-12">

    {{-- Léger halo vert citron derrière le titre --}}
    <div class="pointer-events-none absolute left-1/2 top-0 -translate-x-1/2 h-[420px] w-[820px] max-w-full rounded-full bg-lime-200/40 blur-3xl" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-3xl px-6 text-center">

        {{-- Fil d'étapes --}}
        <p class="hero-apparition inline-flex flex-wrap items-center justify-center gap-x-1.5 gap-y-1 rounded-full bg-white px-3.5 py-1.5 text-xs font-medium text-gray-500 shadow-sm ring-1 ring-gray-900/5" style="--d: 50ms">
            <span class="h-1.5 w-1.5 rounded-full bg-lime-400"></span>
            {{ __('Crée ton profil') }}
            <span class="text-gray-300">&gt;</span>
            {{ __('Publie tes projets') }}
            <span class="text-gray-300">&gt;</span>
            {{ __('Décroche des missions') }}
        </p>

        <h1 class="hero-apparition mt-7 text-[2.5rem] sm:text-6xl font-semibold tracking-tight text-gray-900 leading-[1.08]" style="--d: 150ms">
            {{ __('Un espace pour') }}
            <span class="font-accent italic font-normal tracking-normal">{{ __('révéler') }}</span>
            {{ __('votre talent créatif') }}
        </h1>

        <p class="hero-apparition mt-6 mx-auto max-w-xl text-base sm:text-lg text-gray-500 leading-relaxed" style="--d: 300ms">
            {{ __('Mefolio aide les créatifs africains à construire leur portfolio, trouver des missions et se connecter à une communauté qui valorise leur travail.') }}
        </p>

        @php
            $boutonPrincipal = 'inline-flex items-center justify-center gap-2 rounded-full bg-lime-300 hover:bg-lime-200 px-6 py-3 text-sm font-semibold text-gray-900 shadow-[0_8px_24px_-8px_rgba(163,230,53,0.9)] transition-all hover:-translate-y-0.5 active:scale-95';
            $boutonSecondaire = 'inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20 transition-all hover:-translate-y-0.5';
        @endphp
        <div class="hero-apparition mt-9 flex flex-col sm:flex-row items-center justify-center gap-3" style="--d: 450ms">
            @guest
                <a href="{{ route('register') }}" class="w-full sm:w-auto {{ $boutonPrincipal }}">{{ __('Créer mon profil') }}</a>
            @endguest

            @auth
                @php
                    $creatif = Auth::user()->creatif;
                    // Même règle de complétion que dans dashboard.blade.php et
                    // navigation.blade.php — voir le commentaire à cet endroit.
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
                @if ($profilComplet)
                    <a href="{{ route('projets.create') }}" class="w-full sm:w-auto {{ $boutonPrincipal }}">{{ __('Partager un projet') }}</a>
                @else
                    <a href="{{ route('creatifs.edit') }}" class="w-full sm:w-auto {{ $boutonPrincipal }}">{{ __('Compléter mon profil') }}</a>
                @endif
            @endauth

            <a href="{{ route('projects.index') }}" class="w-full sm:w-auto {{ $boutonSecondaire }}">
                {{ __('Explorer les projets') }}
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M8 7h9v9" />
                </svg>
            </a>
        </div>

        {{-- Preuve sociale --}}
        @if ($creatifCount > 0)
            <div class="hero-apparition mt-7 flex items-center justify-center gap-3" style="--d: 600ms">
                @if ($heroAvatars->count())
                    <div class="flex -space-x-2">
                        @foreach ($heroAvatars as $hc)
                            <img src="{{ $hc->photo }}" alt="{{ trim($hc->prenom . ' ' . $hc->nom) }}"
                                class="h-7 w-7 rounded-full object-cover ring-2 ring-[#FAFAF8]">
                        @endforeach
                    </div>
                @endif
                <p class="text-xs text-gray-500">
                    <span class="font-semibold text-gray-900">{{ number_format($creatifCount) }}</span>
                    {{ trans_choice('créatif africain|créatifs africains', $creatifCount) }}
                    {{ __('nous ont déjà rejoints') }}
                </p>
            </div>
        @endif
    </div>

    {{-- Galerie de projets en perspective --}}
    @if ($heroImages->count())
        @php
            // Position, taille et inclinaison de chaque emplacement. Les
            // valeurs de transform passent par --t pour que l'animation
            // d'entrée parte de la même inclinaison.
            $heroStyles = [
                'bord-gauche' => 'left: calc(50% - 760px); top: 40px; width: 200px; height: 290px; --t: rotateY(38deg) rotateZ(-2deg);',
                'gauche-haut' => 'left: calc(50% - 540px); top: 0; width: 290px; height: 190px; --t: rotateY(26deg) rotateZ(-4deg);',
                'gauche-bas' => 'left: calc(50% - 540px); top: 215px; width: 290px; height: 190px; --t: rotateY(26deg) rotateZ(-1deg);',
                'centre' => 'left: calc(50% - 210px); top: 45px; width: 420px; height: 300px; --t: rotateZ(-2deg);',
                'droite-haut' => 'left: calc(50% + 250px); top: 0; width: 290px; height: 190px; --t: rotateY(-26deg) rotateZ(4deg);',
                'droite-bas' => 'left: calc(50% + 250px); top: 215px; width: 290px; height: 190px; --t: rotateY(-26deg) rotateZ(1deg);',
                'bord-droit' => 'left: calc(50% + 560px); top: 40px; width: 200px; height: 290px; --t: rotateY(-38deg) rotateZ(2deg);',
            ];
            // Ordre d'apparition : le centre d'abord, puis vers les bords.
            $heroDelais = ['bord-gauche' => 900, 'gauche-haut' => 750, 'gauche-bas' => 800, 'centre' => 600, 'droite-haut' => 750, 'droite-bas' => 800, 'bord-droit' => 900];
        @endphp
        <div class="hero-scene relative z-0 mx-auto mt-12 sm:mt-16 h-[215px] sm:h-[340px] lg:h-[420px] w-full origin-top scale-50 sm:scale-[0.8] lg:scale-100">
            @foreach ($heroEmplacements as $i => $emplacement)
                @php $carte = $heroCarte($i); @endphp
                <a href="{{ $carte['url'] }}" title="{{ $carte['titre'] }}"
                    class="hero-carte block"
                    style="{{ $heroStyles[$emplacement['zone']] }} --d: {{ $heroDelais[$emplacement['zone']] }}ms; z-index: {{ $emplacement['zone'] === 'centre' ? 10 : 1 }};">
                    <span class="hero-carte-cadre block h-full w-full overflow-hidden rounded-2xl bg-white p-1.5 shadow-[0_20px_50px_-20px_rgba(17,24,39,0.3)] ring-1 ring-gray-900/5 transition-all duration-500">
                        <img src="{{ $carte['image'] }}" alt="{{ $carte['titre'] }}" loading="eager"
                            class="h-full w-full rounded-xl object-cover object-top">
                    </span>
                </a>
            @endforeach
        </div>
    @endif

    {{-- Bandeau des domaines créatifs --}}
    <div class="relative z-10 mt-10 sm:mt-14 overflow-hidden [mask-image:linear-gradient(to_right,transparent,#000_15%,#000_85%,transparent)]">
        <div class="hero-defile flex w-max gap-12 pr-12">
            @foreach (array_merge($heroDomaines, $heroDomaines) as $domaine)
                <span class="whitespace-nowrap text-xl sm:text-2xl font-semibold tracking-tight text-gray-300">{{ $domaine }}</span>
            @endforeach
        </div>
    </div>
</section>

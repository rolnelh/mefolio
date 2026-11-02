{{--
    Section hero de la page d'accueil : fond à halos colorés animés, titre
    animé mot par mot, éventail de cartes (projets récents) qui s'ouvre puis
    se replie au scroll, étiquettes "@auteur" flottantes, CTA (invité ou connecté), compteur social proof.

    Séquence d'intro (pilotée par le composant Alpine mefolioHeroFan(), défini
    dans le <script> en bas de ce fichier) :
      1. les mots du titre apparaissent un par un (CSS pur, .hero-mot) ;
      2. la carte "meneuse" (la dernière) monte du bas en pivotant ;
      3. les autres cartes sortent de derrière elle et s'ouvrent en éventail ;
      4. les étiquettes "@auteur" apparaissent, puis sous-titre et boutons ;
      5. ensuite l'éventail se referme progressivement quand on scrolle.
    Tout est désactivé (état final affiché directement) si l'utilisateur a
    activé "réduire les animations" dans son système.

    Variables attendues (fournies par home.blade.php) :
    - $projects      Paginator   Projets récents : ceux qui ont une image
                                  forment les cartes de l'éventail.
    - $heroCreatifs  Collection  Créatifs avec une vraie photo, utilisés pour
                                  compléter l'éventail s'il y a trop peu de
                                  projets avec image.
    - $creatifCount  int         Nombre total de créatifs actifs, pour le
                                  compteur "Déjà rejoint par X créatifs".
--}}
@php
    $heroMaxCartes = 7;

    $heroCartes = collect($projects->items())
        ->filter(fn ($p) => $p->image)
        ->map(fn ($p) => [
            'image' => $p->image,
            'titre' => $p->title,
            'url' => route('projects.show', $p->slug),
            'auteur' => $p->creatif?->prenom ?: $p->creatif?->nom,
        ])
        ->take($heroMaxCartes)
        ->values();

    if ($heroCartes->count() < $heroMaxCartes) {
        $heroCartes = $heroCartes->concat(
            $heroCreatifs->take($heroMaxCartes - $heroCartes->count())->map(fn ($c) => [
                'image' => $c->photo,
                'titre' => trim($c->prenom . ' ' . $c->nom),
                'url' => route('creatifs.show', $c->slug),
                'auteur' => $c->prenom ?: $c->nom,
            ])
        )->values();
    }

    // Deux étiquettes "@auteur", accrochées à la 2e carte et à l'avant-dernière.
    $heroNbCartes = $heroCartes->count();
    $heroEtiquettes = $heroNbCartes >= 3
        ? [1 => 'bg-blue-600 text-white', $heroNbCartes - 2 => 'bg-emerald-200 text-emerald-900']
        : [];

    // Titre découpé en mots pour l'apparition mot par mot. L'index sert de
    // délai (--i) ; "révéler" garde son soulignement dessiné.
    $heroIndexMot = 0;
    $heroMots = fn (string $texte) => preg_split('/\s+/u', trim($texte), -1, PREG_SPLIT_NO_EMPTY);
@endphp

<style>
    .hero-mot {
        display: inline-block;
        opacity: 0;
        filter: blur(10px);
        transform: translateY(0.3em);
        color: #9ca3af;
        animation: hero-mot 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        animation-delay: calc(var(--i) * 110ms + 150ms);
    }

    @keyframes hero-mot {
        60% { color: #9ca3af; }
        to { opacity: 1; filter: blur(0); transform: none; color: #111827; }
    }

    .hero-trait {
        stroke-dasharray: 130;
        stroke-dashoffset: 130;
        animation: hero-trait 0.7s ease-out forwards;
        animation-delay: calc(var(--i) * 110ms + 800ms);
    }

    @keyframes hero-trait {
        to { stroke-dashoffset: 0; }
    }

    .hero-apparition {
        opacity: 0;
        transform: translateY(14px);
        animation: hero-apparition 0.7s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        animation-delay: var(--d, 0ms);
    }

    @keyframes hero-apparition {
        to { opacity: 1; transform: none; }
    }

    .hero-halo {
        position: absolute;
        border-radius: 9999px;
        filter: blur(80px);
        opacity: 0.55;
        will-change: transform;
        animation: hero-derive 22s ease-in-out infinite alternate;
    }

    .hero-halo-1 { width: 38rem; height: 38rem; top: -14rem; left: -10rem; background: #fde68a; }
    .hero-halo-2 { width: 32rem; height: 32rem; top: -6rem; right: -10rem; background: #c7d2fe; animation-duration: 26s; animation-delay: -6s; }
    .hero-halo-3 { width: 28rem; height: 28rem; bottom: -8rem; left: 18%; background: #a7f3d0; opacity: 0.45; animation-duration: 30s; animation-delay: -12s; }
    .hero-halo-4 { width: 24rem; height: 24rem; bottom: 4rem; right: 12%; background: #fed7aa; opacity: 0.5; animation-duration: 24s; animation-delay: -3s; }

    @keyframes hero-derive {
        0% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(6rem, 3rem) scale(1.12); }
        100% { transform: translate(-4rem, 5rem) scale(0.94); }
    }

    .hero-grain {
        opacity: 0.25;
        mix-blend-mode: multiply;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3CfeColorMatrix values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.35 0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23g)'/%3E%3C/svg%3E");
    }

    @media (max-width: 639px) {
        .hero-halo { filter: blur(60px); }
        .hero-halo-1 { width: 24rem; height: 24rem; }
        .hero-halo-2 { width: 20rem; height: 20rem; }
        .hero-halo-3, .hero-halo-4 { width: 18rem; height: 18rem; }
    }

    .hero-eventail {
        --fan-step: 32px;
        --fan-arc: 5px;
    }

    @media (min-width: 640px) {
        .hero-eventail { --fan-step: 78px; --fan-arc: 7px; }
    }

    @media (min-width: 1024px) {
        .hero-eventail { --fan-step: 112px; --fan-arc: 8px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-halo { animation: none; }

        .hero-mot, .hero-trait, .hero-apparition {
            animation: none;
            opacity: 1;
            filter: none;
            transform: none;
            color: inherit;
            stroke-dashoffset: 0;
        }
    }
</style>

<section class="relative bg-[#F7F6F1] pt-20 pb-24 sm:pt-28 sm:pb-32 overflow-hidden">

    {{-- Fond : halos colorés flous qui dérivent lentement, trame de points
         en fondu radial, léger grain, puis fondu vers la section suivante. --}}
    <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
        <div class="hero-halo hero-halo-1"></div>
        <div class="hero-halo hero-halo-2"></div>
        <div class="hero-halo hero-halo-3"></div>
        <div class="hero-halo hero-halo-4"></div>
        <div class="absolute inset-0 opacity-70"
            style="background-image: radial-gradient(#00000012 1px, transparent 1px); background-size: 28px 28px; -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, #000 30%, transparent 75%); mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, #000 30%, transparent 75%);">
        </div>
        <div class="hero-grain absolute inset-0"></div>
        <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-b from-transparent via-[#FAFAF8]/70 to-[#FAFAF8]"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-5xl px-6 lg:px-8 text-center">

        <h1 class="mx-auto max-w-3xl text-5xl sm:text-6xl font-bold tracking-tight text-gray-900 leading-[1.1]">
            @foreach ($heroMots(__('Un espace pour')) as $mot)
                <span class="hero-mot" style="--i: {{ $heroIndexMot++ }}">{{ $mot }}</span>
            @endforeach
            <span class="hero-mot relative whitespace-nowrap" style="--i: {{ $heroIndexMot }}">
                {{ __('révéler') }}
                <svg class="absolute -bottom-1 left-0 w-full" height="10" viewBox="0 0 120 10" preserveAspectRatio="none" fill="none" aria-hidden="true">
                    <path class="hero-trait" style="--i: {{ $heroIndexMot++ }}" d="M2 7C20 2 40 2 60 5C80 8 100 8 118 3" stroke="#FACC15" stroke-width="5" stroke-linecap="round" />
                </svg>
            </span>
            @foreach ($heroMots(__('votre talent créatif')) as $mot)
                <span class="hero-mot" style="--i: {{ $heroIndexMot++ }}">{{ $mot }}</span>
            @endforeach
        </h1>

        {{-- Éventail de cartes --}}
        @if ($heroNbCartes)
            <div x-data="mefolioHeroFan({{ $heroNbCartes }})" x-ref="fan"
                class="hero-eventail relative mx-auto mt-12 h-56 sm:h-64 lg:h-72">
                @foreach ($heroCartes as $i => $carte)
                    <a href="{{ $carte['url'] }}" title="{{ $carte['titre'] }}"
                        class="group absolute left-1/2 top-2 block w-32 h-44 sm:w-40 sm:h-52 lg:w-48 lg:h-60 will-change-transform"
                        style="z-index: {{ $i + 1 }}; opacity: 0;"
                        x-bind:style="carte({{ $i }})">
                        <span class="block w-full h-full overflow-hidden rounded-2xl bg-gray-200 shadow-xl shadow-gray-900/15 ring-4 ring-white transition-transform duration-300 group-hover:-translate-y-2 group-hover:scale-[1.03]">
                            <img src="{{ $carte['image'] }}" alt="{{ $carte['titre'] }}" loading="eager"
                                class="w-full h-full object-cover">
                        </span>

                        @if (isset($heroEtiquettes[$i]) && $carte['auteur'])
                            <span class="absolute -top-4 {{ $i === 1 ? '-left-4' : '-right-4' }} rounded-full px-3 py-1 text-xs font-semibold shadow-lg {{ $heroEtiquettes[$i] }} transition-all duration-500 ease-out"
                                x-bind:class="phase >= 3 ? 'opacity-100 scale-100 translate-y-0' : 'opacity-0 scale-50 translate-y-2'">
                                {{ '@' . \Illuminate\Support\Str::slug($carte['auteur'], '') }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

        <p class="hero-apparition mt-10 text-lg text-gray-500 max-w-xl mx-auto leading-relaxed" style="--d: 1900ms">
            {{ __('Mefolio aide les créatifs africains à construire leur portfolio, trouver des missions et se connecter à une communauté qui valorise leur travail.') }}
        </p>

        <div class="hero-apparition mt-10 flex flex-col sm:flex-row items-center justify-center gap-4" style="--d: 2100ms">
            @guest
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-gray-900/10">
                    {{ __('Créer mon profil') }}
                </a>
                <a href="{{ route('projects.index') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-8 py-3.5 rounded-full text-sm font-bold hover:border-gray-400 transition-all">
                    {{ __('Explorer les projets') }}
                </a>
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
                    <a href="{{ route('projets.create') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-gray-900/10">
                        {{ __('Partager un projet') }}
                    </a>
                @else
                    <a href="{{ route('creatifs.edit') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-gray-900/10">
                        {{ __('Compléter mon profil') }}
                    </a>
                @endif
                <a href="{{ route('projects.index') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-8 py-3.5 rounded-full text-sm font-bold hover:border-gray-400 transition-all">
                    {{ __('Explorer les projets') }}
                </a>
            @endauth
        </div>

        @if ($creatifCount > 0)
            <p class="hero-apparition mt-8 text-sm text-gray-400" style="--d: 2300ms">
                {{ __('Déjà rejoint par') }} <span class="text-gray-900 font-semibold">{{ number_format($creatifCount) }}</span>
                {{ trans_choice('créatif africain|créatifs africains', $creatifCount) }}
            </p>
        @endif

    </div>
</section>

<script>
    // Éventail de cartes du hero. "phase" pilote l'intro (0 : rien, 1 : la
    // carte meneuse est montée, 2 : éventail ouvert, 3 : étiquettes visibles),
    // "spread" (0 à 1) l'ouverture de l'éventail, réduite ensuite au scroll.
    function mefolioHeroFan(n) {
        return {
            n,
            phase: 0,
            spread: 0,
            intro: true,

            init() {
                const reduire = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                if (reduire) {
                    this.phase = 3;
                    this.spread = 1;
                    this.intro = false;
                    return;
                }

                setTimeout(() => this.phase = 1, 350);
                setTimeout(() => { this.phase = 2; this.spread = 1; }, 1150);
                setTimeout(() => this.phase = 3, 1800);
                setTimeout(() => {
                    this.intro = false;
                    const surScroll = () => this.surScroll();
                    window.addEventListener('scroll', surScroll, { passive: true });
                    surScroll();
                }, 2300);
            },

            surScroll() {
                const fenetre = window.innerHeight || 800;
                const haut = this.$refs.fan.getBoundingClientRect().top;
                // L'éventail commence à se refermer quand il remonte vers le
                // haut de l'écran, et est presque refermé quand il en sort.
                const progression = Math.min(1, Math.max(0, (fenetre * 0.45 - haut) / (fenetre * 0.45)));
                this.spread = 1 - 0.85 * progression;
            },

            carte(i) {
                const meneuse = i === this.n - 1;
                const o = i - (this.n - 1) / 2;
                let transform = 'translateX(-50%)';
                let opacite = 1;
                let transition;

                if (this.phase === 0) {
                    transform += meneuse
                        ? ' translate(0, 180px) rotate(-22deg) scale(0.9)'
                        : ' scale(0.9)';
                    opacite = 0;
                } else if (this.phase === 1) {
                    transform += ' rotate(-4deg)';
                    opacite = meneuse ? 1 : 0;
                } else {
                    const s = this.spread;
                    transform += ` translate(calc(${o} * var(--fan-step) * ${s}), calc(${o * o} * var(--fan-arc) * ${s}))`
                        + ` rotate(${o * 4 * s}deg)`;
                }

                if (this.intro) {
                    // Les cartes sortent de derrière la meneuse, de la plus
                    // proche à la plus éloignée.
                    const delai = this.phase >= 2 ? (this.n - 1 - i) * 55 : 0;
                    transition = `transform 900ms cubic-bezier(0.2, 0.8, 0.2, 1) ${delai}ms, opacity 400ms ease ${delai}ms`;
                } else {
                    transition = 'transform 150ms linear';
                }

                return `z-index: ${i + 1}; opacity: ${opacite}; transform: ${transform}; transition: ${transition};`;
            },
        };
    }
</script>

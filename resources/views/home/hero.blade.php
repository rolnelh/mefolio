{{--
    Section hero de la page d'accueil : grande image de fond arrondie avec
    voile sombre, titre blanc en haut à gauche (apparition mot par mot),
    CTA (invité ou connecté), texte de présentation en bas à gauche et
    preuve sociale (avatars + compteur de créatifs) en bas à droite.

    Image de fond : public/images/hero-accueil.webp. Pour la changer, il
    suffit de remplacer ce fichier (idéalement une photo d'au moins 1600 px
    de large) : le voile en dégradé garde le texte lisible quelle que soit
    l'image. Animations désactivées si l'utilisateur a activé "réduire les
    animations" dans son système.

    Variables attendues (fournies par home.blade.php) :
    - $heroCreatifs  Collection  Créatifs avec une vraie photo, pour la pile
                                  d'avatars de la preuve sociale.
    - $creatifCount  int         Nombre total de créatifs actifs, pour le
                                  compteur "Déjà rejoint par X créatifs".
--}}
@php
    // Titre découpé en mots pour l'apparition mot par mot. L'index sert de
    // délai (--i) ; "révéler" garde son soulignement dessiné.
    $heroIndexMot = 0;
    $heroMots = fn (string $texte) => preg_split('/\s+/u', trim($texte), -1, PREG_SPLIT_NO_EMPTY);
    $heroAvatars = $heroCreatifs->take(4);
@endphp

<style>
    .hero-fond {
        animation: hero-zoom 24s ease-out forwards;
    }

    @keyframes hero-zoom {
        from { transform: scale(1.12); }
        to { transform: scale(1); }
    }

    .hero-mot {
        display: inline-block;
        opacity: 0;
        filter: blur(10px);
        transform: translateY(0.3em);
        animation: hero-mot 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        animation-delay: calc(var(--i) * 90ms + 200ms);
    }

    @keyframes hero-mot {
        to { opacity: 1; filter: blur(0); transform: none; }
    }

    .hero-trait {
        stroke-dasharray: 130;
        stroke-dashoffset: 130;
        animation: hero-trait 0.7s ease-out forwards;
        animation-delay: calc(var(--i) * 90ms + 800ms);
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

    @media (prefers-reduced-motion: reduce) {
        .hero-fond, .hero-mot, .hero-trait, .hero-apparition {
            animation: none;
            opacity: 1;
            filter: none;
            transform: none;
            stroke-dashoffset: 0;
        }
    }
</style>

<section class="px-2 sm:px-6 lg:px-8 pt-4 pb-10 sm:pb-16 bg-[#FAFAF8]">
    <div class="relative mx-auto max-w-7xl overflow-hidden rounded-[28px] sm:rounded-[36px] bg-gray-900 min-h-[620px] sm:min-h-[640px] lg:h-[calc(100vh-7rem)] lg:max-h-[780px] flex flex-col">

        {{-- Image de fond + voiles pour la lisibilité du texte --}}
        <img src="{{ asset('images/hero-accueil.webp') }}" alt="" aria-hidden="true"
            class="hero-fond absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/10" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20" aria-hidden="true"></div>

        {{-- Haut : accroche, titre, boutons --}}
        <div class="relative z-10 px-6 sm:px-12 lg:px-16 pt-12 sm:pt-16 lg:pt-20 max-w-3xl">
            <p class="hero-apparition inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur px-3 py-1 text-xs font-medium text-white/90 ring-1 ring-white/20" style="--d: 100ms">
                <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>
                {{ __('La plateforme des créatifs africains') }}
            </p>

            <h1 class="mt-6 text-[2.6rem] sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-[1.05]">
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

            <div class="hero-apparition mt-10 flex flex-col sm:flex-row sm:items-center gap-3" style="--d: 1100ms">
                @php
                    $boutonPrincipal = 'inline-flex items-center justify-center gap-2 rounded-full bg-yellow-400 hover:bg-yellow-300 px-7 py-3.5 text-sm font-bold text-gray-900 transition-all hover:scale-[1.02] active:scale-95';
                    $boutonSecondaire = 'inline-flex items-center justify-center gap-2 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur px-7 py-3.5 text-sm font-bold text-white ring-1 ring-white/25 transition-all';
                @endphp
                @guest
                    <a href="{{ route('register') }}" class="{{ $boutonPrincipal }}">
                        {{ __('Créer mon profil') }} <span aria-hidden="true">→</span>
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
                        <a href="{{ route('projets.create') }}" class="{{ $boutonPrincipal }}">
                            {{ __('Partager un projet') }} <span aria-hidden="true">→</span>
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}" class="{{ $boutonPrincipal }}">
                            {{ __('Compléter mon profil') }} <span aria-hidden="true">→</span>
                        </a>
                    @endif
                @endauth

                <a href="{{ route('projects.index') }}" class="{{ $boutonSecondaire }}">
                    {{ __('Explorer les projets') }}
                </a>
            </div>
        </div>

        {{-- Bas : présentation à gauche, preuve sociale à droite --}}
        <div class="relative z-10 mt-auto px-6 sm:px-12 lg:px-16 pb-8 sm:pb-12 pt-12 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
            <div class="hero-apparition max-w-md" style="--d: 1300ms">
                <p class="text-lg sm:text-xl font-medium leading-snug text-white">
                    {{ __('Mefolio aide les créatifs africains à construire leur portfolio, trouver des missions et se connecter à une communauté qui valorise leur travail.') }}
                </p>
                <a href="{{ route('creatifs.index') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-white/80 hover:text-white transition-colors">
                    {{ __('Découvrir les talents') }} <span aria-hidden="true">→</span>
                </a>
            </div>

            @if ($creatifCount > 0)
                <div class="hero-apparition flex items-center gap-4" style="--d: 1500ms">
                    @if ($heroAvatars->count())
                        <div class="flex -space-x-3">
                            @foreach ($heroAvatars as $hc)
                                <a href="{{ route('creatifs.show', $hc->slug) }}" class="relative hover:z-10 transition-transform hover:-translate-y-1">
                                    <img src="{{ $hc->photo }}" alt="{{ trim($hc->prenom . ' ' . $hc->nom) }}"
                                        class="h-11 w-11 rounded-full object-cover ring-2 ring-white/80">
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <p class="text-sm text-white/70 leading-snug">
                        {{ __('Déjà rejoint par') }}<br>
                        <span class="text-white font-semibold">{{ number_format($creatifCount) }}</span>
                        {{ trans_choice('créatif africain|créatifs africains', $creatifCount) }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</section>

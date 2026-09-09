{{--
    Section hero de la page d'accueil : titre, CTA (invité ou connecté),
    portraits flottants des créatifs mis en avant, compteur social proof.

    Variables attendues (fournies par home.blade.php) :
    - $heroCreatifs  Collection  Créatifs avec une vraie photo (pas d'avatar
                                  par initiales) à afficher dans les grappes.
    - $creatifCount  int         Nombre total de créatifs actifs, pour le
                                  compteur "Déjà rejoint par X créatifs".
--}}
@php
    // Seuls les créatifs avec une vraie photo apparaissent dans le hero :
    // pas d'avatars par initiales (cercles bleus) dans ces grappes.
    $heroPool = $heroCreatifs;
    $heroHautGauche = $heroPool->slice(0, 2)->values();
    $heroBasGauche = $heroPool->slice(2, 2)->values();
    $heroHautDroit = $heroPool->slice(4, 2)->values();
    $heroBasDroit = $heroPool->slice(6, 2)->values();
    $heroClusters = [
        ['creatifs' => $heroHautGauche, 'pos' => 'top-[12%] left-[4%] lg:left-[10%]'],
        ['creatifs' => $heroBasGauche, 'pos' => 'bottom-[10%] left-[6%] lg:left-[13%]'],
        ['creatifs' => $heroHautDroit, 'pos' => 'top-[12%] right-[4%] lg:right-[10%]'],
        ['creatifs' => $heroBasDroit, 'pos' => 'bottom-[10%] right-[6%] lg:right-[13%]'],
    ];
@endphp

<section class="relative bg-[#F7F6F1] py-24 sm:py-32 overflow-hidden">

    {{-- Trame de points --}}
    <div class="absolute inset-0 z-0 pointer-events-none opacity-60"
        style="background-image: radial-gradient(#00000014 1px, transparent 1px); background-size: 28px 28px;">
    </div>
    <div class="absolute inset-0 z-0 pointer-events-none bg-gradient-to-b from-transparent via-transparent to-[#F7F6F1]">
    </div>

    {{-- Grappes de portraits flottants, deux par côté (haut et bas) --}}
    @foreach ($heroClusters as $cluster)
        @if ($cluster['creatifs']->count())
            <div class="hidden md:block absolute {{ $cluster['pos'] }} z-10">
                <div class="relative w-24 h-24">
                    @foreach ($cluster['creatifs'] as $j => $hc)
                        <a href="{{ route('creatifs.show', $hc->slug) }}"
                            class="absolute {{ $j === 0 ? 'top-0 left-0 z-10' : 'top-9 left-9 z-20' }} hover:z-30 hover:scale-110 transition-all duration-300">
                            <img src="{{ $hc->photo }}"
                                class="w-16 h-16 rounded-full object-cover shadow-xl ring-4 ring-[#F7F6F1]">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <div class="relative z-10 mx-auto max-w-3xl px-6 lg:px-8 text-center">

        <h1 class="text-5xl sm:text-6xl font-bold tracking-tight text-gray-900 leading-[1.1]">
            {{ __('Un espace pour') }}
            <span class="relative inline-block whitespace-nowrap">
                {{ __('révéler') }}
                <svg class="absolute -bottom-1 left-0 w-full" height="10" viewBox="0 0 120 10" preserveAspectRatio="none" fill="none">
                    <path d="M2 7C20 2 40 2 60 5C80 8 100 8 118 3" stroke="#FACC15" stroke-width="5" stroke-linecap="round" />
                </svg>
            </span>
            {{ __('votre talent créatif') }}
        </h1>

        <p class="mt-6 text-lg text-gray-500 max-w-xl mx-auto leading-relaxed">
            {{ __('Mefolio aide les créatifs africains à construire leur portfolio, trouver des missions et se connecter à une communauté qui valorise leur travail.') }}
        </p>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
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
            <p class="mt-8 text-sm text-gray-400">
                {{ __('Déjà rejoint par') }} <span class="text-gray-900 font-semibold">{{ number_format($creatifCount) }}</span>
                {{ trans_choice('créatif africain|créatifs africains', $creatifCount) }}
            </p>
        @endif

    </div>
</section>

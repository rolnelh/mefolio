<style>
    .card-active {
        background: rgba(255, 255, 255, 0.05) !important;
        height: auto !important;
        min-height: 16rem;
    }

    .card-active .content {
        opacity: 1 !important;
        translate: 0 0 !important;
    }
</style>
<x-app-layout>

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
                Un espace pour
                <span class="relative inline-block whitespace-nowrap">
                    révéler
                    <svg class="absolute -bottom-1 left-0 w-full" height="10" viewBox="0 0 120 10" preserveAspectRatio="none" fill="none">
                        <path d="M2 7C20 2 40 2 60 5C80 8 100 8 118 3" stroke="#FACC15" stroke-width="5" stroke-linecap="round" />
                    </svg>
                </span>
                votre talent créatif
            </h1>

            <p class="mt-6 text-lg text-gray-500 max-w-xl mx-auto leading-relaxed">
                Mefolio aide les créatifs africains à construire leur portfolio, trouver des missions et se connecter
                à une communauté qui valorise leur travail.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                @guest
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-gray-900/10">
                        Créer mon profil
                    </a>
                    <a href="{{ route('projects.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-8 py-3.5 rounded-full text-sm font-bold hover:border-gray-400 transition-all">
                        Explorer les projets
                    </a>
                @endguest

                @auth
                    @php
                        $creatif = Auth::user()->creatif;
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
                            Partager un projet
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-gray-900/10">
                            Compléter mon profil
                        </a>
                    @endif
                    <a href="{{ route('projects.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-8 py-3.5 rounded-full text-sm font-bold hover:border-gray-400 transition-all">
                        Explorer les projets
                    </a>
                @endauth
            </div>

            @if ($creatifCount > 0)
                <p class="mt-8 text-sm text-gray-400">
                    Déjà rejoint par <span class="text-gray-900 font-semibold">{{ number_format($creatifCount) }}</span>
                    créatif{{ $creatifCount > 1 ? 's' : '' }} africain{{ $creatifCount > 1 ? 's' : '' }}
                </p>
            @endif

        </div>
    </section>

    {{-- Avantages : un seul espace pour tout le parcours créatif --}}
    <section class="bg-[#FAFAF8] py-24 px-6 overflow-hidden">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-3">Pourquoi Mefolio</p>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
                Tout votre parcours créatif, <span class="text-indigo-600">connecté</span>.
            </h2>
            <p class="text-slate-500 mt-4 max-w-xl mx-auto">
                Portfolio, missions, communauté, classement : plus besoin de jongler entre dix outils différents.
            </p>
        </div>

        @php
            $avantages = [
                ['label' => 'Portfolio', 'href' => route('projects.index'), 'pos' => 'left-[6%] top-[2%]', 'icon' => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-19.5 0v6a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25v-6m-19.5 0h19.5M8.25 21v-9'],
                ['label' => 'Créatifs', 'href' => route('creatifs.index'), 'pos' => 'left-[1%] top-[44%]', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['label' => 'Missions', 'href' => route('missions.index'), 'pos' => 'left-[6%] top-[86%]', 'icon' => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653'],
                ['label' => 'Classement', 'href' => route('classement.index'), 'pos' => 'right-[6%] top-[2%]', 'icon' => 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172'],
                ['label' => 'Programmes', 'href' => route('hackathons.index'), 'pos' => 'right-[1%] top-[44%]', 'icon' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347M12 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0a50.717 50.717 0 00-2.658-.814 59.906 59.906 0 0110.399-5.84'],
                ['label' => 'Blog', 'href' => route('blog'), 'pos' => 'right-[6%] top-[86%]', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6 12l-1.5 1.5m1.5-1.5l1.5 1.5m-6-1.5l-1.5 1.5m0 0l-1.5-1.5m1.5 1.5V9'],
            ];
        @endphp

        {{-- Diagramme (desktop) --}}
        <div class="hidden md:block relative max-w-4xl mx-auto aspect-[1100/460]">
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1100 460" preserveAspectRatio="none" fill="none">
                <path d="M150 40 C 400 40, 420 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
                <path d="M85 208 C 320 208, 400 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
                <path d="M150 420 C 400 420, 420 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
                <path d="M950 40 C 700 40, 680 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
                <path d="M1015 208 C 780 208, 700 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
                <path d="M950 420 C 700 420, 680 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
            </svg>

            {{-- Noeud central --}}
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                <div class="w-20 h-20 rounded-full bg-gray-900 shadow-xl flex items-center justify-center ring-8 ring-white">
                    <x-application-logo class="h-9 w-auto text-white" />
                </div>
            </div>

            @foreach ($avantages as $a)
                <a href="{{ $a['href'] }}" class="absolute {{ $a['pos'] }} z-10 flex flex-col items-center gap-2 group">
                    <span class="w-14 h-14 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-700 group-hover:border-indigo-300 group-hover:text-indigo-600 group-hover:shadow-md transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['icon'] }}" />
                        </svg>
                    </span>
                    <span class="text-xs font-semibold text-gray-600 group-hover:text-indigo-600 transition-colors">{{ $a['label'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- Grille (mobile) --}}
        <div class="grid grid-cols-3 gap-4 md:hidden max-w-sm mx-auto">
            @foreach ($avantages as $a)
                <a href="{{ $a['href'] }}" class="flex flex-col items-center gap-2 group">
                    <span class="w-14 h-14 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-700 group-hover:border-indigo-300 group-hover:text-indigo-600 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['icon'] }}" />
                        </svg>
                    </span>
                    <span class="text-xs font-semibold text-gray-600 text-center">{{ $a['label'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-white py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="max-w-xl mx-auto text-center mb-16">
                <span
                    class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-4">
                    [ Pourquoi maintenant ]
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
                    Les vrais problèmes. <span class="text-slate-400 font-medium">Les vraies solutions.</span>
                </h2>
                <p class="text-slate-500 mt-4 text-sm leading-relaxed">
                    Une plateforme pensée pour nos réalités : moins d'outils dispersés, plus d'opportunités concrètes
                    pour les créatifs africains.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach ([
                    [
                        'title' => 'Visibilité sans frontières',
                        'desc' => "Sortez de l'ombre. Un profil MeFolio optimisé pour connecter les talents aux recruteurs locaux et internationaux.",
                        'color' => 'bg-indigo-600',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18zM12 3a14.98 14.98 0 00-3 9c0 3.5 1.2 6.7 3 9m0-18a14.98 14.98 0 013 9c0 3.5-1.2 6.7-3 9m-9-9h18" />',
                        'tags' => ['Profil international', 'Recruteurs locaux'],
                    ],
                    [
                        'title' => 'Paiements locaux intégrés',
                        'desc' => "L'argent arrive là où vous êtes. Retraits directs via MTN MoMo, Wave, Kkiapay, Fedapay, Moov ... sans détours.",
                        'color' => 'bg-emerald-500',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />',
                        'tags' => ['MTN MoMo', 'Wave'],
                    ],
                    [
                        'title' => 'Marketplace de missions',
                        'desc' => 'Ne cherchez plus, postulez. Un accès direct aux missions freelance pour décrocher vos futurs contrats en un clic.',
                        'color' => 'bg-violet-600',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653" />',
                        'tags' => ['Freelance', 'Candidature 1 clic'],
                    ],
                    [
                        'title' => 'Écosystème startup fragmenté',
                        'desc' => 'Hackathons, challenges créatifs et programmes Sèmè City & ASIN regroupés au même endroit.',
                        'color' => 'bg-amber-500',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />',
                        'tags' => ['Hackathons', 'Sèmè City · ASIN'],
                    ],
                ] as $item)
                    <div
                        class="group rounded-2xl bg-white border border-gray-100 hover:border-indigo-100 hover:shadow-lg hover:shadow-gray-900/5 p-5 transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-2.5">
                                <span
                                    class="flex-shrink-0 w-9 h-9 rounded-xl {{ $item['color'] }} text-white flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        {!! $item['icon'] !!}
                                    </svg>
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-gray-900">
                                    Mefolio
                                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                            <span class="w-7 h-7 rounded-lg bg-gray-50 flex items-center justify-center text-gray-300 flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 mb-1.5">{{ $item['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-4">{{ $item['desc'] }}</p>

                        <div class="flex flex-wrap gap-2">
                            @foreach ($item['tags'] as $tag)
                                <span
                                    class="inline-flex items-center gap-1 text-[11px] font-semibold text-gray-600 bg-gray-50 border border-gray-100 rounded-full px-3 py-1.5">
                                    <svg class="w-3 h-3 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route(auth()->check() ? 'dashboard' : 'register') }}"
                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02]">
                    Créer mon profil
                </a>
            </div>
        </div>
    </section>

    {{-- Comment ça marche : parcours en cartes ascendantes --}}
    <section class="bg-white py-24 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-4">
                <span class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500">[ Comment ça marche ]</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mt-3">
                    Trois étapes vers votre carrière créative.
                </h2>
            </div>

            @php
                $steps = [
                    [
                        'num' => '01', 'title' => 'Créez votre profil',
                        'desc' => 'Renseignez votre spécialité, votre bio et votre portfolio en quelques minutes.',
                        'bg' => 'bg-indigo-600', 'pill' => 'bg-indigo-50 text-indigo-600',
                        'pos' => 'left-0 top-[260px]',
                        'icon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',
                    ],
                    [
                        'num' => '02', 'title' => 'Publiez vos projets',
                        'desc' => 'Montrez votre travail, recevez des likes et des commentaires de la communauté.',
                        'bg' => 'bg-violet-600', 'pill' => 'bg-violet-50 text-violet-600',
                        'pos' => 'left-[280px] top-[130px]',
                        'icon' => 'M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25',
                    ],
                    [
                        'num' => '03', 'title' => 'Soyez repéré',
                        'desc' => 'Postulez à des missions, grimpez le classement et faites-vous remarquer.',
                        'bg' => 'bg-emerald-500', 'pill' => 'bg-emerald-50 text-emerald-600',
                        'pos' => 'left-[560px] top-0',
                        'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
                    ],
                ];
            @endphp

            {{-- Cartes ascendantes reliées par une courbe (desktop) --}}
            <div class="hidden md:block relative mx-auto mt-16" style="width: 820px; height: 400px;">
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 820 400" fill="none">
                    <path d="M260 320 C 330 320, 330 190, 280 190" stroke="#c7d2fe" stroke-width="2" />
                    <path d="M540 190 C 610 190, 610 60, 560 60" stroke="#ddd6fe" stroke-width="2" />
                </svg>

                @foreach ($steps as $step)
                    <div class="absolute {{ $step['pos'] }} w-64 bg-white rounded-2xl border border-gray-100 shadow-lg shadow-gray-900/5 p-5 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl {{ $step['bg'] }} flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                                </svg>
                            </span>
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full {{ $step['pill'] }}">{{ $step['num'] }}</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">{{ $step['title'] }}</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Version mobile : empilée --}}
            <div class="md:hidden space-y-4 mt-10">
                @foreach ($steps as $step)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl {{ $step['bg'] }} flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                                </svg>
                            </span>
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full {{ $step['pill'] }}">{{ $step['num'] }}</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">{{ $step['title'] }}</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route(auth()->check() ? 'dashboard' : 'register') }}"
                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02]">
                    Commencer maintenant
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Projets <span class="text-blue-600">récents</span>
                    </h2>
                    <p class="mt-3 text-gray-500 dark:text-gray-400 font-light max-w-md">
                        Découvrez les dernières créations de notre communauté de talents.
                    </p>
                </div>

                <a href="{{ route('projects.index') }}"
                    class="group inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-blue-600 transition-all duration-300">
                    Voir toute la galerie
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="group">

                        <div
                            class="relative aspect-[4/3] overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800 transition-all duration-500 group-hover:shadow-2xl group-hover:shadow-blue-500/10 group-hover:-translate-y-1">

                            <img src="{{ $project->image ?: 'https://via.placeholder.com/400x300' }}"
                                alt="{{ $project->title }}"
                                class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" />

                            <div class="absolute top-4 left-4 z-20">
                                <span
                                    class="inline-flex items-center rounded-full bg-white/90 dark:bg-gray-900/80 px-3 py-1 text-[9px] font-bold uppercase tracking-widest text-gray-900 dark:text-white backdrop-blur-md border border-white/20">
                                    {{ $project->category ?? 'Design' }}
                                </span>
                            </div>

                            <div
                                class="absolute inset-0 z-10 opacity-0 group-hover:opacity-100 transition-all duration-500 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-6">
                                <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-500">

                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1">

                                            <h3 class="text-base font-bold text-white leading-tight">
                                                {{ $project->title }}
                                            </h3>

                                            <p
                                                class="mt-2 text-xs text-gray-200 line-clamp-2 font-light leading-relaxed">
                                                {{ $project->description }}
                                            </p>
                                        </div>

                                        <a href="{{ route('projects.show', $project->slug) }}"
                                            class="size-9 shrink-0 flex items-center justify-center rounded-full bg-white text-gray-900 shadow-xl hover:scale-110 transition-transform duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-between px-1">
                            <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                class="flex items-center gap-3 group/author">
                                <div class="relative">
                                    <img src="{{ $project->creatif->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($project->creatif->prenom) }}"
                                        class="size-8 rounded-full object-cover grayscale group-hover/author:grayscale-0 transition-all duration-300" />
                                    <div
                                        class="absolute -bottom-0.5 -right-0.5 size-2 rounded-full bg-green-500 border-2 border-white dark:border-gray-950">
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 leading-none">
                                        {{ $project->creatif->prenom }}
                                    </span>
                                    <span class="text-[10px] text-gray-400 font-medium mt-1">
                                        @ {{ $project->creatif->slug }}
                                    </span>
                                </div>
                            </a>

                            @auth
                                <form method="POST" action="{{ route('projects.like', $project) }}">
                                    @csrf
                                    <button
                                        class="flex items-center gap-1.5 px-2 py-1 transition-all duration-300 {{ $project->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                            fill="{{ $project->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        <span class="text-[11px] font-bold">{{ $project->likes->count() }}</span>
                                    </button>
                                </form>
                            @else
                                <div class="flex items-center gap-1.5 px-2 py-1 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="text-[11px] font-bold">{{ $project->likes->count() }}</span>
                                </div>
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 md:py-32 bg-white text-gray-900 overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-24 gap-10">
                <div class="max-w-5xl">
                    <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Nos talents
                        <span class="text-blue-600">créatifs</span>
                    </h2>

                    <div class="mt-4 flex gap-6">
                        <p class="mt-3 text-gray-500 dark:text-gray-400 font-light max-w-md">
                            L'élite de notre communauté. Des esprits audacieux qui repoussent les limites du possible.
                        </p>
                    </div>
                </div>

                <div class="pb-2">
                    <a href="{{ route('creatifs.index') }}"
                        class="group inline-flex items-center gap-4 text-gray-900 font-bold uppercase tracking-[0.1em] text-[11px] transition-all">
                        <span class="relative">
                            Voir tout l'écosystème
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                        </span>
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-200 group-hover:border-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($creatifs as $creatif)
                    <x-creatif-card :creatif="$creatif" />
                @endforeach
            </div>
        </div>

    </section>

    @if ($testimonials->count())
        <section class="py-24 px-6 max-w-6xl mx-auto">
            <div x-data="{ i: 0, total: {{ $testimonials->count() }} }" class="bg-[#FAFAF8] rounded-[2rem] overflow-hidden grid grid-cols-1 md:grid-cols-2">

                {{-- Colonne gauche --}}
                <div class="p-10 md:p-14 flex flex-col justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-4">Témoignages</p>
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight leading-snug">
                            Des histoires de créatifs qui ont trouvé leur visibilité, avancé plus vite et
                            travaillé avec plus de sérénité.
                        </h2>
                    </div>

                    @if ($testimonials->count() > 1)
                        <div class="flex items-center gap-3 mt-10">
                            <button @click="i = (i - 1 + total) % total"
                                class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-gray-900 hover:text-gray-900 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                            <button @click="i = (i + 1) % total"
                                class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-gray-900 hover:text-gray-900 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Colonne droite : citation active --}}
                <div class="bg-white p-10 md:p-14 flex flex-col justify-between border-t md:border-t-0 md:border-l border-gray-100">
                    @foreach ($testimonials as $index => $testimonial)
                        <div x-show="i === {{ $index }}" x-cloak x-transition.opacity>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-4">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($testimonials->count(), 2, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="text-2xl md:text-[28px] font-bold text-slate-900 leading-tight mb-8">
                                {{ $testimonial->quote }}
                            </p>
                            <div class="flex items-center gap-3">
                                @if ($testimonial->photo)
                                    <img src="{{ $testimonial->photo }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $testimonial->name }}">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-bold">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $testimonial->name }}</p>
                                    @if ($testimonial->role)
                                        <p class="text-xs text-gray-400">{{ $testimonial->role }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-24 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-10 lg:gap-16 items-start">

            <div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Questions fréquentes posées par nos créatifs.
                </h2>
                <p class="text-slate-500 mt-6 text-sm leading-relaxed max-w-xs">
                    Notre équipe est toujours disponible pour des réponses rapides, claires et fiables.
                </p>
                <a href="mailto:contact@mefolio.com"
                    class="inline-flex items-center gap-2 mt-8 bg-gray-900 hover:bg-black text-white text-sm font-bold px-6 py-3 rounded-full transition-all hover:scale-[1.02]">
                    Contacter l'équipe
                </a>
            </div>

            <div class="space-y-3">
                @foreach ([
                    ['q' => 'Comment créer mon portfolio ?', 'a' => "Le processus est instantané. Cliquez sur « S'inscrire », validez votre email et personnalisez votre espace. Pas de configuration complexe, juste votre talent mis en avant."],
                    ['q' => 'Est-ce vraiment gratuit ?', 'a' => "Oui, l'accès de base et la publication de projets sont 100% gratuits. Nous croyons en l'accessibilité du talent local pour dynamiser l'écosystème tech en Afrique."],
                    ['q' => 'Comment les recruteurs me trouvent-ils ?', 'a' => "Votre profil est indexé dans notre moteur de recherche de talents. Vous disposez aussi d'une URL personnalisée professionnelle que vous pouvez partager directement sur votre CV ou LinkedIn."],
                    ['q' => 'Quels types de fichiers puis-je publier ?', 'a' => 'Vous pouvez importer des images (JPG, PNG), lier des dépôts GitHub pour le code, ou intégrer des liens externes comme Figma, Behance ou des vidéos de démonstration.'],
                ] as $i => $faq)
                    <details class="group bg-white border border-gray-100 rounded-2xl px-6 hover:border-gray-200 transition-colors" @if ($i === 0) open @endif>
                        <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-5">
                            <h3 class="text-base font-bold text-slate-900">{{ $faq['q'] }}</h3>
                            <span class="relative flex-shrink-0 w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center">
                                <span class="absolute w-3 h-0.5 bg-gray-900 rounded-full"></span>
                                <span class="absolute w-0.5 h-3 bg-gray-900 rounded-full group-open:opacity-0 transition-opacity"></span>
                            </span>
                        </summary>
                        <div class="text-slate-500 leading-relaxed text-sm pb-5">
                            {{ $faq['a'] }}
                        </div>
                    </details>
                @endforeach
            </div>

        </div>

        <div class="max-w-3xl mx-auto mt-8">
            <div class="relative overflow-hidden rounded-[2rem] p-10 text-center bg-gradient-to-br from-indigo-50 via-violet-50 to-amber-50 border border-indigo-100">
                <div class="w-12 h-12 mx-auto mb-5 rounded-2xl bg-gray-900 flex items-center justify-center shadow-lg">
                    <x-application-logo class="h-6 w-auto text-white" />
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Encore des questions ?</h3>
                <p class="text-slate-500 text-sm max-w-sm mx-auto mb-6">
                    Notre équipe est là pour vous accompagner et répondre à vos besoins spécifiques.
                </p>
                <div class="flex -space-x-2 justify-center mb-6">
                    @foreach (['bg-indigo-500', 'bg-violet-500', 'bg-amber-500'] as $c)
                        <div class="w-8 h-8 rounded-full {{ $c }} border-2 border-white"></div>
                    @endforeach
                </div>
                <a href="mailto:contact@mefolio.com"
                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white text-sm font-bold px-6 py-3 rounded-full transition-all hover:scale-[1.02]">
                    Contacter l'équipe
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-24">
        <div
            class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] md:rounded-[3.5rem] p-12 md:p-20 shadow-2xl shadow-indigo-100/20">

            <div
                class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12 text-center lg:text-left">

                <div class="max-w-xl">
                    <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-[1.1]">
                        Prêt à booster <br />
                        <span class="text-indigo-400">votre visibilité ?</span>
                    </h2>
                    <p class="text-lg text-white mt-6 max-w-md leading-relaxed">
                        Rejoignez la communauté des <span class="font-bold text-white">créatifs</span> qui transforment
                        leur passion en carrière sur MeFolio.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <a href="{{ route(auth()->check() ? 'dashboard' : 'register') }}"
                        class="group inline-flex items-center justify-center px-10 py-3 font-bold text-white bg-indigo-600 rounded-full md:rounded-full transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl">
                        Créer mon portfolio
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>


</x-app-layout>

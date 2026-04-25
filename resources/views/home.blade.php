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

    <section class="relative bg-[#050810] py-20 sm:py-28 overflow-hidden">

        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute -top-[10%] -right-[10%] w-[70%] h-[70%] rounded-full bg-blue-600/10 blur-[120px]"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-indigo-600/10 blur-[100px]">
            </div>
            <div
                class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay">
            </div>
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-6xl text-center">

                <div
                    class="inline-flex items-center rounded-full bg-blue-500/5 px-4 py-1.5 text-xs font-semibold text-blue-400 ring-1 ring-inset ring-blue-500/20 mb-10 backdrop-blur-md">
                    <span class="mr-2">🌍</span> The first African platform for creative talent
                </div>

                <h1 class="text-5xl font-extrabold tracking-tight text-white sm:text-7xl leading-[1.05]">
                    {{-- Le talent africain<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">
                        mérite une scène mondiale.
                    </span> --}}
                    Discover, Showcase and Hire African Talents
                </h1>

                <p class="mt-8 text-lg md:text-xl leading-relaxed text-gray-400 font-light max-w-2xl mx-auto">
                    {{-- Mefolio est la plateforme pensée pour les créatifs et étudiants africains.
                    Construisez votre portfolio, soyez découverts par des recruteurs,
                    et monétisez vos compétences avec
                    <span class="text-gray-200 font-medium">Mobile Money.</span> --}}

                    The first platform dedicated to students, creatives and developers across Africa.
                </p>

                {{-- Stats rapides --}}
                <div class="mt-10 flex items-center justify-center gap-8 flex-wrap">
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-white">2 000+</div>
                        <div class="text-xs text-gray-500 mt-0.5">Créatifs</div>
                    </div>
                    <div class="w-px h-8 bg-gray-800"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-white">5k+</div>
                        <div class="text-xs text-gray-500 mt-0.5">Projets</div>
                    </div>
                    <div class="w-px h-8 bg-gray-800"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-white">15+</div>
                        <div class="text-xs text-gray-500 mt-0.5">Pays</div>
                    </div>
                    <div class="w-px h-8 bg-gray-800"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-white">100%</div>
                        <div class="text-xs text-gray-500 mt-0.5">Africain</div>
                    </div>
                </div>

                <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-5">
                    @guest
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto group relative inline-flex items-center justify-center rounded-full bg-white px-10 py-4 text-sm font-bold text-gray-950 shadow-2xl transition-all hover:bg-gray-100 hover:scale-[1.02] active:scale-95">
                            Join as Talent
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                        <a href="{{ route('projects.index') }}"
                            class="group flex items-center gap-2 text-sm font-bold text-gray-300 hover:text-white transition-colors py-3">
                            Explore Talents
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('projects.index') }}"
                            class="w-full sm:w-auto rounded-full bg-blue-600 px-10 py-4 text-sm font-bold text-white shadow-lg shadow-blue-900/20 hover:bg-blue-500 transition-all hover:scale-[1.02]">
                            Explorer les projets
                        </a>
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
                                class="group flex items-center gap-2 text-sm font-bold text-gray-300 hover:text-white transition-colors py-3">
                                Partager un projet
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        @else
                            <a href="{{ route('creatifs.edit') }}"
                                class="group flex items-center gap-2 text-sm font-bold text-amber-400 hover:text-amber-300 transition-colors py-3">
                                ⚠️ Compléter mon profil
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="mt-12 flex items-center justify-center gap-3">
                    <div class="flex -space-x-2">
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-500 border-2 border-[#050810] flex items-center justify-center text-white text-xs font-bold">
                            D</div>
                        <div
                            class="w-8 h-8 rounded-full bg-blue-500 border-2 border-[#050810] flex items-center justify-center text-white text-xs font-bold">
                            A</div>
                        <div
                            class="w-8 h-8 rounded-full bg-purple-500 border-2 border-[#050810] flex items-center justify-center text-white text-xs font-bold">
                            S</div>
                        <div
                            class="w-8 h-8 rounded-full bg-pink-500 border-2 border-[#050810] flex items-center justify-center text-white text-xs font-bold">
                            K</div>
                        <div
                            class="w-8 h-8 rounded-full bg-green-500 border-2 border-[#050810] flex items-center justify-center text-white text-xs font-bold">
                            M</div>
                    </div>
                    <p class="text-sm text-gray-400">
                        Rejoignez <span class="text-white font-semibold">+2 000 créatifs</span> africains
                    </p>
                </div>

            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-[#050810] to-transparent z-10"></div>
    </section>

    <section class="bg-white py-24 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-slate-900 tracking-tight mb-4">
                    Les vrais problèmes. <span class="text-slate-400 font-medium">Les vraies solutions.</span>
                </h2>
                <div class="w-12 h-1 bg-indigo-600 rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">
                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-slate-900">Visibilité sans frontières</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Sortez de l'ombre. Un profil MeFolio optimisé pour connecter les talents aux recruteurs
                        locaux et internationaux.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-slate-900">Paiements locaux intégrés</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        L'argent arrive là où vous êtes. Retraits directs via <span
                            class="text-slate-900 font-medium">MTN MoMo, Wave, Kkiapay, Fedapay, Moov ...</span> sans détours.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-slate-900">Marketplace de missions</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Ne cherchez plus, postulez. Un accès direct aux missions freelance pour décrocher vos futurs
                        contrats en un clic.
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-slate-900">Écosystème startup africain fragmenté</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        L'élite de l'écosystème. Hackathons, challenges créatifs et programmes <span class="text-slate-900 font-medium">Sèmè
                            City & ASIN</span> regroupés au même endroit.
                    </p>
                </div>
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

                            <button
                                class="flex items-center gap-1.5 px-2 py-1 text-gray-400 hover:text-red-500 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-[11px] font-bold">24</span>
                            </button>
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

                    <div class="mt-'' flex gap-6">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-20 gap-x-12">
                @foreach ($creatifs as $creatif)
                    <div class="group relative pt-8">
                        <div
                            class="relative bg-zinc-900 rounded-[2.5rem] p-8 transition-all duration-500 group-hover:shadow-[0_40px_80px_-15px_rgba(0,0,0,0.35)] group-hover:-translate-y-2 border border-white/5">

                            <div class="absolute -top-12 left-8">
                                <div class="relative">
                                    <img class="w-28 h-28 rounded-3xl object-cover shadow-2xl -rotate-6 group-hover:rotate-0 group-hover:scale-105 transition-all duration-500 border-4 border-white"
                                        src="{{ $creatif->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($creatif->prenom ?? 'M') . '&background=6366f1&color=fff' }}"
                                        alt="{{ $creatif->nom }}">
                                    <div
                                        class="absolute inset-0 rounded-3xl bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-12">

                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400/80">
                                    {{ $creatif->specialite ?? 'Créatif' }}
                                </span>

                                <a href="{{ route('creatifs.show', $creatif->slug) }}" class="block mt-2">
                                    <h3 class="text-2xl font-bold text-white transition-colors">
                                        {{ $creatif->prenom }} <span class="text-blue-500">{{ $creatif->nom }}</span>
                                    </h3>
                                </a>

                                <p
                                    class="mt-4 text-gray-400 text-sm leading-relaxed line-clamp-3 group-hover:text-gray-300 transition-colors">
                                    {{ Str::limit($creatif->bio, 100) }}
                                </p>

                                <div class="mt-4 pt-4 border-t border-white/5 flex items-center justify-between">
                                    <a href="{{ route('creatifs.show', $creatif->slug) }}"
                                        class="text-[10px] font-bold uppercase tracking-widest text-gray-500 group-hover:text-white transition-colors">
                                        Voir le profil
                                    </a>

                                    <div class="flex items-center gap-4">
                                        @if ($creatif->github)
                                            <a href="{{ $creatif->github }}" target="_blank"
                                                class="text-gray-500 hover:text-white transition-all transform hover:-translate-y-1">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.041-1.416-4.041-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if ($creatif->linkedin)
                                            <a href="{{ $creatif->linkedin }}" target="_blank"
                                                class="text-gray-500 hover:text-[#0077b5] transition-all transform hover:-translate-y-1">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <section class="py-24 px-6 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    L'expérience <span class="text-indigo-600">MeFolio</span>
                </h2>
                <p class="text-slate-500 mt-3 text-lg">
                    Ce que disent les talents qui font bouger les lignes.
                </p>
            </div>

            <a href="#"
                class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-indigo-600 transition-all duration-300">
                Partager mon avis
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div
                class="bg-slate-50 p-8 rounded-3xl border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-xl hover:shadow-indigo-50/50 transition-all duration-500">
                <div class="flex items-center gap-3 mb-6">
                    <img src="https://storage.googleapis.com/monecocmsfiles/thumbnail_Reussir_en_tant_que_freelance_en_Afrique_1f1130c913/thumbnail_Reussir_en_tant_que_freelance_en_Afrique_1f1130c913.jpg"
                        class="w-10 h-10 rounded-xl" alt="Koffi Mensah">
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Koffi Mensah</h4>
                        <p class="text-[10px] text-indigo-600 font-black uppercase tracking-widest">Fullstack Dev</p>
                    </div>
                </div>
                <p class="text-slate-600 leading-relaxed text-sm">
                    "Grâce à <span class="font-bold text-slate-900">MeFolio</span>, mes projets sont présentés avec le
                    prestige qu'ils méritent. C'est l'outil qui manquait à notre écosystème."
                </p>
            </div>

            <div
                class="bg-slate-50 p-8 rounded-3xl border border-transparent hover:border-purple-100 hover:bg-white hover:shadow-xl hover:shadow-purple-50/50 transition-all duration-500">
                <div class="flex items-center gap-3 mb-6">
                    <img src="https://nexlance.net/assets/uploads/media-uploader/IMAGE%20011751291135.jpg"
                        class="w-10 h-10 rounded-xl" alt="Aïcha Diallo">
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Aïcha Diallo</h4>
                        <p class="text-[10px] text-purple-600 font-black uppercase tracking-widest">UX Designer</p>
                    </div>
                </div>
                <p class="text-slate-600 leading-relaxed text-sm">
                    "Une visibilité immédiate auprès des recruteurs locaux. L’interface est une masterclass de
                    minimalisme. Je recommande sans hésiter !"
                </p>
            </div>

            <div
                class="bg-slate-50 p-8 rounded-3xl border border-transparent hover:border-amber-100 hover:bg-white hover:shadow-xl hover:shadow-amber-50/50 transition-all duration-500">
                <div class="flex items-center gap-3 mb-6">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThjfdhNte8pAfRXIZjkMjczmSn8icmhUiCtA&s"
                        class="w-10 h-10 rounded-xl" alt="Jean H.">
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Jean H.</h4>
                        <p class="text-[10px] text-amber-600 font-black uppercase tracking-widest">Tech Student</p>
                    </div>
                </div>
                <p class="text-slate-600 leading-relaxed text-sm">
                    "C’est devenu mon CV numérique ultime. Idéal pour sortir du lot et monétiser mes premières missions
                    en freelance."
                </p>
            </div>

        </div>
    </section>

    <section class="py-24 px-6 max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                Questions fréquentes
            </h2>
            <p class="text-slate-500 mt-4 font-medium">
                Tout ce que vous devez savoir pour propulser votre carrière sur MeFolio.
            </p>
        </div>

        <div class="space-y-4">

            <details class="group border-b border-slate-100 pb-4" open>
                <summary class="flex items-center justify-between cursor-pointer list-none py-4">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                        Comment créer mon portfolio ?
                    </h3>
                    <span class="text-slate-400 group-open:rotate-180 transition-transform duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </summary>
                <div class="text-slate-500 leading-relaxed text-base pb-4">
                    Le processus est instantané. Cliquez sur « S’inscrire », validez votre email et personnalisez votre
                    espace. Pas de configuration complexe, juste votre talent mis en avant.
                </div>
            </details>

            <details class="group border-b border-slate-100 pb-4">
                <summary class="flex items-center justify-between cursor-pointer list-none py-4">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                        Est-ce vraiment gratuit ?
                    </h3>
                    <span class="text-slate-400 group-open:rotate-180 transition-transform duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </summary>
                <div class="text-slate-500 leading-relaxed text-base pb-4">
                    Oui, l'accès de base et la publication de projets sont 100% gratuits. Nous croyons en
                    l'accessibilité du talent local pour dynamiser l'écosystème tech en Afrique.
                </div>
            </details>

            <details class="group border-b border-slate-100 pb-4">
                <summary class="flex items-center justify-between cursor-pointer list-none py-4">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                        Comment les recruteurs me trouvent-ils ?
                    </h3>
                    <span class="text-slate-400 group-open:rotate-180 transition-transform duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </summary>
                <div class="text-slate-500 leading-relaxed text-base pb-4">
                    Votre profil est indexé dans notre moteur de recherche de talents. Vous disposez aussi d'une URL
                    personnalisée professionnelle que vous pouvez partager directement sur votre CV ou LinkedIn.
                </div>
            </details>

            <details class="group border-b border-slate-100 pb-4">
                <summary class="flex items-center justify-between cursor-pointer list-none py-4">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                        Quels types de fichiers puis-je publier ?
                    </h3>
                    <span class="text-slate-400 group-open:rotate-180 transition-transform duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </summary>
                <div class="text-slate-500 leading-relaxed text-base pb-4">
                    Vous pouvez importer des images (JPG, PNG), lier des dépôts GitHub pour le code, ou intégrer des
                    liens externes comme Figma, Behance ou des vidéos de démonstration.
                </div>
            </details>

        </div>

        {{-- <div class="mt-16 p-8 bg-slate-50 rounded-[2rem] text-center border border-slate-100">
            <p class="text-slate-900 font-bold mb-4">Vous avez d'autres questions ?</p>
            <a href="mailto:support@mefolio.com" class="text-indigo-600 font-bold hover:underline">
                Contactez notre équipe &rarr;
            </a>
        </div> --}}
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
                    <a href="#"
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


    @extends('layouts.footer')


</x-app-layout>

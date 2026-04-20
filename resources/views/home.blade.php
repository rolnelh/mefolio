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

    <section class="relative bg-[#050810] py-32 sm:py-28 overflow-hidden">

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
                    <span class="mr-2">🌍</span> La première plateforme africaine des talents créatifs
                </div>

                <h1 class="text-5xl font-extrabold tracking-tight text-white sm:text-7xl leading-[1.05]">
                    Le talent africain<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">
                        mérite une scène mondiale.
                    </span>
                </h1>

                <p class="mt-8 text-lg md:text-xl leading-relaxed text-gray-400 font-light max-w-2xl mx-auto">
                    Mefolio est la plateforme pensée pour les créatifs et étudiants africains.
                    Construisez votre portfolio, soyez découverts par des recruteurs,
                    et monétisez vos compétences avec
                    <span class="text-gray-200 font-medium">Mobile Money.</span>
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
                            Créer mon portfolio gratuit
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                        <a href="{{ route('projects.index') }}"
                            class="group flex items-center gap-2 text-sm font-bold text-gray-300 hover:text-white transition-colors py-3">
                            Explorer les projets
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

    {{-- <section class="bg-white py-16 px-6">
        <div class="max-w-5xl mx-auto">
            <div
                class="grid grid-cols-2 md:grid-cols-4 gap-12 py-8 border-y border-gray-100 items-center justify-center text-center">

                <div class="flex flex-col gap-2">
                    <span class="text-3xl md:text-4xl font-medium text-gray-900 tracking-tight">
                        2,000<span class="text-gray-400 font-light">+</span>
                    </span>
                    <span class="text-[10px] md:text-xs font-medium uppercase tracking-[0.25em] text-gray-400">
                        Créatifs
                    </span>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-3xl md:text-4xl font-medium text-gray-900 tracking-tight">
                        5k<span class="text-gray-400 font-light">+</span>
                    </span>
                    <span class="text-[10px] md:text-xs font-medium uppercase tracking-[0.25em] text-gray-400">
                        Projets
                    </span>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-3xl md:text-4xl font-medium text-gray-900 tracking-tight">
                        15<span class="text-gray-400 font-light">+</span>
                    </span>
                    <span class="text-[10px] md:text-xs font-medium uppercase tracking-[0.25em] text-gray-400">
                        Pays
                    </span>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-3xl md:text-4xl font-medium text-gray-900 tracking-tight">
                        98<span class="text-gray-400 font-light">%</span>
                    </span>
                    <span class="text-[10px] md:text-xs font-medium uppercase tracking-[0.25em] text-gray-400">
                        Satisfaction
                    </span>
                </div>

            </div>
        </div>
    </section> --}}

    <section class="bg-white py-24 px-6">
        <div class="max-w-5xl mx-auto">

            <div class="mb-16">
                <h2 class="text-2xl md:text-3xl font-medium text-gray-900 tracking-tight mb-4">
                    Pourquoi choisir <span class="text-blue-600">Mefolio</span>
                </h2>
                <p class="text-gray-500 text-lg max-w-xl font-light leading-relaxed">
                    Une approche directe pour mettre en avant votre travail.
                    <span class="text-gray-900">L'essentiel, tout simplement.</span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-20 gap-y-16">

                <div class="group">
                    <div class="text-blue-600 mb-5 transition-transform duration-300 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 tracking-tight">Mise en avant des talents</h3>
                    <p class="text-gray-500 leading-relaxed font-light text-sm md:text-base">
                        Créez un profil professionnel en quelques minutes et partagez vos projets avec une interface
                        optimisée pour le SEO.
                    </p>
                </div>

                <div class="group">
                    <div class="text-blue-600 mb-5 transition-transform duration-300 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04C3.063 6.267 3 6.99 3 7.771c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-.781-.063-1.504-.182-2.243z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 tracking-tight">Sécurité des données</h3>
                    <p class="text-gray-500 leading-relaxed font-light text-sm md:text-base">
                        Vos créations sont protégées par des standards élevés. Vous gardez le contrôle total sur votre
                        contenu.
                    </p>
                </div>

                <div class="group">
                    <div class="text-blue-600 mb-5 transition-transform duration-300 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 tracking-tight">Simplicité d'utilisation</h3>
                    <p class="text-gray-500 leading-relaxed font-light text-sm md:text-base">
                        Une interface pensée pour être prise en main immédiatement. Pas de configuration complexe, juste
                        votre talent.
                    </p>
                </div>

                <div class="group">
                    <div class="text-blue-600 mb-5 transition-transform duration-300 group-hover:-translate-y-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 tracking-tight">Communauté active</h3>
                    <p class="text-gray-500 leading-relaxed font-light text-sm md:text-base">
                        Rejoignez un réseau de créatifs passionnés. Échangez des idées et trouvez vos futurs
                        collaborateurs.
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
                <div class="max-w-4xl">
                    <h2
                        class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-gray-900 leading-[0.95]">
                        Nos talents <br>
                        <span class="text-blue-600">créatifs</span>
                    </h2>

                    <div class="mt-8 flex gap-6">
                        <div class="w-1 bg-blue-600 rounded-full"></div>
                        <p class="text-lg md:text-xl text-gray-500 leading-relaxed max-w-md">
                            L'élite de notre communauté. Des esprits audacieux qui repoussent les limites du possible.
                        </p>
                    </div>
                </div>

                <div class="pb-2">
                    <a href="{{ route('creatifs.index') }}"
                        class="group inline-flex items-center gap-4 text-gray-900 font-bold uppercase tracking-[0.2em] text-[11px] transition-all">
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
                    <div class="group relative pt-12">
                        <div
                            class="relative bg-zinc-900 rounded-[2.5rem] p-8 transition-all duration-500 group-hover:shadow-[0_40px_80px_-15px_rgba(0,0,0,0.35)] group-hover:-translate-y-2 border border-white/5">

                            <div class="absolute -top-12 left-8">
                                <div class="relative">
                                    <img class="w-28 h-28 rounded-3xl object-cover shadow-2xl -rotate-6 group-hover:rotate-0 group-hover:scale-105 transition-all duration-500 border-4 border-white"
                                        src="{{ $creatif->photo ? asset('storage/' . $creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($creatif->prenom) . '&background=random' }}"
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

    <section class="py-24 px-6 max-w-7xl mx-auto overflow-hidden">

        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
            <div class="max-w-2xl">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight">
                    Ils parlent de leur expérience <br>
                    <span class="text-indigo-600">sur Mefolio.</span>
                </h2>
                <p class="text-gray-500 mt-4 text-lg font-medium">Découvrez pourquoi les créatifs choisissent notre
                    plateforme pour propulser leur carrière.</p>
            </div>

            <button
                class="group inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white text-sm font-bold rounded-2xl hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-gray-200">
                Donner votre avis
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </button>
        </div>

        <div class="py-12 bg-white overflow-hidden relative">
            <div
                class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-gray-50 via-gray-50/40 to-transparent z-10">
            </div>
            <div
                class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-gray-50 via-gray-50/40 to-transparent z-10">
            </div>

            <div
                class="flex animate-marquee hover:[animation-play-state:paused] gap-8 whitespace-nowrap items-start w-max">

                <div class="flex gap-8 items-start">
                    <div
                        class="w-[380px] whitespace-normal flex-shrink-0 bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name=Koffi+Mensah&background=4f46e5&color=fff"
                                    class="w-12 h-12 rounded-2xl shadow-inner">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-none">Koffi Mensah</h4>
                                    <span
                                        class="text-[10px] text-indigo-600 font-black uppercase tracking-widest">Fullstack
                                        Dev</span>
                                </div>
                            </div>
                            <div class="flex text-amber-400 text-[10px]">★★★★★</div>
                        </div>
                        <p class="text-gray-600 leading-relaxed font-medium italic">
                            "Grâce à <span class="text-gray-900 font-bold">Mefolio</span>, mes projets sont présentés
                            avec le prestige qu'ils méritent. Un outil indispensable."
                        </p>
                    </div>

                    <div
                        class="w-[380px] whitespace-normal flex-shrink-0 bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name=Aicha+Diallo&background=6366f1&color=fff"
                                    class="w-12 h-12 rounded-2xl">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-none">Aïcha Diallo</h4>
                                    <span class="text-[10px] text-purple-600 font-black uppercase tracking-widest">UX
                                        Designer</span>
                                </div>
                            </div>
                            <div class="flex text-amber-400 text-[10px]">★★★★★</div>
                        </div>
                        <p class="text-gray-600 leading-relaxed font-medium italic">
                            "Une visibilité immédiate auprès des recruteurs. L’interface est une masterclass de
                            minimalisme. Je recommande !"
                        </p>
                    </div>

                    <div
                        class="w-[380px] whitespace-normal flex-shrink-0 bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name=Jean+H&background=f59e0b&color=fff"
                                    class="w-12 h-12 rounded-2xl">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-none">Jean H.</h4>
                                    <span class="text-[10px] text-amber-600 font-black uppercase tracking-widest">Tech
                                        Student</span>
                                </div>
                            </div>
                            <div class="flex text-amber-400 text-[10px]">★★★★★</div>
                        </div>
                        <p class="text-gray-600 leading-relaxed font-medium italic">
                            "C’est devenu mon CV numérique ultime. Idéal pour sortir du lot lors des candidatures en
                            agence."
                        </p>
                    </div>
                </div>

                <div class="flex gap-8 items-start" aria-hidden="true">
                    <div
                        class="w-[380px] whitespace-normal flex-shrink-0 bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name=Koffi+Mensah&background=4f46e5&color=fff"
                                    class="w-12 h-12 rounded-2xl shadow-inner">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-none">Koffi Mensah</h4>
                                    <span
                                        class="text-[10px] text-indigo-600 font-black uppercase tracking-widest">Fullstack
                                        Dev</span>
                                </div>
                            </div>
                            <div class="flex text-amber-400 text-[10px]">★★★★★</div>
                        </div>
                        <p class="text-gray-600 leading-relaxed font-medium italic">
                            "Grâce à <span class="text-gray-900 font-bold">Mefolio</span>, mes projets sont présentés
                            avec le prestige qu'ils méritent. Un outil indispensable."
                        </p>
                    </div>

                    <div
                        class="w-[380px] whitespace-normal flex-shrink-0 bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name=Aicha+Diallo&background=6366f1&color=fff"
                                    class="w-12 h-12 rounded-2xl">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-none">Aïcha Diallo</h4>
                                    <span class="text-[10px] text-purple-600 font-black uppercase tracking-widest">UX
                                        Designer</span>
                                </div>
                            </div>
                            <div class="flex text-amber-400 text-[10px]">★★★★★</div>
                        </div>
                        <p class="text-gray-600 leading-relaxed font-medium italic">
                            "Une visibilité immédiate auprès des recruteurs. L’interface est une masterclass de
                            minimalisme. Je recommande !"
                        </p>
                    </div>

                    <div
                        class="w-[380px] whitespace-normal flex-shrink-0 bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <img src="https://ui-avatars.com/api/?name=Jean+H&background=f59e0b&color=fff"
                                    class="w-12 h-12 rounded-2xl">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-none">Jean H.</h4>
                                    <span class="text-[10px] text-amber-600 font-black uppercase tracking-widest">Tech
                                        Student</span>
                                </div>
                            </div>
                            <div class="flex text-amber-400 text-[10px]">★★★★★</div>
                        </div>
                        <p class="text-gray-600 leading-relaxed font-medium italic">
                            "C’est devenu mon CV numérique ultime. Idéal pour sortir du lot lors des candidatures en
                            agence."
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-100% - 2rem));
            }

            /* -2rem pour compenser le gap */
        }

        .animate-marquee {
            animation: marquee 40s linear infinite;
        }

        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>

    <section class="py-24 px-6 bg-[#050810] text-white overflow-hidden">
        <div class="max-w-6xl mx-auto">

            <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h2 class="text-5xl font-extrabold tracking-tighter leading-none">
                        DES RÉPONSES,<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">SANS
                            DÉTOUR.</span>
                    </h2>
                    <p class="text-gray-500 mt-6 max-w-md font-medium">
                        Tout ce que vous devez savoir pour propulser votre carrière sur MeFolio.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div onclick="expandCard(this)"
                    class="md:col-span-2 group relative p-10 rounded-[2.5rem] bg-white/5 border border-white/5 cursor-pointer hover:bg-white/[0.07] transition-all duration-500 overflow-hidden min-h-[240px]">
                    <div class="relative z-10">
                        <span
                            class="flex size-8 items-center justify-center rounded-full bg-blue-500/10 text-blue-400 font-mono text-xs mb-4 border border-blue-500/20">01</span>
                        <h3 class="text-2xl font-bold">Comment créer un compte ?</h3>
                        <div
                            class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400 max-w-md leading-relaxed">
                            Le processus est instantané. Cliquez sur « S’inscrire », validez votre email et votre
                            portfolio est prêt. Pas de carte bancaire, juste votre talent.
                        </div>
                    </div>
                    <div
                        class="absolute -bottom-4 -right-4 text-8xl opacity-[0.03] group-hover:opacity-10 group-hover:-rotate-12 transition-all duration-700">
                        👤</div>
                </div>

                <div onclick="expandCard(this)"
                    class="group relative p-10 rounded-[2.5rem] bg-white/5 border border-white/5 cursor-pointer hover:bg-white/[0.07] transition-all duration-500 md:row-span-2 flex flex-col justify-start">
                    <div class="relative z-10">
                        <span
                            class="flex size-8 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-400 font-mono text-xs mb-4 border border-emerald-500/20">02</span>
                        <h3 class="text-2xl font-bold italic">Mefolio est-il gratuit ?</h3>
                        <div
                            class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400 leading-relaxed">
                            Oui, 100% gratuit. Nous croyons en l'accessibilité du talent local. Des options de boost de
                            visibilité seront disponibles prochainement.
                        </div>
                    </div>
                    <div
                        class="absolute bottom-10 right-10 text-6xl opacity-[0.03] group-hover:opacity-10 group-hover:scale-125 transition-all duration-700">
                        💎</div>
                </div>

                <div onclick="expandCard(this)"
                    class="group relative p-10 rounded-[2.5rem] bg-white/5 border border-white/5 cursor-pointer hover:bg-white/[0.07] transition-all duration-500 min-h-[240px]">
                    <div class="relative z-10">
                        <span
                            class="flex size-8 items-center justify-center rounded-full bg-indigo-500/10 text-indigo-400 font-mono text-xs mb-4 border border-indigo-500/20">03</span>
                        <h3 class="text-2xl font-bold">Publier un projet</h3>
                        <div
                            class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400 leading-relaxed">
                            Glissez vos images, liez GitHub ou Behance, et validez. Votre travail est exposé au monde.
                        </div>
                    </div>
                    <div
                        class="absolute -bottom-4 -right-4 text-7xl opacity-[0.03] group-hover:opacity-10 group-hover:-translate-y-4 transition-all duration-700">
                        🚀</div>
                </div>

                <div onclick="expandCard(this)"
                    class="group relative p-10 rounded-[2.5rem] bg-white/5 border border-white/5 cursor-pointer hover:bg-white/[0.07] transition-all duration-500 min-h-[240px]">
                    <div class="relative z-10">
                        <span
                            class="flex size-8 items-center justify-center rounded-full bg-orange-500/10 text-orange-400 font-mono text-xs mb-4 border border-orange-500/20">04</span>
                        <h3 class="text-2xl font-bold">Partage recruteurs</h3>
                        <div
                            class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400 leading-relaxed">
                            Votre URL personnalisée est votre nouvelle carte de visite numérique. Simple, pro, efficace.
                        </div>
                    </div>
                    <div
                        class="absolute -bottom-4 -right-4 text-7xl opacity-[0.03] group-hover:opacity-10 group-hover:rotate-12 transition-all duration-700">
                        🔗</div>
                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-10 border-t border-gray-100 pt-16">

            <div class="max-w-2xl">
                <h3 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight leading-[1.1]">
                    Prêt à booster <br />
                    <span class="text-blue-600">votre visibilité ?</span>
                </h3>
                <p class="text-lg text-gray-500 mt-6 max-w-md leading-relaxed">
                    Rejoignez plus de <span class="font-semibold text-gray-900">2000+ créatifs</span> qui font déjà
                    briller leur talent sur Mefolio.
                </p>
            </div>

            <div class="flex items-center">
                <a href="#"
                    class="group relative inline-flex items-center justify-center px-10 py-4 font-semibold text-white bg-blue-600 rounded-full overflow-hidden transition-all duration-300 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 active:scale-95">
                    <span>Créer mon portfolio</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    <script>
        function expandCard(element) {
            // Optionnel : Fermer les autres cartes ouvertes
            document.querySelectorAll('.content').forEach(el => {
                el.classList.add('opacity-0', 'translate-y-4');
                el.closest('div[onclick]').classList.remove('ring-2', 'ring-purple-500/20');
            });

            // Ouvrir la carte actuelle
            const content = element.querySelector('.content');
            content.classList.toggle('opacity-0');
            content.classList.toggle('translate-y-4');
        }
    </script>

    @extends('layouts.footer')


</x-app-layout>

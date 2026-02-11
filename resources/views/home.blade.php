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

    <section class="relative bg-gray-900 py-28 sm:py-40 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80"
                alt="Background" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/80 via-gray-900/60 to-gray-900/80"></div>
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">

                <span
                    class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm font-medium text-white ring-1 ring-inset ring-white/20 mb-8 backdrop-blur-sm">
                    Propulsé par la créativité
                </span>

                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                    Partagez vos projets, <span class="text-gray-400 font-light italic">inspirez le monde</span>
                </h1>

                <p class="mt-8 text-lg leading-8 text-gray-300 font-light">
                    Créez votre profil en quelques clics, présentez vos plus belles réalisations et rejoignez une
                    communauté de créatifs passionnés.
                </p>

                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-6">
                    @guest
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto rounded-xl bg-white px-8 py-4 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 transition-all">
                            Commencer maintenant
                        </a>
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold leading-6 text-white hover:text-gray-300 transition-colors">
                            Nous contacter <span aria-hidden="true">→</span>
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="w-full sm:w-auto rounded-xl bg-white px-8 py-4 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 transition-all">
                            Explorer les projets
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white py-20 px-6">
        <div class="max-w-6xl mx-auto">

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi choisir Mefolio ?</h2>
                <p class="text-gray-500 text-lg max-w-2xl font-light">
                    Une approche directe pour mettre en avant votre travail, sans fioritures inutiles.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <div class="flex gap-6 transition-opacity hover:opacity-80">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Mise en avant des talents</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Créez un profil professionnel en quelques minutes et partagez vos projets avec le monde
                            entier.
                        </p>
                    </div>
                </div>

                <div class="flex gap-6 transition-opacity hover:opacity-80">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04C3.063 6.267 3 6.99 3 7.771c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-.781-.063-1.504-.182-2.243z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Sécurité des données</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Vos informations et vos créations sont protégées. Vous gardez le contrôle total sur votre
                            contenu.
                        </p>
                    </div>
                </div>

                <div class="flex gap-6 transition-opacity hover:opacity-80">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Simplicité d'utilisation</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Une interface pensée pour être prise en main immédiatement, sans courbe d'apprentissage.
                        </p>
                    </div>
                </div>

                <div class="flex gap-6 transition-opacity hover:opacity-80">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Communauté active</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Rejoignez un réseau de créatifs passionnés pour échanger et trouver l'inspiration.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-8 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Projets récents</h2>
                <a href="{{ route('projects.index') }}"
                    class="flex items-center gap-1 text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <span class="font-semibold">Voir tous</span>
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">

                @foreach ($projects as $project)
                    <article class="group relative flex flex-col bg-transparent transition-all duration-500">

                        <div
                            class="relative aspect-[4/3] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 dark:bg-gray-800 shadow-sm transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-indigo-500/20">

                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />

                            <div class="absolute top-4 left-4 z-10">
                                <span
                                    class="inline-flex items-center rounded-full bg-white/70 dark:bg-black/50 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-900 dark:text-white backdrop-blur-md border border-white/20">
                                    {{ $project->category ?? 'Design' }}
                                </span>
                            </div>

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-indigo-900/80 via-transparent to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                                <div class="absolute bottom-6 left-6 right-6">
                                    <div class="flex items-center justify-between">
                                        <div
                                            class="transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                                            <h3 class="text-xl font-bold text-white leading-tight">
                                                {{ $project->title }}
                                            </h3>
                                        </div>

                                        <a href="{{ route('projects.show', $project->slug) }}"
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-indigo-600 shadow-lg transform scale-0 transition-transform duration-500 delay-100 group-hover:scale-100 hover:bg-indigo-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-between px-4">
                            <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                class="group/author flex items-center gap-3">
                                <div class="relative flex-shrink-0">
                                    <img src="{{ $project->creatif->photo ? asset('storage/' . $project->creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($project->creatif->prenom) }}"
                                        class="size-8 rounded-full border-2 border-white dark:border-gray-900 shadow-sm transition-transform group-hover/author:scale-110" />
                                    <div
                                        class="absolute -bottom-0.5 -right-0.5 size-2.5 rounded-full bg-green-500 border-2 border-white dark:border-gray-900">
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100 leading-none">
                                        {{ $project->creatif->prenom }}
                                    </span>
                                    <span class="text-[10px] text-gray-500 font-medium">@
                                        {{ $project->creatif->slug }}</span>
                                </div>
                            </a>

                            <button
                                class="flex items-center gap-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-xs font-bold">24</span>
                            </button>
                        </div>
                    </article>
                @endforeach

                <article class="group relative flex flex-col bg-transparent transition-all duration-500">
                    <div
                        class="relative aspect-[4/3] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 dark:bg-gray-800 shadow-sm transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-indigo-500/20">

                        <img src="https://images.pexels.com/photos/7411936/pexels-photo-7411936.jpeg"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Projet">

                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="inline-flex items-center rounded-full bg-white/70 dark:bg-black/50 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-900 dark:text-white backdrop-blur-md border border-white/20">
                                Concept
                            </span>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-indigo-900/80 via-transparent to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            <div class="absolute bottom-6 left-6 right-6">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                                        <h3 class="text-xl font-bold text-white leading-tight">Architecture Flow
                                        </h3>
                                    </div>
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-indigo-600 shadow-lg transform scale-0 transition-transform duration-500 delay-100 group-hover:scale-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between px-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.pexels.com/photos/7411936/pexels-photo-7411936.jpeg"
                                class="size-8 rounded-full border-2 border-white dark:border-gray-900 shadow-sm"
                                alt="Auteur">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 dark:text-gray-100 leading-none">Jane
                                    Doe</span>
                                <span class="text-[10px] text-gray-500 font-medium">@janedoe</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </article>

                <article class="group relative flex flex-col bg-transparent transition-all duration-500">
                    <div
                        class="relative aspect-[4/3] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 dark:bg-gray-800 shadow-sm transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-indigo-500/20">

                        <img src="https://images.pexels.com/photos/4348165/pexels-photo-4348165.jpeg"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Projet">

                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="inline-flex items-center rounded-full bg-white/70 dark:bg-black/50 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-900 dark:text-white backdrop-blur-md border border-white/20">
                                Minimalist
                            </span>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-indigo-900/80 via-transparent to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            <div class="absolute bottom-6 left-6 right-6">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                                        <h3 class="text-xl font-bold text-white leading-tight">Brand Identity</h3>
                                    </div>
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-indigo-600 shadow-lg transform scale-0 transition-transform duration-500 delay-100 group-hover:scale-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center justify-between px-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.pexels.com/photos/4348165/pexels-photo-4348165.jpeg"
                                class="size-8 rounded-full border-2 border-white dark:border-gray-900 shadow-sm"
                                alt="Auteur">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 dark:text-gray-100 leading-none">Jane
                                    Doe</span>
                                <span class="text-[10px] text-gray-500 font-medium">@janedoe</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </article>

                <article class="group relative flex flex-col transition-all duration-500">
                    <div
                        class="relative aspect-[4/3] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 shadow-sm transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-blue-500/20">
                        <img src="https://images.pexels.com/photos/32798951/pexels-photo-32798951.jpeg"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Projet">

                        <div class="absolute top-5 left-5 z-10">
                            <span
                                class="inline-flex items-center rounded-full bg-white/80 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-900 backdrop-blur-md border border-white/20">
                                Développement Web
                            </span>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            <div class="absolute bottom-8 left-8 right-8">
                                <h3
                                    class="text-xl font-bold text-white mb-2 transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                                    Développeur Front-End
                                </h3>
                                <p
                                    class="text-xs text-gray-300 line-clamp-2 transform translate-y-4 transition-transform duration-500 delay-75 group-hover:translate-y-0">
                                    Rejoignez une équipe dynamique pour créer des interfaces modernes.
                                </p>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0"></a>
                    </div>

                    <div class="mt-5 flex items-center justify-between px-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.pexels.com/photos/32798951/pexels-photo-32798951.jpeg"
                                class="size-9 rounded-full object-cover border-2 border-white shadow-sm"
                                alt="Tech Solutions">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 leading-none">Tech Solutions</span>
                                <span class="text-[10px] text-gray-500 font-medium">Paris, France</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </article>

                <article class="group relative flex flex-col transition-all duration-500">
                    <div
                        class="relative aspect-[4/3] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 shadow-sm transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-blue-500/20">
                        <img src="https://images.pexels.com/photos/28847487/pexels-photo-28847487.jpeg"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Projet">

                        <div class="absolute top-5 left-5 z-10">
                            <span
                                class="inline-flex items-center rounded-full bg-white/80 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-900 backdrop-blur-md border border-white/20">
                                Développement Web
                            </span>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <h3
                                    class="text-xl font-bold transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                                    Interface Design
                                </h3>
                                <p
                                    class="text-xs text-gray-300 line-clamp-2 transform translate-y-4 transition-transform duration-500 delay-75 group-hover:translate-y-0">
                                    Optimisation UX/UI pour applications SaaS.
                                </p>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0"></a>
                    </div>

                    <div class="mt-5 flex items-center justify-between px-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.pexels.com/photos/28847487/pexels-photo-28847487.jpeg"
                                class="size-9 rounded-full object-cover border-2 border-white shadow-sm"
                                alt="Tech Solutions">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 leading-none">Tech Solutions</span>
                                <span class="text-[10px] text-gray-500 font-medium">Paris, France</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </article>

                <article class="group relative flex flex-col transition-all duration-500">
                    <div
                        class="relative aspect-[4/3] w-full overflow-hidden rounded-[2.5rem] bg-gray-100 shadow-sm transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl group-hover:shadow-blue-500/20">
                        <img src="https://images.pexels.com/photos/33229943/pexels-photo-33229943.jpeg"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="Projet">

                        <div class="absolute top-5 left-5 z-10">
                            <span
                                class="inline-flex items-center rounded-full bg-white/80 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-900 backdrop-blur-md border border-white/20">
                                Développement Web
                            </span>
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100">
                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <h3
                                    class="text-xl font-bold transform translate-y-4 transition-transform duration-500 group-hover:translate-y-0">
                                    Full-Stack Vision
                                </h3>
                                <p
                                    class="text-xs text-gray-300 line-clamp-2 transform translate-y-4 transition-transform duration-500 delay-75 group-hover:translate-y-0">
                                    Maîtrise complète du cycle de développement.
                                </p>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0"></a>
                    </div>

                    <div class="mt-5 flex items-center justify-between px-4">
                        <div class="flex items-center gap-3">
                            <img src="https://images.pexels.com/photos/33229943/pexels-photo-33229943.jpeg"
                                class="size-9 rounded-full object-cover border-2 border-white shadow-sm"
                                alt="Tech Solutions">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-900 leading-none">Tech Solutions</span>
                                <span class="text-[10px] text-gray-500 font-medium">Lyon, France</span>
                            </div>
                        </div>
                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <section class="py-20 md:py-32 bg-[#0a0a0a] text-white overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-6">
                <div class="max-w-2xl">
                    <h2
                        class="text-5xl md:text-7xl font-black tracking-tighter uppercase italic leading-none text-white">
                        Nos talents <span
                            class="text-transparent border-b border-red-600 bg-clip-text bg-gradient-to-r from-red-600 to-orange-400">créatifs</span>
                    </h2>
                    <p class="mt-6 text-xl text-gray-400 font-medium max-w-md border-l-2 border-red-600 pl-6">
                        L'élite de notre communauté. Des esprits audacieux qui repoussent les limites du possible.
                    </p>
                </div>
                <a href="{{route('creatifs.index')}}"
                    class="group flex items-center gap-3 text-red-500 font-bold uppercase tracking-widest text-xs transition-all hover:gap-5">
                    Voir tout l'écosystème
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-24 gap-x-12">

                <div class="group relative pt-16">
                    <div
                        class="absolute -top-4 -right-4 text-8xl font-black text-white/5 pointer-events-none group-hover:text-red-600/10 transition-colors duration-500 italic">
                        01</div>
                    <div
                        class="relative bg-zinc-900 rounded-[3rem] p-8 transition-all duration-500 group-hover:bg-zinc-800 shadow-2xl">
                        <div class="absolute -top-16 left-8">
                            <div class="relative">
                                <img class="w-32 h-32 rounded-[2rem] object-cover shadow-2xl rotate-3 group-hover:rotate-0 transition-transform duration-500 border-4 border-zinc-900"
                                    src="https://images.unsplash.com/photo-1549068106-b024baf5062d?auto=format&fit=crop&w=400&q=80"
                                    alt="William">
                                <div
                                    class="absolute inset-0 rounded-[2rem] bg-red-600/20 mix-blend-overlay opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                        </div>

                        <div class="mt-16">
                            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-red-500">UI
                                Developer</span>
                            <h3 class="text-2xl font-bold mt-2 group-hover:text-red-500 transition-colors">William
                                Rocheald</h3>
                            <p class="mt-4 text-gray-400 text-sm leading-relaxed line-clamp-3">
                                Développeur passionné par les interfaces modernes et l’expérience utilisateur fluide.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative pt-16">
                    <div class="absolute -top-4 -right-4 text-8xl font-black text-white/5 pointer-events-none italic">
                        02</div>
                    <div
                        class="relative bg-zinc-900 rounded-[3rem] p-8 transition-all duration-500 group-hover:bg-zinc-800 shadow-2xl">
                        <div class="absolute -top-16 left-8">
                            <img class="w-32 h-32 rounded-[2rem] object-cover shadow-2xl -rotate-3 group-hover:rotate-0 transition-transform duration-500 border-4 border-zinc-900"
                                src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&w=400"
                                alt="Jane">
                        </div>
                        <div class="mt-16">
                            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-red-500">UX
                                Designer</span>
                            <h3 class="text-2xl font-bold mt-2 group-hover:text-red-500 transition-colors">Jane Smith
                            </h3>
                            <p class="mt-4 text-gray-400 text-sm leading-relaxed line-clamp-3">
                                L'art de simplifier le complexe. Jane transforme les besoins utilisateurs en parcours
                                intuitifs.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group relative pt-16">
                    <div class="absolute -top-4 -right-4 text-8xl font-black text-white/5 pointer-events-none italic">
                        03</div>
                    <div
                        class="relative bg-zinc-900 rounded-[3rem] p-8 transition-all duration-500 group-hover:bg-zinc-800 shadow-2xl border border-white/5">
                        <div class="absolute -top-16 left-8">
                            <img class="w-32 h-32 rounded-[2rem] object-cover shadow-2xl rotate-6 group-hover:rotate-0 transition-transform duration-500 border-4 border-zinc-900"
                                src="https://images.pexels.com/photos/28908606/pexels-photo-28908606.jpeg"
                                alt="Sarah">
                        </div>
                        <div class="mt-16">
                            <span
                                class="text-[10px] font-bold uppercase tracking-[0.3em] text-red-500">Photographe</span>
                            <h3 class="text-2xl font-bold mt-2 group-hover:text-red-500 transition-colors">Sarah Dupont
                            </h3>
                            <p class="mt-4 text-gray-400 text-sm leading-relaxed line-clamp-3">
                                Capturer l'invisible. Sarah fige des moments d'éternité avec une touche brute et
                                authentique.
                            </p>
                        </div>
                    </div>
                </div>

                @foreach ($creatifs as $creatif)
                    <div class="group relative pt-16">
                        <div
                            class="relative bg-zinc-900 rounded-[3rem] p-8 transition-all duration-500 group-hover:bg-zinc-800 shadow-2xl border border-white/5">
                            <div class="absolute -top-16 left-8">
                                <img class="w-32 h-32 rounded-[2rem] object-cover shadow-2xl rotate-3 group-hover:rotate-0 transition-transform duration-500 border-4 border-zinc-900"
                                    src="{{ $creatif->photo ? asset('storage/' . $creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($creatif->nom) . '&background=random' }}"
                                    alt="{{ $creatif->nom }}">
                            </div>
                            <div class="mt-16">
                                <span
                                    class="text-[10px] font-bold uppercase tracking-[0.3em] text-red-500">{{ $creatif->specialite }}</span>
                                <a href="{{ route('creatifs.show', $creatif->slug) }}">
                                    <h3 class="text-2xl font-bold mt-2 hover:text-red-500 transition-colors">
                                        {{ $creatif->prenom }} {{ $creatif->nom }}</h3>
                                </a>
                                <p class="mt-4 text-gray-400 text-sm leading-relaxed line-clamp-3">
                                    {{ Str::limit($creatif->bio, 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="bg-[#050505] py-24 px-4 overflow-hidden relative">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-red-900/10 via-transparent to-transparent pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto relative z-10">

            <div class="flex flex-col md:flex-row items-center justify-between mb-20 gap-8">
                <div class="max-w-xl text-center md:text-left">
                    <h2
                        class="text-4xl md:text-6xl font-black text-white leading-none tracking-tighter uppercase italic">
                        Validé par <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-400">la
                            communauté.</span>
                    </h2>
                </div>

                <div
                    class="bg-zinc-900/50 backdrop-blur-xl border border-white/10 p-6 rounded-3xl flex items-center gap-6 shadow-2xl">
                    <div class="text-center">
                        <p class="text-3xl font-black text-white">4.9<span class="text-red-500">/5</span></p>
                        <div class="flex text-red-500 text-xs mt-1">★★★★★</div>
                    </div>
                    <div class="h-10 w-[1px] bg-white/10"></div>
                    <p class="text-sm font-bold text-gray-400 leading-tight uppercase tracking-widest">
                        Basé sur <br /> <span class="text-white">200+ avis vérifiés</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div
                    class="group bg-zinc-900/40 backdrop-blur-md border border-white/5 p-8 rounded-[2.5rem] hover:bg-zinc-800/60 transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name=Koffi+Mensah&background=ef4444&color=fff"
                                alt="Koffi"
                                class="w-14 h-14 rounded-2xl rotate-3 group-hover:rotate-0 transition-transform">
                            <div
                                class="absolute -bottom-1 -right-1 bg-green-500 w-4 h-4 rounded-full border-2 border-zinc-900 flex items-center justify-center">
                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg tracking-tight">Koffi Mensah</h4>
                            <p class="text-[10px] text-red-500 font-black uppercase tracking-[0.2em]">Fullstack Dev</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-300 leading-relaxed text-lg font-medium">
                        "Grâce à <span class="text-white font-bold">Mefolio</span>, j'ai pulvérisé mes objectifs. Mes
                        projets sont enfin présentés avec le prestige qu'ils méritent."
                    </blockquote>
                    <div class="mt-8 pt-6 border-t border-white/5 flex gap-2">
                        <span
                            class="text-[9px] bg-white/5 px-3 py-1 rounded-full text-gray-400 font-bold uppercase tracking-tighter">#Portfolio</span>
                        <span
                            class="text-[9px] bg-white/5 px-3 py-1 rounded-full text-gray-400 font-bold uppercase tracking-tighter">#Freelance</span>
                    </div>
                </div>

                <div
                    class="group bg-gradient-to-br from-zinc-900/80 to-zinc-900/20 backdrop-blur-md border border-white/5 p-8 rounded-[2.5rem] hover:border-red-500/30 transition-all duration-500">
                    <div class="mb-6 flex justify-between items-start">
                        <div class="flex items-center gap-4">
                            <img src="https://ui-avatars.com/api/?name=Aicha+Diallo&background=6366F1&color=fff"
                                alt="Aicha"
                                class="w-14 h-14 rounded-2xl -rotate-3 group-hover:rotate-0 transition-transform">
                            <div>
                                <h4 class="font-bold text-white text-lg tracking-tight">Aïcha Diallo</h4>
                                <p class="text-[10px] text-indigo-400 font-black uppercase tracking-[0.2em]">UX
                                    Designer</p>
                            </div>
                        </div>
                        <span
                            class="text-2xl opacity-20 group-hover:opacity-100 transition-opacity text-red-500 italic font-black">“</span>
                    </div>
                    <blockquote class="text-gray-400 leading-relaxed italic">
                        "Une visibilité immédiate auprès des recruteurs. L’interface est une masterclass de minimalisme.
                        Je recommande à 100%."
                    </blockquote>
                    <div class="mt-8 flex items-center justify-between">
                        <div class="flex text-red-500 text-[10px] tracking-widest leading-none">★★★★★</div>
                        <span class="text-[10px] text-zinc-600 font-bold uppercase">Membre Platinum</span>
                    </div>
                </div>

                <div
                    class="group bg-zinc-900/40 backdrop-blur-md border border-white/5 p-8 rounded-[2.5rem] hover:bg-zinc-800/60 transition-all duration-500 lg:translate-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <img src="https://ui-avatars.com/api/?name=Jean+Houndagnon&background=F59E0B&color=fff"
                            alt="Jean"
                            class="w-14 h-14 rounded-2xl rotate-6 group-hover:rotate-0 transition-transform">
                        <div>
                            <h4 class="font-bold text-white text-lg tracking-tight">Jean Houndagnon</h4>
                            <p class="text-[10px] text-amber-500 font-black uppercase tracking-[0.2em]">Student @ Tech
                            </p>
                        </div>
                    </div>
                    <blockquote class="text-gray-300 leading-relaxed">
                        "C’est devenu mon <span class="text-white border-b border-amber-500/50">CV numérique
                            ultime</span>. Indispensable pour tout étudiant qui veut sortir du lot."
                    </blockquote>
                    <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                            <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">En direct de
                                Cotonou</span>
                        </div>
                        <button class="text-white/20 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-24 px-6 bg-[#030303] text-white overflow-hidden">
        <div class="max-w-6xl mx-auto">

            <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h2 class="text-5xl font-black tracking-tighter">DES RÉPONSES,<br><span
                            class="text-purple-500">SANS DÉTOUR.</span></h2>
                    <p class="text-gray-500 mt-4 max-w-md">Cliquez sur une carte pour explorer les détails de notre
                        plateforme.</p>
                </div>
                <div class="hidden md:block">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-black"
                            src="https://ui-avatars.com/api/?name=Support+1&background=random" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-black"
                            src="https://ui-avatars.com/api/?name=Support+2&background=random" alt="">
                        <div
                            class="w-10 h-10 rounded-full border-2 border-black bg-zinc-800 flex items-center justify-center text-[10px] font-bold">
                            24/7</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div onclick="expandCard(this)"
                    class="md:col-span-2 group relative p-8 rounded-[2rem] bg-zinc-900/50 border border-white/5 cursor-pointer hover:border-purple-500/50 transition-all duration-500 overflow-hidden h-64">
                    <div class="relative z-10">
                        <span class="text-purple-500 font-mono text-sm">01.</span>
                        <h3 class="text-2xl font-bold mt-2">Comment créer un compte ?</h3>
                        <div
                            class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400 max-w-md">
                            Le processus est instantané. Cliquez sur « S’inscrire », validez votre email et votre
                            portfolio est prêt à être rempli. Pas de carte bancaire requise.
                        </div>
                    </div>
                    <div
                        class="absolute bottom-6 right-8 text-4xl group-hover:scale-110 transition-transform opacity-20">
                        👤</div>
                </div>

                <div onclick="expandCard(this)"
                    class="group relative p-8 rounded-[2rem] bg-zinc-900/50 border border-white/5 cursor-pointer hover:border-green-500/50 transition-all duration-500 h-64 md:h-auto md:row-span-2">
                    <div class="relative z-10">
                        <span class="text-green-500 font-mono text-sm">02.</span>
                        <h3 class="text-2xl font-bold mt-2 italic">Mefolio est-il gratuit ?</h3>
                        <div class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400">
                            Oui, 100% gratuit pour les fonctionnalités de base. Nous croyons en l'accessibilité du
                            talent. Des options premium viendront booster votre visibilité plus tard.
                        </div>
                    </div>
                    <div
                        class="absolute bottom-6 right-8 text-4xl opacity-20 group-hover:rotate-12 transition-transform">
                        💎</div>
                </div>

                <div onclick="expandCard(this)"
                    class="group relative p-8 rounded-[2rem] bg-zinc-900/50 border border-white/5 cursor-pointer hover:border-blue-500/50 transition-all duration-500 h-64">
                    <div class="relative z-10">
                        <span class="text-blue-500 font-mono text-sm">03.</span>
                        <h3 class="text-2xl font-bold mt-2">Publier un projet</h3>
                        <div class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400">
                            Section "Ajouter un projet", glissez vos images, liez votre GitHub ou Behance, et validez.
                            C'est en ligne.
                        </div>
                    </div>
                    <div
                        class="absolute bottom-6 right-8 text-4xl opacity-20 group-hover:-translate-y-2 transition-transform">
                        🚀</div>
                </div>

                <div onclick="expandCard(this)"
                    class="group relative p-8 rounded-[2rem] bg-zinc-900/50 border border-white/5 cursor-pointer hover:border-orange-500/50 transition-all duration-500 h-64">
                    <div class="relative z-10">
                        <span class="text-orange-500 font-mono text-sm">04.</span>
                        <h3 class="text-2xl font-bold mt-2">Partage recruteurs</h3>
                        <div class="content opacity-0 mt-6 translate-y-4 transition-all duration-500 text-gray-400">
                            Votre URL personnalisée (mefolio.com/votre-nom) est votre nouvelle carte de visite
                            numérique.
                        </div>
                    </div>
                    <div
                        class="absolute bottom-6 right-8 text-4xl opacity-20 group-hover:scale-110 transition-transform">
                        🔗</div>
                </div>

            </div>
        </div>
    </section>


    <script>
        function toggleFaq(btn) {
            const panel = btn.nextElementSibling;
            const symbol = btn.querySelector('span:last-child');
            panel.classList.toggle('hidden');
            symbol.textContent = panel.classList.contains('hidden') ? '+' : '-';
        }

        function expandCard(element) {
            // On retire l'état actif des autres cartes
            document.querySelectorAll('.card-active').forEach(card => {
                if (card !== element) card.classList.remove('card-active');
            });
            // On toggle la carte cliquée
            element.classList.toggle('card-active');
        }
    </script>

    @extends('layouts.footer')


</x-app-layout>

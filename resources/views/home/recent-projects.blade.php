{{--
    Section "Projets récents" — grille des derniers projets publiés.
    Variables attendues : $projects (Collection, injectée par HomeController).
--}}
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

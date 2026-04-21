<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-4">

            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Découvrez les meilleurs <span class="text-indigo-600">créatifs</span>
                </h1>
                <p class="text-gray-500 mt-2 text-base font-medium">
                    Explorez des milliers de projets inspirants réalisés par la communauté africaine.
                </p>
            </div>

            <div class="space-y-6 mb-16">

                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white mr-2">Populaire :</span>

                    <a href="#"
                        class="px-4 py-1.5 border border-gray-200 dark:border-gray-800 rounded-full text-xs font-bold text-gray-500 hover:border-indigo-600 hover:text-indigo-600 transition-all">Design
                        UI/UX</a>
                    <a href="#"
                        class="px-4 py-1.5 border border-gray-200 dark:border-gray-800 rounded-full text-xs font-bold text-gray-500 hover:border-indigo-600 hover:text-indigo-600 transition-all">Mobile
                        App</a>
                    <a href="#"
                        class="px-4 py-1.5 border border-gray-200 dark:border-gray-800 rounded-full text-xs font-bold text-gray-500 hover:border-indigo-600 hover:text-indigo-600 transition-all">Web
                        Design</a>
                    <a href="#"
                        class="px-4 py-1.5 border border-gray-200 dark:border-gray-800 rounded-full text-xs font-bold text-gray-500 hover:border-indigo-600 hover:text-indigo-600 transition-all">Branding</a>
                    <a href="#"
                        class="px-4 py-1.5 border border-gray-200 dark:border-gray-800 rounded-full text-xs font-bold text-gray-500 hover:border-indigo-600 hover:text-indigo-600 transition-all">Illustration</a>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-6 border-t border-gray-100 dark:border-gray-800">

                    <button
                        class="p-2.5 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </button>

                    <div class="group relative">
                        <button
                            class="flex items-center gap-2 px-4 py-2.5 border border-gray-200 dark:border-gray-800 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 hover:border-gray-300 transition-all">
                            Catégories
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="group relative">
                        <button
                            class="flex items-center gap-2 px-4 py-2.5 border border-gray-200 dark:border-gray-800 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 hover:border-gray-300 transition-all">
                            Localisation
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="ml-auto flex-1 max-w-xs hidden md:block">
                        <input type="text" placeholder="Rechercher un projet..."
                            class="w-full bg-gray-100 dark:bg-gray-900 border-none rounded-xl py-2.5 px-4 text-sm focus:ring-2 focus:ring-indigo-500 transition-all">
                    </div>

                </div>
            </div>

        </div>

        {{-- <form action="{{ route('projects.search') }}" method="GET"
            class="flex flex-wrap items-end gap-6 mb-16 pb-8 border-b border-gray-100 dark:border-gray-800">

            <div class="flex-1 min-w-[200px]">
                <label
                    class="block text-[10px] font-bold uppercase tracking-[0.25em] text-gray-400 mb-2">Domaine</label>
                <select name="category"
                    class="block w-full border-0 border-b border-gray-200 dark:border-gray-700 bg-transparent py-2 px-0 text-sm font-medium text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-0 transition-colors cursor-pointer">
                    <option value="">Tous les domaines</option>
                    <option value="design">Design & UI/UX</option>
                    <option value="developpement">Développement Web</option>
                    <option value="photographie">Photographie</option>
                    <option value="video">Vidéo & Animation</option>
                    <option value="marketing">Marketing Digital</option>
                </select>
            </div>

            <div class="flex-1 min-w-[200px]">
                <label
                    class="block text-[10px] font-bold uppercase tracking-[0.25em] text-gray-400 mb-2">Localisation</label>
                <input type="text" name="location" placeholder="Cotonou, Dakar, Abidjan..."
                    class="block w-full border-0 border-b border-gray-200 dark:border-gray-700 bg-transparent py-2 px-0 text-sm font-medium text-gray-900 dark:text-white placeholder:text-gray-300 dark:placeholder:text-gray-600 focus:border-indigo-500 focus:ring-0 transition-colors">
            </div>

            <button type="submit"
                class="px-8 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-bold rounded-full hover:bg-indigo-600 dark:hover:bg-indigo-100 transition-all">
                Filtrer
            </button>

            <a href="{{ route('projects.index') }}"
                class="text-sm text-gray-400 hover:text-gray-600 transition-colors font-medium">
                Réinitialiser
            </a>
        </form> --}}

        <div class="grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <article class="group flex flex-col">

                    <a href="{{ route('projects.show', $project->slug) }}"
                        class="relative block w-full overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800 mb-5"
                        style="aspect-ratio: 4/3;">
                        <img src="{{ $project->image
                            ? $project->creatif->photo
                            : 'https://ui-avatars.com/api/?name=' .
                                urlencode($project->creatif->prenom ?? 'M') .
                                '&background=6366f1&color=fff&size=64' }}"
                            class="h-8 w-8 rounded-full object-cover ring-2 ring-white dark:ring-gray-900">
                        <div
                            class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-500 rounded-2xl">
                        </div>
                    </a>

                    {{-- <div class="flex items-center gap-2 mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">
                            {{ $project->category ?? 'Créatif' }}
                        </span>
                        <span class="text-gray-200 dark:text-gray-700">·</span>
                        <time class="text-[11px] text-gray-400">
                            {{ $project->created_at->translatedFormat('d M Y') }}
                        </time>
                    </div> --}}

                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors leading-snug mb-3">
                        <a href="{{ route('projects.show', $project->slug) }}">
                            {{ $project->title }}
                        </a>
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed line-clamp-2 mb-5 flex-1">
                        {{ Str::limit($project->description, 110) }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ $project->creatif->photo
                                ? $project->creatif->photo
                                : 'https://ui-avatars.com/api/?name=' .
                                    urlencode($project->creatif->prenom ?? 'M') .
                                    '&background=6366f1&color=fff&size=64' }}"
                                class="h-8 w-8 rounded-full object-cover ring-2 ring-white dark:ring-gray-900">
                            <div>
                                <p class="text-xs font-bold text-gray-900 dark:text-white leading-none">
                                    <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                        class="hover:text-indigo-600 transition-colors">
                                        {{ $project->creatif->prenom }} {{ $project->creatif->nom }}
                                    </a>
                                </p>
                                <span class="text-[10px] text-gray-400 uppercase tracking-tight">Membre Mefolio</span>
                            </div>
                        </div>

                        <a href="{{ route('projects.show', $project->slug) }}"
                            class="w-8 h-8 rounded-full border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-400 group-hover:border-indigo-500 group-hover:text-indigo-500 group-hover:bg-indigo-50 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </article>

            @empty
                <div class="col-span-full py-32 flex flex-col items-center text-center">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 15.803a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Aucun projet trouvé</h3>
                    <p class="text-sm text-gray-400 max-w-sm">Aucun créatif n'a encore publié de projet correspondant à
                        vos critères.</p>
                    <a href="{{ route('projects.index') }}"
                        class="mt-8 px-6 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-sm font-bold rounded-full hover:bg-indigo-600 transition-all">
                        Voir tous les projets
                    </a>
                </div>
            @endforelse
        </div>

        @if ($projects->hasPages())
            <div class="mt-20 pt-10 border-t border-gray-100 dark:border-gray-800">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</x-app-layout>

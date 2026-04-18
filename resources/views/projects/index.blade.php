<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12">

        <div class="mb-12">
            <h1 class="text-4xl font-black tracking-tighter text-gray-900 dark:text-white sm:text-5xl">
                TOUS LES <span class="text-indigo-600 dark:text-indigo-400 italic">PROJETS.</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 font-light max-w-2xl">
                Explorez les pépites créatives de notre communauté et laissez-vous inspirer par les talents locaux.
            </p>
        </div>

        <div
            class="mb-16 bg-white dark:bg-gray-800/40 rounded-[2.5rem] p-8 border border-gray-100 dark:border-white/5 shadow-sm">
            <form action="{{ route('projects.search') }}" method="GET" class="flex flex-wrap items-end gap-8">

                <div class="flex-1 min-w-[240px]">
                    <label for="category"
                        class="block text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 mb-3">
                        Filtrer par domaine
                    </label>
                    <select name="category" id="category"
                        class="block w-full border-0 border-b-2 border-gray-200 dark:border-gray-700 bg-transparent py-3 px-0 focus:border-indigo-600 dark:focus:border-indigo-400 focus:ring-0 sm:text-sm transition-all cursor-pointer font-medium text-gray-900 dark:text-white">
                        <option value="" class="dark:bg-gray-900">Toutes les catégories</option>
                        <option value="design" class="dark:bg-gray-900">Design & UI/UX</option>
                        <option value="developpement" class="dark:bg-gray-900">Développement Web</option>
                        <option value="photographie" class="dark:bg-gray-900">Photographie</option>
                    </select>
                </div>

                <div class="flex-1 min-w-[240px]">
                    <label for="location"
                        class="block text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 mb-3">
                        Où cherchez-vous ?
                    </label>
                    <input type="text" name="location" id="location" placeholder="Ex: Cotonou, Parakou..."
                        class="block w-full border-0 border-b-2 border-gray-200 dark:border-gray-700 bg-transparent py-3 px-0 focus:border-indigo-600 dark:focus:border-indigo-400 focus:ring-0 sm:text-sm transition-all placeholder:text-gray-400 dark:placeholder:text-gray-600 font-medium text-gray-900 dark:text-white">
                </div>

                <button type="submit"
                    class="rounded-full bg-indigo-600 dark:bg-indigo-500 px-10 py-3.5 text-sm font-bold text-white shadow-xl shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 dark:hover:bg-indigo-400 transition transform hover:-translate-y-1 active:scale-95">
                    Appliquer
                </button>
            </form>
        </div>

        <div class="grid gap-x-10 gap-y-16 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <article class="flex flex-col items-start group">

                    <div
                        class="relative w-full aspect-[16/10] overflow-hidden rounded-[2rem] bg-gray-100 dark:bg-gray-800 mb-6 shadow-sm">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <a href="{{ route('projects.show', $project->slug) }}" class="absolute inset-0 z-20"
                            aria-label="Voir le projet"></a>
                    </div>

                    <div class="flex items-center gap-x-3 text-[10px] mb-4">
                        <span
                            class="px-2.5 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-widest border border-indigo-100 dark:border-indigo-500/20">
                            {{ $project->category ?? 'Créatif' }}
                        </span>
                        <span class="text-gray-300 dark:text-gray-700">•</span>
                        <time
                            class="text-gray-500 font-medium italic">{{ $project->created_at->translatedFormat('d M Y') }}</time>
                    </div>

                    <h3
                        class="text-2xl font-bold leading-tight text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        <a href="{{ route('projects.show', $project->slug) }}">
                            {{ $project->title }}
                        </a>
                    </h3>

                    <p
                        class="mt-4 line-clamp-2 text-sm leading-relaxed text-gray-600 dark:text-gray-400 font-light italic">
                        "{{ Str::limit($project->description, 130) }}"
                    </p>

                    <div
                        class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800 w-full flex items-center justify-between">
                        <div class="flex items-center gap-x-3">
                            <img src="{{ $project->creatif->photo ? asset('storage/' . $project->creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($project->creatif->prenom) . '&background=6366f1&color=fff' }}"
                                class="h-9 w-9 rounded-full object-cover ring-2 ring-white dark:ring-gray-900 shadow-sm">
                            <div class="text-sm">
                                <p class="font-bold text-gray-900 dark:text-white leading-none">
                                    <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                        class="hover:underline">
                                        {{ $project->creatif->prenom }} {{ $project->creatif->nom }}
                                    </a>
                                </p>
                                <span class="text-[10px] text-gray-400 uppercase tracking-tighter">Membre MeFolio</span>
                            </div>
                        </div>

                        <div
                            class="text-gray-300 group-hover:text-indigo-600 transition-transform group-hover:translate-x-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </article>

            @empty

                <div class="col-span-full py-24 flex flex-col items-center text-center">
                    <div class="text-6xl mb-6">🔍</div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Aucun projet trouvé</h3>
                    <p class="text-gray-500 mt-2 max-w-sm">Désolé, aucun créatif n'a encore publié de projet
                        correspondant à vos critères.</p>
                    <a href="{{ route('projects.index') }}"
                        class="mt-8 px-6 py-2 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white rounded-full text-sm font-bold hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                        Réinitialiser les filtres
                    </a>
                </div>
            @endforelse
        </div>

        @if ($projects->hasPages())
            <div class="mt-20 border-t border-gray-100 dark:border-gray-800 pt-10">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</x-app-layout>

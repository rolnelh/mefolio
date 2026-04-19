<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-16">

        <div class="mb-16 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-3">Mefolio · Communauté</p>
                <h1 class="text-5xl font-black tracking-tighter text-gray-900 dark:text-white sm:text-6xl leading-none">
                    Tous les<br>
                    <span class="text-indigo-600 italic font-black">projets.</span>
                </h1>
            </div>
            <p class="text-sm text-gray-400 max-w-xs leading-relaxed">
                Explorez les pépites créatives de notre communauté et laissez-vous inspirer par les talents africains.
            </p>
        </div>

        <form action="{{ route('projects.search') }}" method="GET"
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
        </form>

        <div class="grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <article class="group flex flex-col">

                    <a href="{{ route('projects.show', $project->slug) }}"
                        class="relative block w-full overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800 mb-5"
                        style="aspect-ratio: 4/3;">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <div
                            class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-500 rounded-2xl">
                        </div>
                    </a>

                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">
                            {{ $project->category ?? 'Créatif' }}
                        </span>
                        <span class="text-gray-200 dark:text-gray-700">·</span>
                        <time class="text-[11px] text-gray-400">
                            {{ $project->created_at->translatedFormat('d M Y') }}
                        </time>
                    </div>

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
                                ? asset('storage/' . $project->creatif->photo)
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

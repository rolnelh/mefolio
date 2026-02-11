<x-app-layout>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12">

        <div class="mb-12">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                Tous les Projets
            </h1>
            <p class="mt-3 text-lg text-gray-600 dark:text-gray-400 font-light">
                Découvrez les pépites créatives de notre communauté.
            </p>
        </div>

        <div class="mb-16 bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-6">
            <form action="{{ route('projects.search') }}" method="GET" class="flex flex-wrap items-end gap-6">

                <div class="flex-1 min-w-[200px]">
                    <label for="category"
                        class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">
                        Catégorie
                    </label>
                    <select name="category" id="category"
                        class="block w-full border-0 border-b-2 border-gray-200 dark:border-gray-700 bg-transparent py-2 px-0 focus:border-gray-900 dark:focus:border-white focus:ring-0 sm:text-sm transition-colors">
                        <option value="">Toutes les catégories</option>
                        <option value="design">Design</option>
                        <option value="developpement">Développement</option>
                        <option value="photographie">Photographie</option>
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="location"
                        class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">
                        Localisation
                    </label>
                    <input type="text" name="location" id="location" placeholder="Ex: Cotonou"
                        class="block w-full border-0 border-b-2 border-gray-200 dark:border-gray-700 bg-transparent py-2 px-0 focus:border-gray-900 dark:focus:border-white focus:ring-0 sm:text-sm transition-colors">
                </div>

                <button type="submit"
                    class="rounded-full bg-gray-900 dark:bg-white px-8 py-2.5 text-sm font-semibold text-white dark:text-gray-900 shadow-sm hover:opacity-80 transition">
                    Filtrer
                </button>
            </form>
        </div>

        <div class="grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <article class="flex flex-col items-start group">
                    <div class="relative w-full overflow-hidden rounded-2xl bg-gray-100 mb-5">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                            class="aspect-[16/9] w-full object-cover transition duration-300 group-hover:scale-105">
                        <a href="{{ route('projects.show', $project->slug) }}" class="absolute inset-0"></a>
                    </div>

                    <div class="flex items-center gap-x-3 text-xs mb-3">
                        <span class="font-medium text-gray-500 uppercase tracking-widest">
                            {{ $project->category ?? 'Créatif' }}
                        </span>
                        <span class="text-gray-300">•</span>
                        <time class="text-gray-400">{{ $project->created_at->translatedFormat('d M Y') }}</time>
                    </div>

                    <h3 class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">
                        <a href="{{ route('projects.show', $project->slug) }}" class="hover:text-gray-600 transition">
                            {{ $project->title }}
                        </a>
                    </h3>

                    <p class="mt-3 line-clamp-2 text-sm leading-6 text-gray-600 dark:text-gray-400 font-light">
                        {{ Str::limit($project->description, 120) }}
                    </p>

                    <div class="mt-6 flex items-center gap-x-3">
                        <img src="{{ $project->creatif->photo ? asset('storage/' . $project->creatif->photo) : 'https://ui-avatars.com/api/?name=' . $project->creatif->prenom }}"
                            class="h-8 w-8 rounded-full bg-gray-50">
                        <div class="text-sm">
                            <p class="font-medium text-gray-900 dark:text-white">
                                <a href="{{ route('creatifs.show', $project->creatif->slug) }}"
                                    class="hover:underline">
                                    {{ $project->creatif->prenom }} {{ $project->creatif->nom }}
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-16 border-t border-gray-100 dark:border-gray-800 pt-10">
            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>

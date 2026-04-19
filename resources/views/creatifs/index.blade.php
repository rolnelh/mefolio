<x-app-layout>
    <section class="bg-white py-12 lg:py-18 text-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold tracking-tight sm:text-6xl text-center md:text-left">
                Découvrez nos talents créatifs
            </h2>
            <p class="mt-6 text-xl leading-8 text-gray-600 max-w-3xl">
                Explorez les profils inspirants de designers, développeurs et illustrateurs.
                Chaque créatif a une histoire unique à raconter.
            </p>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-6 max-w-7xl mx-auto">
        @forelse ($creatifs as $creatif)
            <div
                class="bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl rounded-2xl overflow-hidden text-center transition-all duration-300 transform hover:-translate-y-2 flex flex-col">

                <div class="h-32 bg-cover bg-center transition-opacity duration-500"
                    style="background-image: url('{{ $creatif->couverture ? asset('storage/' . $creatif->couverture) : 'https://images.unsplash.com/photo-1557683316-973673baf926?q=80&w=1000&auto=format&fit=crop' }}');">

                    <div class="w-full h-full bg-black/10"></div>
                </div>

                <div class="-mt-12 flex justify-center">
                    <img class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow-lg"
                        src="{{ $creatif->photo ? asset('storage/' . $creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($creatif->nom) }}"
                        alt="{{ $creatif->nom }}">
                </div>

                <div class="p-6 flex-grow">
                    <a href="{{ route('creatifs.show', $creatif->slug) }}" class="group">
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-red-600 transition-colors">
                            {{ $creatif->prenom }} {{ $creatif->nom }}
                        </h3>
                    </a>
                    <p class="text-sm font-medium text-red-600 dark:text-red-400 uppercase tracking-wider mt-1">
                        {{ $creatif->specialite }}
                    </p>
                    <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        {{ Str::limit($creatif->bio, 100) }}
                    </p>
                </div>

                <div class="flex justify-center gap-6 p-4 bg-gray-50 dark:bg-gray-700/50">

                    @if ($creatif->linkedin)
                        <a href="{{ $creatif->linkedin }}" class="text-gray-400 hover:text-blue-600 transition-colors">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"></svg>
                        </a>
                    @endif

                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Aucun créatif trouvé pour le moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10 mx-auto p-6 max-w-7xl">
        {{ $creatifs->links() }}
    </div>
</x-app-layout>

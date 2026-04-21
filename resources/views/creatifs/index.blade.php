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
            <div class="group relative pt-12">
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

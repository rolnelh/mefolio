<x-app-layout>
    <div class="bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 flex flex-col lg:flex-row gap-10">

            {{-- 👤 SIDEBAR : PROFIL --}}
            <aside class="w-full lg:w-1/3 xl:w-1/4">
                <div
                    class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 lg:sticky lg:top-24">

                    <div class="flex flex-col items-center text-center">
                        {{-- Photo de profil avec anneau décoratif --}}
                        <div class="relative p-1 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 mb-6">
                            <img src="{{ $creatif->photo ? asset('storage/' . $creatif->photo) : 'https://images.pexels.com/photos/32071839/pexels-photo-32071839.jpeg' }}"
                                alt="Profil"
                                class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-sm">
                        </div>

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">
                            {{ $creatif->prenom }} {{ $creatif->nom }}
                        </h2>

                        @if ($creatif->specialite)
                            <span
                                class="inline-block mt-2 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-bold uppercase tracking-widest rounded-full">
                                {{ $creatif->specialite }}
                            </span>
                        @endif

                        <div class="mt-6 w-full space-y-3 text-sm">
                            @if ($creatif->localisation)
                                <div class="flex items-center justify-center text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $creatif->localisation }}
                                </div>
                            @endif
                            <div class="flex items-center justify-center text-gray-400 text-xs italic">
                                Membre depuis {{ $creatif->user->created_at->translatedFormat('F Y') }}
                            </div>
                        </div>

                        {{-- Biographie --}}
                        @if ($creatif->bio)
                            <div class="mt-8 pt-6 border-t border-gray-50 dark:border-gray-700 w-full">
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed text-start">
                                    {{ $creatif->bio }}
                                </p>
                            </div>
                        @endif

                        {{-- Actions --}}
                        <div class="mt-8 w-full space-y-3">
                            <a href="mailto:{{ $creatif->user->email }}"
                                class="flex items-center justify-center w-full px-6 py-3 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold rounded-2xl hover:bg-indigo-600 dark:hover:bg-indigo-500 dark:hover:text-white transition-all shadow-lg shadow-gray-200 dark:shadow-none">
                                Contacter
                            </a>

                            @if ($creatif->portfolio_url)
                                <a href="{{ $creatif->portfolio_url }}" target="_blank"
                                    class="flex items-center justify-center w-full px-6 py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 font-bold rounded-2xl hover:bg-gray-50 transition">
                                    Portfolio externe
                                </a>
                            @endif
                        </div>

                        {{-- Réseaux Sociaux --}}
                        <div class="flex justify-center gap-4 mt-8">
                            @foreach (['facebook' => 'fa-facebook', 'instagram' => 'fa-instagram', 'linkedin' => 'fa-linkedin', 'github' => 'fa-github'] as $key => $icon)
                                @if ($creatif->$key)
                                    <a href="{{ $creatif->$key }}" target="_blank"
                                        class="p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                                        <i class="fab {{ $icon }} text-xl"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>

            {{-- 🎨 SECTION DROITE : PROJETS --}}
            <main class="flex-1">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white">
                        Projets <span class="text-indigo-600">.</span>
                    </h2>
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">{{ $projects->count() }}
                        Réalisations</span>
                </div>

                @if ($projects->isEmpty())
                    <div
                        class="text-center py-20 bg-white dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <div
                            class="w-20 h-20 mx-auto mb-4 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center text-gray-300">
                            <i class="fas fa-layer-group text-3xl"></i>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Le portfolio est encore en cours de
                            construction.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ($projects as $project)
                            <article
                                class="group relative bg-white dark:bg-gray-800 rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300">
                                {{-- Image avec Overlay au Hover --}}
                                <div class="relative aspect-[4/3] overflow-hidden">
                                    <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/600x400' }}"
                                        alt="{{ $project->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                        <a href="{{ route('projects.show', $project->id) }}"
                                            class="px-5 py-2 bg-white text-gray-900 rounded-full text-sm font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>

                                {{-- Infos --}}
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded">
                                            {{ $project->category ?? 'Design' }}
                                        </span>
                                        <time class="text-[10px] font-bold text-gray-400 uppercase">
                                            {{ $project->created_at->translatedFormat('M Y') }}
                                        </time>
                                    </div>
                                    <h3
                                        class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                                        <a href="{{ route('projects.show', $project->id) }}">
                                            {{ $project->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">
                                        {{ $project->description }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
    </div>
</x-app-layout>

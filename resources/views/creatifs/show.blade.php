<x-app-layout>
    @php
        $totalVues = 0;
        $totalLikes = 0;
    @endphp

    {{-- COVER --}}
    <div class="relative w-full h-52 sm:h-64 overflow-hidden bg-gray-900">
        <img src="{{ $creatif->couverture ?: 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?q=80&w=1200&auto=format&fit=crop' }}"
            alt="Couverture" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6 items-start">

            {{-- ═══ SIDEBAR ═══ --}}
            <aside class="w-full lg:w-72 flex-shrink-0 space-y-4 lg:sticky lg:top-24">

                {{-- Profil card --}}
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="px-6 pt-6 pb-4 text-center border-b border-gray-50">
                        <div class="relative inline-block mb-3">
                            <img src="{{ $creatif->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($creatif->prenom ?? 'M') . '&background=6366f1&color=fff&size=200' }}"
                                alt="{{ $creatif->prenom }}"
                                class="w-24 h-24 rounded-2xl object-cover ring-4 ring-indigo-50 shadow-md mx-auto">
                            <div
                                class="absolute -bottom-1.5 -right-1.5 bg-green-500 w-4 h-4 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <h1 class="text-lg font-black text-gray-900">{{ $creatif->prenom }} {{ $creatif->nom }}</h1>
                        @if ($creatif->specialite)
                            <p class="text-xs text-indigo-600 font-bold mt-0.5">{{ $creatif->specialite }}</p>
                        @endif
                        @if ($creatif->localisation)
                            <p class="text-xs text-gray-400 mt-1.5 flex items-center justify-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $creatif->localisation }}
                            </p>
                        @endif
                    </div>

                    {{-- Bio --}}
                    @if ($creatif->bio)
                        <div class="px-6 py-4 border-b border-gray-50">
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $creatif->bio }}</p>
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 divide-x divide-gray-50 border-b border-gray-50">
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ count($projects) }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Projets</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ $totalVues }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Vues</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ $totalLikes }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Likes</p>
                        </div>
                    </div>

                    {{-- Liens sociaux --}}
                    <div class="px-6 py-4 border-b border-gray-50">
                        <div class="flex justify-center gap-2">
                            @if ($creatif->portfolio_url)
                                <a href="{{ $creatif->portfolio_url }}" target="_blank"
                                    class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                    title="Portfolio">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </a>
                            @endif
                            <a href="#"
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                title="LinkedIn">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="p-2 text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all"
                                title="GitHub">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="px-6 py-4 space-y-2">
                        @auth
                            @if (Auth::user()->creatif?->id !== $creatif->id)
                                <a href="#contact"
                                    class="flex items-center justify-center gap-2 w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    Contacter
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}"
                                class="flex items-center justify-center gap-2 w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all">
                                Contacter ce créatif
                            </a>
                        @endauth

                        @if ($creatif->portfolio_url)
                            <a href="{{ $creatif->portfolio_url }}" target="_blank"
                                class="flex items-center justify-center gap-2 w-full py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 text-xs font-semibold rounded-xl transition-all border border-gray-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Voir le portfolio
                            </a>
                        @endif
                    </div>

                    {{-- Membre depuis --}}
                    <div class="px-6 pb-4">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-gray-300 text-center">
                            Membre depuis {{ $creatif->created_at->translatedFormat('F Y') }}
                        </p>
                    </div>
                </div>

                {{-- Badge Mefolio --}}
                <div
                    class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-4 text-center">
                    <p class="text-xs text-indigo-600 font-bold mb-1">✅ Profil vérifié Mefolio</p>
                    <p class="text-[11px] text-gray-400">Ce créatif est membre actif de la communauté africaine Mefolio.
                    </p>
                </div>

            </aside>

            {{-- ═══ CONTENU PRINCIPAL ═══ --}}
            <main class="flex-1 min-w-0 space-y-8">

                {{-- Header --}}
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">Portfolio de {{ $creatif->prenom }}</h2>
                        <p class="text-sm text-gray-400 mt-1">{{ count($projects) }}
                            projet{{ count($projects) > 1 ? 's' : '' }} publié{{ count($projects) > 1 ? 's' : '' }}
                        </p>
                    </div>
                    @auth
                        @if (Auth::user()->creatif?->id === $creatif->id)
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all">
                                ✏️ Modifier mon profil
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Projets --}}
                @if (count($projects) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                        @foreach ($projects as $project)
                            <a href="{{ route('projects.show', $project->slug) }}"
                                class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                                <div class="relative overflow-hidden" style="height: 180px;">
                                    <img src="{{ $project->image ?: 'https://via.placeholder.com/400x300' }}"
                                        alt="{{ $project->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <div
                                        class="absolute bottom-3 left-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span
                                            class="inline-flex items-center gap-1 bg-white/90 text-gray-800 text-xs font-bold px-2.5 py-1 rounded-full">
                                            Voir le projet →
                                        </span>
                                    </div>
                                    @if ($project->category)
                                        <div class="absolute top-2 left-2">
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-widest text-indigo-500 bg-white/90 px-2 py-1 rounded-lg">
                                                {{ $project->category }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 truncate text-sm mb-1">{{ $project->title }}
                                    </h3>
                                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                        {{ $project->description }}</p>
                                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50">
                                        <span
                                            class="text-[11px] text-gray-400">{{ $project->created_at->diffForHumans() }}</span>
                                        <div class="flex items-center gap-3 text-xs text-gray-400">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                0
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                0
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <div class="text-4xl mb-4">🎨</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Aucun projet pour le moment</h3>
                        <p class="text-sm text-gray-400 text-center max-w-xs">Ce créatif n'a pas encore publié de
                            projet.</p>
                    </div>
                @endif

                {{-- Contact --}}
                <div id="contact"
                    class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-8 text-white text-center">
                    <div class="text-3xl mb-3">💬</div>
                    <h3 class="text-xl font-black mb-2">Vous voulez travailler avec {{ $creatif->prenom }} ?</h3>
                    <p class="text-indigo-200 text-sm mb-6">Contactez ce créatif directement via Mefolio.</p>
                    @auth
                        <button
                            class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
                            Envoyer un message →
                        </button>
                    @else
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
                            S'inscrire pour contacter →
                        </a>
                    @endauth
                </div>

            </main>
        </div>
    </div>
</x-app-layout>

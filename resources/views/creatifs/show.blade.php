<x-app-layout>
    @php
        $hasFlash = session('success') || session('error') || $errors->any();
    @endphp

    {{-- COVER : remonte derrière la nav flottante transparente --}}
    <div class="relative z-0 w-full h-52 sm:h-64 overflow-hidden bg-gray-900 {{ $hasFlash ? '' : '-mt-[76px] sm:-mt-[80px]' }}">
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
                                class="absolute -bottom-1.5 -right-1.5 w-4 h-4 rounded-full border-2 border-white {{ $creatif->available_for_work ? 'bg-green-500' : 'bg-gray-300' }}"
                                title="{{ $creatif->available_for_work ? 'Disponible pour de nouvelles missions' : 'Actuellement indisponible' }}">
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

                        <div class="flex items-center justify-center gap-1.5 mt-3">
                            <span
                                class="text-[10px] font-bold uppercase tracking-wide bg-indigo-50 text-indigo-600 px-2 py-1 rounded-full">
                                {{ $level['label'] }}
                            </span>
                            <span
                                class="text-[10px] font-bold uppercase tracking-wide bg-amber-50 text-amber-600 px-2 py-1 rounded-full">
                                Top {{ $topPct }}%
                            </span>
                        </div>
                        <p class="text-[11px] mt-2 font-semibold {{ $creatif->available_for_work ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $creatif->available_for_work ? 'Disponible pour de nouvelles missions' : 'Actuellement indisponible' }}
                        </p>
                    </div>

                    {{-- Bio --}}
                    @if ($creatif->bio)
                        <div class="px-6 py-4 border-b border-gray-50">
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $creatif->bio }}</p>
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div class="grid grid-cols-4 divide-x divide-gray-50 border-b border-gray-50">
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ count($projects) }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Projets</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ number_format($creatif->builder_score) }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Score</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ $totalLikes }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Likes</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900">{{ number_format($creatif->profile_views) }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Vues</p>
                        </div>
                    </div>

                    {{-- Liens sociaux --}}
                    <div class="px-6 py-4 border-b border-gray-50" x-data="{ copied: false }">
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
                            <button type="button"
                                @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                title="Partager le profil">
                                <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                <svg x-show="copied" x-cloak class="w-4 h-4 text-green-600" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="px-6 py-4 space-y-2">
                        @auth
                            @if (Auth::user()->creatif?->id !== $creatif->id && $creatif->user)
                                <a href="{{ route('messages.show', $creatif->user) }}"
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

                {{-- Services --}}
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50">
                        <h3 class="text-xs font-black text-gray-900 uppercase tracking-wide">Services</h3>
                        <span
                            class="text-[10px] font-bold uppercase bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full">Bientôt</span>
                    </div>
                    <div class="px-6 py-5 text-center">
                        <p class="text-xs text-gray-400 leading-relaxed mb-3">
                            {{ $creatif->prenom }} pourra bientôt proposer des services à la commande directement sur
                            Mefolio.
                        </p>
                        <a href="{{ route('services.index') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-700">
                            En savoir plus
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Badge Mefolio --}}
                <div
                    class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-4 text-center">
                    <p class="text-xs text-indigo-600 font-bold mb-1">Profil vérifié Mefolio</p>
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
                                Modifier mon profil
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
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Aucun projet pour le moment</h3>
                        <p class="text-sm text-gray-400 text-center max-w-xs">Ce créatif n'a pas encore publié de
                            projet.</p>
                    </div>
                @endif

                {{-- Contact --}}
                <div id="contact"
                    class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-8 text-white text-center">
                    <h3 class="text-xl font-black mb-2">Vous voulez travailler avec {{ $creatif->prenom }} ?</h3>
                    <p class="text-indigo-200 text-sm mb-6">Contactez ce créatif directement via Mefolio.</p>
                    @auth
                        @if ($creatif->user && $creatif->user->id !== Auth::id())
                            <a href="{{ route('messages.show', $creatif->user) }}"
                                class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Envoyer un message →
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            S'inscrire pour contacter →
                        </a>
                    @endauth
                </div>

            </main>
        </div>
    </div>
</x-app-layout>

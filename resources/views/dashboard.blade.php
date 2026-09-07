<style>
    .hide-scrollbar {
        scrollbar-width: none;
    }

    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<x-app-layout>
    @php
        $creatif = Auth::user()->creatif;
        $couverturePath =
            $creatif && $creatif->couverture
                ? $creatif->couverture
                : 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?q=80&w=1200&auto=format&fit=crop';

        $profilComplet =
            $creatif &&
            $creatif->nom &&
            $creatif->prenom &&
            $creatif->specialite &&
            $creatif->localisation &&
            $creatif->bio &&
            $creatif->portfolio_url &&
            $creatif->photo;

        $aDesProjets = !empty($projects) && count($projects) > 0;

        $etapes = [
            'profil' => (bool) $profilComplet,
            'projet' => (bool) $aDesProjets,
        ];
        $progression = collect($etapes)->filter()->count();
        $total = count($etapes);
        $pourcentage = ($progression / $total) * 100;

        $activeTab = request()->get('tab', 'projets');
    @endphp


    <div class="relative w-full h-48 sm:h-56 overflow-hidden bg-gray-200">
        <img src="{{ $couverturePath }}" alt="Couverture" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        <div class="absolute bottom-3 right-3">
            <a href="{{ route('creatifs.edit') }}"
                class="inline-flex items-center gap-1.5 bg-white/90 hover:bg-white text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-md transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $creatif && $creatif->couverture ? 'Changer' : 'Ajouter couverture' }}
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <aside class="w-full lg:w-72 flex-shrink-0 space-y-4 lg:sticky lg:top-24">

                <div
                    class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
                    {{-- Avatar --}}
                    <div class="px-6 pt-6 pb-4 text-center border-b border-gray-50 dark:border-gray-800">
                        <div class="relative inline-block mb-3">
                            <img src="{{ $creatif?->photo ?: asset('images/avatar.webp') }}" alt="Profil"
                                class="w-20 h-20 rounded-2xl object-cover ring-4 ring-indigo-50 dark:ring-indigo-900/20 shadow-md mx-auto">
                            <div
                                class="absolute -bottom-1.5 -right-1.5 bg-green-500 w-4 h-4 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <h2 class="text-base font-bold text-gray-900 dark:text-white">
                            {{ $creatif ? $creatif->prenom . ' ' . $creatif->nom : Auth::user()->username }}
                        </h2>
                        @if ($creatif?->specialite)
                            <p class="text-xs text-indigo-600 font-semibold mt-0.5">{{ $creatif->specialite }}</p>
                        @endif
                        @if ($creatif?->localisation)
                            <p class="text-xs text-gray-400 mt-1 flex items-center justify-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $creatif->localisation }}
                            </p>
                        @endif
                    </div>

                    {{-- Bio --}}
                    @if ($creatif?->bio)
                        <div class="px-6 py-4 border-b border-gray-50 dark:border-gray-800">
                            <p class="text-xs text-gray-500 leading-relaxed line-clamp-4">{{ $creatif->bio }}</p>
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div
                        class="grid grid-cols-3 divide-x divide-gray-50 dark:divide-gray-800 border-b border-gray-50 dark:border-gray-800">
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900 dark:text-white">{{ count($projects) }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Projets</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900 dark:text-white">{{ number_format($creatif->builder_score ?? 0) }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Score</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900 dark:text-white">{{ $totalLikes }}</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Likes</p>
                        </div>
                    </div>

                    {{-- Liens sociaux --}}
                    <div class="px-6 py-4 border-b border-gray-50 dark:border-gray-800">
                        <div class="flex justify-center gap-3">
                            @if ($creatif?->portfolio_url)
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
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="px-6 py-4 space-y-2">
                        <a href="{{ route('creatifs.edit') }}"
                            class="flex items-center justify-center gap-2 w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Modifier mon profil
                        </a>
                        @if ($creatif?->slug)
                            <a href="{{ route('creatifs.show', $creatif->slug) }}" target="_blank"
                                class="flex items-center justify-center gap-2 w-full py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 text-xs font-semibold rounded-xl transition-all border border-gray-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Voir mon profil public
                            </a>
                        @endif
                    </div>

                    {{-- Membre depuis --}}
                    <div class="px-6 pb-4">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-gray-300 text-center">
                            Membre depuis {{ Auth::user()->created_at->translatedFormat('F Y') }}
                        </p>
                    </div>
                </div>

                <x-dashboard-sidebar :active="$activeTab" />

            </aside>


            <main class="flex-1 min-w-0 space-y-6">

                {{-- Onboarding --}}
                @if ($pourcentage < 100)
                    <div class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Configurez votre espace créatif</h3>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $progression }}/{{ $total }}
                                    étapes complétées</p>
                            </div>
                            <span class="text-xl font-extrabold text-indigo-600">{{ (int) $pourcentage }}%</span>
                        </div>
                        <div class="w-full bg-white rounded-full h-1.5 mb-4 overflow-hidden">
                            <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500"
                                style="width: {{ $pourcentage }}%"></div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="{{ route('creatifs.create') }}"
                                class="flex items-center gap-3 p-3 bg-white rounded-xl border {{ $etapes['profil'] ? 'border-green-200' : 'border-indigo-200 hover:border-indigo-400' }} transition-all">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $etapes['profil'] ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                                    @if ($etapes['profil'])
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-xs font-semibold {{ $etapes['profil'] ? 'text-green-700' : 'text-gray-900' }}">
                                        {{ $etapes['profil'] ? ' Profil complété' : 'Compléter mon profil' }}
                                    </p>
                                    <p class="text-[11px] text-gray-400">Photo, bio, spécialité, localisation</p>
                                </div>
                            </a>
                            <a href="{{ $etapes['profil'] ? route('projets.create') : '#' }}"
                                class="flex items-center gap-3 p-3 bg-white rounded-xl border {{ $etapes['projet'] ? 'border-green-200' : 'border-indigo-200' }} transition-all {{ !$etapes['profil'] ? 'opacity-50 cursor-not-allowed' : 'hover:border-indigo-400' }}">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ $etapes['projet'] ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                                    @if ($etapes['projet'])
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-xs font-semibold {{ $etapes['projet'] ? 'text-green-700' : 'text-gray-900' }}">
                                        {{ $etapes['projet'] ? ' Premier projet ajouté' : 'Ajouter mon premier projet' }}
                                    </p>
                                    <p class="text-[11px] text-gray-400">
                                        {{ !$etapes['profil'] ? 'Complétez d\'abord votre profil' : 'Partagez votre première réalisation' }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- ─── ONGLET : PROJETS ─── --}}
                @if ($activeTab === 'projets')
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-lg font-black text-gray-900 dark:text-white">Mes projets</h2>
                                <p class="text-xs text-gray-400 mt-0.5">{{ count($projects) }}
                                    projet{{ count($projects) > 1 ? 's' : '' }} dans votre portfolio</p>
                            </div>
                            @if ($profilComplet)
                                <a href="{{ route('projets.create') }}"
                                    class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Nouveau projet
                                </a>
                            @endif
                        </div>

                        @if ($aDesProjets)
                            <div class="grid grid-cols-[repeat(auto-fit,minmax(260px,1fr))] gap-5 mt-8">

                                @foreach ($projects as $project)
                                    <div
                                        class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-all duration-300">
                                        <div class="relative overflow-hidden" style="height: 170px;">
                                            <img src="{{ $project->image ?: 'https://via.placeholder.com/400x300' }}"
                                                alt="{{ $project->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            </div>
                                            <div
                                                class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('projets.edit', $project->id) }}"
                                                    class="p-1.5 bg-white/90 text-gray-700 hover:text-indigo-600 rounded-lg transition-all shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.414-9.414z" />
                                                    </svg>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('projets.destroy', $project->id) }}"
                                                    onsubmit="return confirm('Supprimer ce projet ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-1.5 bg-white/90 text-gray-700 hover:text-red-500 rounded-lg transition-all shadow-sm">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-gray-900 dark:text-white truncate text-sm mb-1">
                                                {{ $project->title }}</h3>
                                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                                                {{ $project->description }}</p>
                                            <div
                                                class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50 dark:border-gray-700">
                                                <a href="{{ route('projects.show', $project->slug) }}"
                                                    class="text-indigo-600 text-xs font-semibold hover:text-indigo-700 transition-colors">
                                                    Voir le projet →
                                                </a>
                                                <span
                                                    class="text-[11px] text-gray-400">{{ $project->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Add project card --}}
                                <a href="{{ $profilComplet ? route('projets.create') : route('creatifs.edit') }}"
                                    class="group flex flex-col items-center justify-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl hover:border-indigo-400 hover:bg-indigo-50/30 transition-all duration-300"
                                    style="min-height: 250px;">
                                    <div
                                        class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center group-hover:scale-110 group-hover:bg-indigo-100 transition-all">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <span
                                        class="mt-3 text-sm font-semibold text-gray-500 group-hover:text-indigo-600 transition-colors">Nouveau
                                        projet</span>
                                </a>

                            </div>
                        @else
                            <div
                                class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Aucun projet pour le moment</h3>
                                <p class="text-sm text-gray-400 text-center max-w-xs mb-6">Ajoutez votre première
                                    réalisation pour impressionner vos visiteurs.</p>
                                @if ($profilComplet)
                                    <a href="{{ route('projets.create') }}"
                                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full transition-all">
                                        + Créer mon premier projet
                                    </a>
                                @else
                                    <a href="{{ route('creatifs.edit') }}"
                                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-full transition-all">
                                        Compléter mon profil d'abord
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                {{-- ─── ONGLET : PRODUCTIVITÉ ─── --}}
                @if ($activeTab === 'productivite')
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-lg font-black text-gray-900">Productivité</h2>
                                <p class="text-xs text-gray-400 mt-0.5">Votre activité détermine votre Builder Score
                                    — et votre place dans le classement.</p>
                            </div>
                            <a href="{{ route('classement.index') }}"
                                class="text-xs font-semibold text-indigo-600 hover:underline whitespace-nowrap">
                                Voir le classement →
                            </a>
                        </div>

                        @if ($creatif)
                            @php
                                $level = $scorer->getLevel($creatif);
                                $nextLevel = $scorer->getNextLevel($creatif);
                                $progress = $scorer->getProgress($creatif);
                                $topPct = $scorer->getTopPercentage($creatif);
                                $circumference = 2 * M_PI * 54;
                                $offset = $circumference - ($progress / 100) * $circumference;
                            @endphp

                            <div class="grid grid-cols-1 lg:grid-cols-[220px_1fr] gap-5 mb-5">
                                {{-- Anneau de progression --}}
                                <div class="bg-white border border-gray-100 rounded-2xl p-6 flex flex-col items-center justify-center text-center">
                                    <div class="relative w-32 h-32">
                                        <svg class="w-32 h-32 -rotate-90" viewBox="0 0 120 120">
                                            <circle cx="60" cy="60" r="54" fill="none" stroke="#EEF0FF" stroke-width="10" />
                                            <circle cx="60" cy="60" r="54" fill="none" stroke="url(#productivite-grad)"
                                                stroke-width="10" stroke-linecap="round"
                                                stroke-dasharray="{{ $circumference }}"
                                                stroke-dashoffset="{{ $offset }}" />
                                            <defs>
                                                <linearGradient id="productivite-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" stop-color="#6366f1" />
                                                    <stop offset="100%" stop-color="#8b5cf6" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                                            <span class="text-2xl font-black text-gray-900">{{ $progress }}%</span>
                                            <span class="text-[9px] text-gray-400 uppercase tracking-wider text-center leading-tight">niveau<br>suivant</span>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-sm font-bold text-indigo-600">{{ $level['label'] }}</p>
                                    @if ($nextLevel)
                                        <p class="text-[11px] text-gray-400 mt-0.5">
                                            {{ number_format(max(0, $nextLevel['min'] - ($creatif->builder_score ?? 0))) }}
                                            pts avant « {{ $nextLevel['label'] }} »
                                        </p>
                                    @else
                                        <p class="text-[11px] text-gray-400 mt-0.5">Niveau maximum atteint</p>
                                    @endif
                                </div>

                                {{-- Stats --}}
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ([
                                        ['label' => 'Builder Score', 'val' => number_format($creatif->builder_score ?? 0)],
                                        ['label' => 'Position sur Mefolio', 'val' => 'Top ' . $topPct . '%'],
                                        ['label' => 'Projets publiés', 'val' => count($projects)],
                                        ['label' => 'Interactions reçues', 'val' => $totalLikes + $totalComments],
                                    ] as $stat)
                                        <div class="bg-white border border-gray-100 rounded-2xl p-5">
                                            <div class="text-2xl font-black text-gray-900">{{ $stat['val'] }}</div>
                                            <div class="text-xs text-gray-400 mt-1">{{ $stat['label'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Comment gagner des points --}}
                            <div class="bg-white border border-gray-100 rounded-2xl p-6">
                                <h3 class="font-bold text-gray-900 mb-1">Comment faire progresser votre score</h3>
                                <p class="text-xs text-gray-400 mb-4">Chaque action sur Mefolio vous rapporte des
                                    points, qui déterminent votre niveau et votre rang dans le classement.</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach ([
                                        ['label' => 'Compléter son profil', 'pts' => 30],
                                        ['label' => 'Publier un nouveau projet', 'pts' => 20],
                                        ['label' => 'Terminer une mission', 'pts' => 50],
                                        ['label' => 'Mettre à jour un projet', 'pts' => 5],
                                        ['label' => 'Recevoir un commentaire', 'pts' => 3],
                                        ['label' => 'Recevoir un like', 'pts' => 1],
                                    ] as $action)
                                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-xl">
                                            <span class="text-sm text-gray-700">{{ $action['label'] }}</span>
                                            <span class="text-xs font-black text-indigo-600">+{{ $action['pts'] }} pts</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Créez d'abord votre profil créatif</h3>
                                <p class="text-sm text-gray-400 text-center max-w-xs mb-6">Votre productivité et
                                    votre Builder Score se calculent à partir de votre activité de créatif.</p>
                                <a href="{{ route('creatifs.edit') }}"
                                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full transition-all">
                                    Compléter mon profil
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- ─── ONGLET : MES MISSIONS ─── --}}
                @if ($activeTab === 'missions')
                    @php
                        $espaceCouleurs = [
                            'bg-emerald-50 border-emerald-100',
                            'bg-violet-50 border-violet-100',
                            'bg-amber-50 border-amber-100',
                            'bg-sky-50 border-sky-100',
                            'bg-pink-50 border-pink-100',
                        ];
                    @endphp
                    <div class="space-y-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-black text-gray-900">Mes missions</h2>
                                <p class="text-xs text-gray-400 mt-0.5">Vos candidatures envoyées et les missions que
                                    vous avez publiées.</p>
                            </div>
                            <a href="{{ route('missions.create') }}"
                                class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all whitespace-nowrap">
                                Publier une mission
                            </a>
                        </div>

                        {{-- Mes candidatures --}}
                        <div>
                            <h3 class="text-sm font-black text-gray-900 mb-4">
                                Mes candidatures ({{ $appliedMissions->count() }})
                            </h3>
                            @if ($appliedMissions->count())
                                <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                                    @foreach ($appliedMissions as $i => $application)
                                        @php $mission = $application->mission; @endphp
                                        <a href="{{ $mission ? route('missions.show', $mission) : '#' }}"
                                            class="block border rounded-2xl p-5 hover:shadow-md transition-all {{ $espaceCouleurs[$i % count($espaceCouleurs)] }}">
                                            <div class="flex items-center justify-between mb-4">
                                                <img src="{{ $mission?->user?->creatif?->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($mission?->user?->username ?? 'M') . '&background=6366f1&color=fff' }}"
                                                    class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm">
                                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ match($application->status) { 'accepted' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700', default => 'bg-white/70 text-amber-700' } }}">
                                                    {{ ['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Refusée'][$application->status] }}
                                                </span>
                                            </div>
                                            <p class="font-bold text-gray-900 text-sm leading-snug mb-1">
                                                {{ $mission->title ?? 'Mission supprimée' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $mission?->user?->username ?? '—' }} ·
                                                envoyée {{ $application->created_at->diffForHumans() }}
                                            </p>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                    <p class="text-sm text-gray-400">Vous n'avez postulé à aucune mission pour le
                                        moment.</p>
                                    <a href="{{ route('missions.index') }}"
                                        class="inline-block mt-2 text-indigo-600 font-semibold text-xs hover:underline">
                                        Parcourir les missions →
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Mes missions publiées --}}
                        <div>
                            <h3 class="text-sm font-black text-gray-900 mb-4">
                                Mes missions publiées ({{ $postedMissions->count() }})
                            </h3>
                            @if ($postedMissions->count())
                                <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                                    @foreach ($postedMissions as $i => $mission)
                                        <a href="{{ route('missions.show', $mission) }}"
                                            class="block border rounded-2xl p-5 hover:shadow-md transition-all {{ $espaceCouleurs[$i % count($espaceCouleurs)] }}">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex -space-x-2">
                                                    @forelse ($mission->applications->take(4) as $application)
                                                        <img src="{{ $application->user?->creatif?->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($application->user?->username ?? 'M') . '&background=6366f1&color=fff' }}"
                                                            class="w-8 h-8 rounded-full object-cover border-2 border-white shadow-sm">
                                                    @empty
                                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-white/70 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                            </svg>
                                                        </div>
                                                    @endforelse
                                                    @if ($mission->applications_count > 4)
                                                        <div class="w-8 h-8 rounded-full border-2 border-white bg-gray-800 text-white text-[10px] font-bold flex items-center justify-center">
                                                            +{{ $mission->applications_count - 4 }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-white/70 text-gray-600">
                                                    {{ ['open' => 'Ouverte', 'in_progress' => 'En cours', 'completed' => 'Terminée', 'cancelled' => 'Annulée'][$mission->status] ?? $mission->status }}
                                                </span>
                                            </div>
                                            <p class="font-bold text-gray-900 text-sm leading-snug mb-1">{{ $mission->title }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $mission->applications_count }} candidature{{ $mission->applications_count > 1 ? 's' : '' }}
                                            </p>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                    <p class="text-sm text-gray-400">Vous n'avez publié aucune mission pour le
                                        moment.</p>
                                    <a href="{{ route('missions.create') }}"
                                        class="inline-block mt-2 text-indigo-600 font-semibold text-xs hover:underline">
                                        Publier une mission →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- ─── ONGLET : SERVICES ─── --}}
                @if ($activeTab === 'services')
                    <div
                        class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Services bientôt disponibles</h3>
                        <p class="text-sm text-gray-400 text-center max-w-xs mb-6">Vous pourrez bientôt proposer vos
                            services et être payé via Mobile Money.</p>
                        <a href="{{ route('services.index') }}"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full transition-all">
                            En savoir plus →
                        </a>
                    </div>
                @endif

                {{-- ─── ONGLET : STATS ─── --}}
                @if ($activeTab === 'stats')
                    <div>
                        <h2 class="text-lg font-black text-gray-900 mb-5">Statistiques</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            @foreach ([['label' => 'Projets publiés', 'val' => count($projects)], ['label' => 'Builder Score', 'val' => number_format($creatif->builder_score ?? 0)], ['label' => 'Likes reçus', 'val' => $totalLikes], ['label' => 'Commentaires', 'val' => $totalComments]] as $stat)
                                <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center">
                                    <div class="text-3xl font-black text-gray-900">{{ $stat['val'] }}</div>
                                    <div class="text-xs text-gray-400 mt-1">{{ $stat['label'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-6 text-center">
                            <h3 class="font-bold text-gray-900 mb-1">Analytics détaillées bientôt</h3>
                            <p class="text-sm text-gray-500">Vues par projet, provenance géographique, performance —
                                tout ça arrive très bientôt.</p>
                        </div>
                    </div>
                @endif

                {{-- ─── ONGLET : PARAMÈTRES ─── --}}
                @if ($activeTab === 'parametres')
                    <div class="space-y-4">
                        <h2 class="text-lg font-black text-gray-900">Paramètres du compte</h2>

                        {{-- Visibilité du profil --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <h3 class="font-bold text-gray-900 mb-1">Visibilité du profil</h3>
                            <p class="text-sm text-gray-500 mb-4">
                                Votre profil est actuellement
                                <span class="font-semibold {{ $creatif?->is_paused ? 'text-amber-600' : 'text-green-600' }}">
                                    {{ $creatif?->is_paused ? 'en pause (masqué des listes publiques)' : 'public et visible par tous' }}
                                </span>.
                                Vous pouvez le mettre en pause depuis la section « Mettre en pause » ci-dessous.
                            </p>
                        </div>

                        {{-- Compte --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <h3 class="font-bold text-gray-900 mb-1">Informations du compte</h3>
                            <p class="text-sm text-gray-500 mb-4">Gérez votre email et votre mot de passe.</p>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <div>
                                        <p class="text-xs text-gray-400">Email</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}"
                                        class="text-xs text-indigo-600 font-semibold hover:underline">Modifier</a>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <div>
                                        <p class="text-xs text-gray-400">Mot de passe</p>
                                        <p class="text-sm font-semibold text-gray-900">••••••••</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}"
                                        class="text-xs text-indigo-600 font-semibold hover:underline">Modifier</a>
                                </div>
                            </div>
                        </div>

                        {{-- Mettre en pause --}}
                        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-1">
                                    @if ($creatif?->is_paused)
                                        <h3 class="font-bold text-amber-900 mb-1">Votre profil est en pause</h3>
                                        <p class="text-sm text-amber-700 mb-4">Votre profil est actuellement masqué des
                                            listes publiques. Réactivez-le à tout moment.</p>
                                    @else
                                        <h3 class="font-bold text-amber-900 mb-1">Mettre mon compte en pause</h3>
                                        <p class="text-sm text-amber-700 mb-4">Votre profil sera temporairement masqué
                                            des listes publiques. Vous pourrez le réactiver à tout moment.</p>
                                    @endif
                                    <form method="POST" action="{{ route('creatifs.pause') }}">
                                        @csrf
                                        @method('PUT')
                                        <button
                                            class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl transition-all">
                                            {{ $creatif?->is_paused ? 'Réactiver mon profil' : 'Mettre en pause' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Supprimer le compte --}}
                        <div class="bg-red-50 border border-red-100 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="flex-1">
                                    <h3 class="font-bold text-red-900 mb-1">Supprimer définitivement mon compte</h3>
                                    <p class="text-sm text-red-700 mb-4">Cette action est irréversible. Toutes vos
                                        données, projets et profil seront supprimés définitivement.</p>
                                    <button type="button" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                        class="px-5 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl transition-all">
                                        Supprimer mon compte
                                    </button>
                                </div>
                            </div>
                        </div>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    Êtes-vous sûr(e) de vouloir supprimer votre compte ?
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Une fois votre compte supprimé, toutes ses données seront définitivement effacées.
                                    Saisissez votre mot de passe pour confirmer la suppression définitive de votre compte.
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="delete-password" value="Mot de passe" class="sr-only" />
                                    <x-text-input id="delete-password" name="password" type="password" class="mt-1 block w-3/4"
                                        placeholder="Mot de passe" />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        Annuler
                                    </x-secondary-button>
                                    <x-danger-button class="ms-3">
                                        Supprimer mon compte
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>

                    </div>
                @endif

                {{-- ─── ONGLET : PAIEMENTS ─── --}}
                @if ($activeTab === 'paiements')
                    @php $mesMoyens = Auth::user()->payment_methods ?? []; @endphp
                    <form method="POST" action="{{ route('profile.payment-methods.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <h2 class="text-lg font-black text-gray-900">Moyens de paiement</h2>
                            <p class="text-sm text-gray-400 mt-1">Choisissez comment vous souhaitez être payé pour vos
                                missions.</p>
                        </div>

                        {{-- Mobile Money Afrique --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="flex items-center gap-3 mb-5">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Mobile Money Afrique</h3>
                                    <p class="text-xs text-gray-400">Paiements locaux recommandés</p>
                                </div>
                                <span
                                    class="ml-auto text-[10px] bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-full">Recommandé</span>
                            </div>

                            <div class="space-y-3">
                                @foreach ([['id' => 'mtn', 'nom' => 'MTN Mobile Money', 'pays' => 'Bénin, Ghana, Côte d\'Ivoire...', 'color' => 'bg-yellow-400', 'logo' => 'MTN'], ['id' => 'moov', 'nom' => 'Moov Money', 'pays' => 'Bénin, Togo, Niger...', 'color' => 'bg-blue-500', 'logo' => 'MOOV'], ['id' => 'wave', 'nom' => 'Wave', 'pays' => 'Sénégal, Côte d\'Ivoire...', 'color' => 'bg-sky-400', 'logo' => 'WAVE'], ['id' => 'orange', 'nom' => 'Orange Money', 'pays' => 'Afrique francophone', 'color' => 'bg-orange-500', 'logo' => 'OM'], ['id' => 'kkiapay', 'nom' => 'Kkiapay', 'pays' => 'Bénin & Afrique de l\'Ouest', 'color' => 'bg-indigo-600', 'logo' => 'KK'], ['id' => 'fedapay', 'nom' => 'FedaPay', 'pays' => 'Bénin, Togo, Sénégal...', 'color' => 'bg-violet-600', 'logo' => 'FEDA']] as $pm)
                                    <label
                                        class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-indigo-200 hover:bg-indigo-50/20 transition-all group">
                                        <input type="checkbox" name="paiements[]" value="{{ $pm['id'] }}" @checked(in_array($pm['id'], $mesMoyens))
                                            class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500">
                                        <div
                                            class="w-10 h-10 {{ $pm['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="text-white text-[9px] font-black tracking-tight">{{ $pm['logo'] }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-gray-900">{{ $pm['nom'] }}</p>
                                            <p class="text-xs text-gray-400">{{ $pm['pays'] }}</p>
                                        </div>
                                        <div
                                            class="w-2 h-2 rounded-full bg-green-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            {{-- Numéro Mobile Money --}}
                            <div class="mt-4 pt-4 border-t border-gray-50">
                                <label class="block text-xs font-bold text-gray-700 mb-1.5">Numéro Mobile Money</label>
                                <div class="flex gap-2">
                                    <select name="payment_phone_prefix"
                                        class="px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        @foreach (['+229', '+221', '+225', '+233', '+223', '+234'] as $prefix)
                                            <option value="{{ $prefix }}" @selected(Auth::user()->payment_phone_prefix === $prefix)>{{ $prefix }}</option>
                                        @endforeach
                                    </select>
                                    <input type="tel" name="payment_phone" value="{{ Auth::user()->payment_phone }}" placeholder="Ex: 97000000"
                                        class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        {{-- Paiements internationaux --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="flex items-center gap-3 mb-5">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Paiements Internationaux</h3>
                                    <p class="text-xs text-gray-400">Pour les clients hors Afrique</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                {{-- PayPal --}}
                                <label
                                    class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-blue-200 hover:bg-blue-50/20 transition-all">
                                    <input type="checkbox" name="paiements[]" value="paypal" @checked(in_array('paypal', $mesMoyens))
                                        class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                                    <div
                                        class="w-10 h-10 bg-[#003087] rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-4" viewBox="0 0 124 33" fill="none">
                                            <path
                                                d="M46.2 8.1H35.6c-.7 0-1.3.5-1.4 1.2L30 30.1c-.1.5.3 1 .8 1h5.3c.7 0 1.3-.5 1.4-1.2l1-6.5c.1-.7.7-1.2 1.4-1.2h3.3c6.9 0 10.9-3.3 11.9-9.9.5-2.9 0-5.1-1.3-6.7-1.5-1.7-4.1-2.5-7.6-2.5z"
                                                fill="#009cde" />
                                            <path
                                                d="M46.2 8.1H35.6c-.7 0-1.3.5-1.4 1.2L30 30.1c-.1.5.3 1 .8 1h5.3c.7 0 1.3-.5 1.4-1.2l1-6.5c.1-.7.7-1.2 1.4-1.2h3.3c6.9 0 10.9-3.3 11.9-9.9.5-2.9 0-5.1-1.3-6.7-1.5-1.7-4.1-2.5-7.6-2.5z"
                                                fill="#012169" opacity=".5" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">PayPal</p>
                                        <p class="text-xs text-gray-400">Paiements en USD/EUR</p>
                                    </div>
                                    <span
                                        class="text-[10px] bg-blue-50 text-blue-600 font-semibold px-2 py-0.5 rounded-full">International</span>
                                </label>

                                {{-- Stripe --}}
                                <label
                                    class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-violet-200 hover:bg-violet-50/20 transition-all">
                                    <input type="checkbox" name="paiements[]" value="stripe" @checked(in_array('stripe', $mesMoyens))
                                        class="w-4 h-4 rounded text-violet-600 focus:ring-violet-500">
                                    <div
                                        class="w-10 h-10 bg-[#635bff] rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" viewBox="0 0 60 25" fill="white">
                                            <path
                                                d="M59.6 10.8c0-3.6-1.8-6.4-5.2-6.4-3.4 0-5.5 2.8-5.5 6.4 0 4.2 2.4 6.3 5.8 6.3 1.7 0 3-.4 3.9-1v-2.8c-.9.5-2 .8-3.4.8-1.3 0-2.5-.5-2.7-2.2h6.8c.2-.3.3-.9.3-1.1zm-6.9-1.4c0-1.7 1-2.4 2-2.4 1 0 1.9.7 1.9 2.4h-3.9zM41.6 4.4c-1.4 0-2.3.6-2.8 1.1l-.2-.9h-3.1v16.9l3.5-.7.1-4.1c.5.4 1.3.9 2.5.9 2.5 0 4.8-2 4.8-6.4-.1-4.1-2.4-6.8-4.8-6.8zm-.8 10.4c-.8 0-1.3-.3-1.7-.7l-.1-5.4c.4-.4.9-.7 1.8-.7 1.4 0 2.3 1.5 2.3 3.4 0 2-.9 3.4-2.3 3.4zM33 3.3l-3.5.7v2.8l3.5-.7V3.3zM29.5 6.4h3.5v10.3h-3.5V6.4zM25.7 7.4l-.2-1H22.4v10h3.5v-6.8c.8-1.1 2.2-.9 2.6-.7V6.4c-.5-.2-2.2-.5-2.8 1zM18.9 4.4c-1.2 0-2 .6-2.5 1l-.1-.9h-3.1v10.3h3.5V8.6c.4-.5 1-.8 1.7-.8.7 0 1.2.3 1.2 1.4v7.6h3.5V9c0-3.1-1.7-4.6-4.2-4.6zM7.5 8.8L7.1 7H4.3L4.2 21l3.5-.7.1-4.4c.5.3 1.1.5 2 .5 2.6 0 4.9-2 4.9-6.4 0-4.1-2.4-6.8-4.9-6.8-1 0-2 .5-2.3.6zm.5 9.4c-.8 0-1.3-.3-1.7-.7l-.1-5.4c.4-.5.9-.7 1.8-.7 1.4 0 2.3 1.5 2.3 3.4 0 2-.9 3.4-2.3 3.4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">Stripe</p>
                                        <p class="text-xs text-gray-400">Cartes bancaires internationales</p>
                                    </div>
                                    <span
                                        class="text-[10px] bg-violet-50 text-violet-600 font-semibold px-2 py-0.5 rounded-full">International</span>
                                </label>

                                {{-- Wise --}}
                                <label
                                    class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-green-200 hover:bg-green-50/20 transition-all">
                                    <input type="checkbox" name="paiements[]" value="wise" @checked(in_array('wise', $mesMoyens))
                                        class="w-4 h-4 rounded text-green-600 focus:ring-green-500">
                                    <div
                                        class="w-10 h-10 bg-[#9fe870] rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span class="text-[#163300] font-black text-xs">WISE</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">Wise (TransferWise)</p>
                                        <p class="text-xs text-gray-400">Virements internationaux</p>
                                    </div>
                                    <span
                                        class="text-[10px] bg-green-50 text-green-600 font-semibold px-2 py-0.5 rounded-full">International</span>
                                </label>
                            </div>
                        </div>

                        {{-- Virement bancaire --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Virement Bancaire</h3>
                                    <p class="text-xs text-gray-400">Pour les grandes transactions</p>
                                </div>
                            </div>
                            <label
                                class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-gray-300 transition-all">
                                <input type="checkbox" name="paiements[]" value="virement" @checked(in_array('virement', $mesMoyens))
                                    class="w-4 h-4 rounded text-gray-600">
                                <div
                                    class="w-10 h-10 bg-gray-800 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-[9px] font-black">BANK</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Virement bancaire (IBAN)</p>
                                    <p class="text-xs text-gray-400">Délai 2-5 jours ouvrés</p>
                                </div>
                            </label>
                        </div>

                        {{-- Bouton sauvegarder --}}
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200">
                                Sauvegarder mes moyens de paiement
                            </button>
                        </div>
                    </form>
                @endif

                {{-- ─── ONGLET : ASSISTANT IA ─── --}}
                @if ($activeTab === 'assistant')
                    <div x-data="mefolioAssistant()" x-init="init()" class="flex flex-col"
                        style="height: calc(100vh - 220px); min-height: 480px;">

                        <div class="mb-4">
                            <h2 class="text-lg font-black text-gray-900">Assistant IA</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Un coup de main pour peaufiner votre profil créatif :
                                bio, spécialité, présentation de votre portfolio.</p>
                        </div>

                        <div class="flex-1 min-h-0 bg-white border border-gray-100 rounded-2xl flex flex-col overflow-hidden">

                            <div x-ref="thread" class="flex-1 overflow-y-auto p-5 space-y-4">
                                <template x-if="messages.length === 0">
                                    <div class="h-full flex flex-col items-center justify-center text-center px-6">
                                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-900 mb-1">Comment puis-je vous aider ?</h3>
                                        <p class="text-xs text-gray-400 max-w-xs mb-5">Posez une question ou choisissez une
                                            suggestion pour commencer.</p>
                                        <div class="flex flex-wrap justify-center gap-2 max-w-md">
                                            <template x-for="suggestion in suggestions" :key="suggestion">
                                                <button type="button" @click="send(suggestion)"
                                                    class="text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-2 rounded-xl transition-all"
                                                    x-text="suggestion"></button>
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <template x-for="(msg, index) in messages" :key="index">
                                    <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                                        <div class="max-w-[80%] rounded-2xl px-4 py-2.5 text-sm leading-relaxed whitespace-pre-line"
                                            :class="msg.role === 'user'
                                                ? 'bg-indigo-600 text-white rounded-br-sm'
                                                : (msg.isError ? 'bg-amber-50 text-amber-800 rounded-bl-sm' : 'bg-gray-100 text-gray-800 rounded-bl-sm')"
                                            x-text="msg.content"></div>
                                    </div>
                                </template>

                                <div class="flex justify-start" x-show="loading" x-cloak>
                                    <div class="bg-gray-100 text-gray-400 rounded-2xl rounded-bl-sm px-4 py-2.5 text-sm">
                                        <span class="inline-flex gap-1">
                                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0ms"></span>
                                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:150ms"></span>
                                            <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:300ms"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <form @submit.prevent="send(input); input = ''"
                                class="flex items-center gap-2 p-3 border-t border-gray-100">
                                <input type="text" x-model="input" :disabled="loading"
                                    placeholder="Ex : aide-moi à écrire ma bio..."
                                    class="flex-1 border-gray-200 rounded-xl text-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50">
                                <button type="submit" :disabled="loading || !input.trim()"
                                    class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-40 disabled:cursor-not-allowed text-white text-sm font-bold rounded-xl transition-all">
                                    Envoyer
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        function mefolioAssistant() {
                            return {
                                messages: [],
                                input: '',
                                loading: false,
                                suggestions: [
                                    'Aide-moi à écrire ma bio',
                                    'Quels champs compléter en priorité ?',
                                    'Comment formuler ma spécialité ?',
                                ],
                                init() {},
                                async send(text) {
                                    text = (text || '').trim();
                                    if (!text || this.loading) return;

                                    this.messages.push({ role: 'user', content: text });
                                    this.loading = true;
                                    this.scrollDown();

                                    const history = this.messages
                                        .filter(m => !m.isError)
                                        .slice(0, -1)
                                        .map(m => ({ role: m.role, content: m.content }));

                                    try {
                                        const res = await fetch('{{ route('assistant.chat') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                            },
                                            body: JSON.stringify({ message: text, history }),
                                        });
                                        const data = await res.json();

                                        if (res.ok) {
                                            this.messages.push({ role: 'assistant', content: data.reply });
                                        } else {
                                            this.messages.push({ role: 'assistant', content: data.message || 'Une erreur est survenue.', isError: true });
                                        }
                                    } catch (e) {
                                        this.messages.push({ role: 'assistant', content: 'Connexion impossible. Vérifiez votre connexion et réessayez.', isError: true });
                                    } finally {
                                        this.loading = false;
                                        this.scrollDown();
                                    }
                                },
                                scrollDown() {
                                    this.$nextTick(() => {
                                        const el = this.$refs.thread;
                                        if (el) el.scrollTop = el.scrollHeight;
                                    });
                                },
                            };
                        }
                    </script>
                @endif

            </main>

        </div>
    </div>

</x-app-layout>

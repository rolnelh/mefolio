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
                            <p class="text-lg font-black text-gray-900 dark:text-white">0</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Vues</p>
                        </div>
                        <div class="py-3 text-center">
                            <p class="text-lg font-black text-gray-900 dark:text-white">0</p>
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

                {{-- Navigation sidebar --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-3">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 p-3">
                        <nav class="space-y-1">
                            @foreach ([['tab' => 'projets', 'label' => 'Projets', 'icon' => 'project.png', 'count' => count($projects)], ['tab' => 'services', 'label' => 'Services', 'icon' => 'service.png', 'count' => 0], ['tab' => 'stats', 'label' => 'Analytics', 'icon' => 'statistics.png', 'count' => null], ['tab' => 'parametres', 'label' => 'Paramètres', 'icon' => 'setting.png', 'count' => null], ['tab' => 'paiements', 'label' => 'Moyens de paiement', 'emoji' => '💳', 'count' => null]] as $nav)
                                <a href="?tab={{ $nav['tab'] }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all
            {{ $activeTab === $nav['tab'] ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">

                                    <img src="{{ asset('images/' . $nav['icon']) }}" alt="{{ $nav['label'] }}"
                                        class="w-5 h-5 object-contain">

                                    <span class="text-sm font-semibold flex-1">
                                        {{ $nav['label'] }}
                                    </span>

                                    @if ($nav['count'] !== null)
                                        <span
                                            class="text-xs
                {{ $activeTab === $nav['tab'] ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}
                font-bold px-2 py-0.5 rounded-full">
                                            {{ $nav['count'] }}
                                        </span>
                                    @endif

                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <div class="items-center mt-10 mx-auto">
                    <a href="#" class="bg-green-600 text-white text-xs px-3 py-2 rounded-xl">
                        📢 Promouvoir mon profil
                    </a>
                </div>

            </aside>


            <main class="flex-1 min-w-0 space-y-6">

                @if (session('error'))
                    <div
                        class="mb-4 flex items-center gap-3 p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl">
                        <span class="text-xl">⚠️</span>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

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
                            <a href="{{ route('creatifs.edit') }}"
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
                                        {{ $etapes['profil'] ? '✓ Profil complété' : 'Compléter mon profil' }}
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
                                        {{ $etapes['projet'] ? '✓ Premier projet ajouté' : 'Ajouter mon premier projet' }}
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
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mt-8">

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
                                <div class="text-4xl mb-4">🎨</div>
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
                                        ⚠️ Compléter mon profil d'abord
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                {{-- ─── ONGLET : SERVICES ─── --}}
                @if ($activeTab === 'services')
                    <div
                        class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <div class="text-4xl mb-4">🛠️</div>
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
                            @foreach ([['label' => 'Vues du profil', 'val' => '0', 'emoji' => '👁️', 'color' => 'indigo'], ['label' => 'Vues projets', 'val' => '0', 'emoji' => '🎨', 'color' => 'violet'], ['label' => 'Likes reçus', 'val' => '0', 'emoji' => '❤️', 'color' => 'pink'], ['label' => 'Commentaires', 'val' => '0', 'emoji' => '💬', 'color' => 'blue']] as $stat)
                                <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center">
                                    <div class="text-2xl mb-2">{{ $stat['emoji'] }}</div>
                                    <div class="text-3xl font-black text-gray-900">{{ $stat['val'] }}</div>
                                    <div class="text-xs text-gray-400 mt-1">{{ $stat['label'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-6 text-center">
                            <div class="text-2xl mb-2">📊</div>
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
                            <p class="text-sm text-gray-500 mb-4">Choisissez qui peut voir votre profil et vos projets.
                            </p>
                            <div class="space-y-3">
                                @foreach ([['val' => 'public', 'label' => 'Public', 'desc' => 'Tout le monde peut voir votre profil et vos projets.', 'emoji' => '🌍'], ['val' => 'members', 'label' => 'Membres uniquement', 'desc' => 'Seuls les membres connectés peuvent voir votre profil.', 'emoji' => '👥'], ['val' => 'private', 'label' => 'Privé', 'desc' => 'Votre profil est masqué. Vous seul pouvez le voir.', 'emoji' => '🔒']] as $opt)
                                    <label
                                        class="flex items-start gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-indigo-200 hover:bg-indigo-50/30 transition-all">
                                        <input type="radio" name="visibility" value="{{ $opt['val'] }}"
                                            {{ ($creatif?->visibility ?? 'public') === $opt['val'] ? 'checked' : '' }}
                                            class="mt-0.5 text-indigo-600 focus:ring-indigo-500">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $opt['emoji'] }}
                                                {{ $opt['label'] }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $opt['desc'] }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <button
                                class="mt-4 px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all">
                                Sauvegarder
                            </button>
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
                                <div class="text-2xl">⏸️</div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-amber-900 mb-1">Mettre mon compte en pause</h3>
                                    <p class="text-sm text-amber-700 mb-4">Votre profil sera temporairement masqué.
                                        Vous pourrez le réactiver à tout moment.</p>
                                    <button
                                        class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl transition-all">
                                        Mettre en pause
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Supprimer le compte --}}
                        <div class="bg-red-50 border border-red-100 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="text-2xl">🗑️</div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-red-900 mb-1">Supprimer définitivement mon compte</h3>
                                    <p class="text-sm text-red-700 mb-4">Cette action est irréversible. Toutes vos
                                        données, projets et profil seront supprimés définitivement.</p>
                                    <button onclick="return confirm('Êtes-vous sûr ? Cette action est irréversible.')"
                                        class="px-5 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl transition-all">
                                        Supprimer mon compte
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

                {{-- ─── ONGLET : PAIEMENTS ─── --}}
                @if ($activeTab === 'paiements')
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-lg font-black text-gray-900">Moyens de paiement</h2>
                            <p class="text-sm text-gray-400 mt-1">Choisissez comment vous souhaitez être payé pour vos
                                missions.</p>
                        </div>

                        {{-- Mobile Money Afrique --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                    <span class="text-base">🌍</span>
                                </div>
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
                                        <input type="checkbox" name="paiements[]" value="{{ $pm['id'] }}"
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
                                    <select
                                        class="px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        <option>🇧🇯 +229</option>
                                        <option>🇸🇳 +221</option>
                                        <option>🇨🇮 +225</option>
                                        <option>🇬🇭 +233</option>
                                        <option>🇲🇱 +223</option>
                                        <option>🇳🇬 +234</option>
                                    </select>
                                    <input type="tel" placeholder="Ex: 97000000"
                                        class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>

                        {{-- Paiements internationaux --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <span class="text-base">🌐</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Paiements Internationaux</h3>
                                    <p class="text-xs text-gray-400">Pour les clients hors Afrique</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                {{-- PayPal --}}
                                <label
                                    class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-blue-200 hover:bg-blue-50/20 transition-all">
                                    <input type="checkbox" name="paiements[]" value="paypal"
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
                                    <input type="checkbox" name="paiements[]" value="stripe"
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
                                    <input type="checkbox" name="paiements[]" value="wise"
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
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <span class="text-base">🏦</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Virement Bancaire</h3>
                                    <p class="text-xs text-gray-400">Pour les grandes transactions</p>
                                </div>
                            </div>
                            <label
                                class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-gray-300 transition-all">
                                <input type="checkbox" name="paiements[]" value="virement"
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
                            <button
                                class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200">
                                Sauvegarder mes moyens de paiement
                            </button>
                        </div>
                    </div>
                @endif

            </main>

        </div>
    </div>

</x-app-layout>

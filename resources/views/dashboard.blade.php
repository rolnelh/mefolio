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
    @endphp

    <div class="relative w-full h-48 sm:h-64 md:h-72 rounded-sm overflow-hidden mb-6 bg-gray-200">
        <img src="{{ $couverturePath }}" alt="Photo de couverture"
            class="w-full h-full bg-center object-cover object-center">
        <div class="absolute bottom-2 right-2">
            <a href="{{ route('creatifs.edit') }}"
                class="bg-white/80 hover:bg-white text-gray-800 text-xs font-semibold px-3 py-1.5 rounded-md shadow-md transition-all">
                {{ $creatif && $creatif->couverture ? 'Changer la couverture' : 'Ajouter une couverture' }}
            </a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto mt-2 p-6 space-y-6">

        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">

                    <div class="relative">
                        <img src="{{ $creatif?->photo ? $creatif->photo : asset('images/avatar.png') }}" alt="Profil"
                            class="w-28 h-28 rounded-2xl object-cover ring-4 ring-indigo-50 dark:ring-indigo-900/20 shadow-md">
                        <div
                            class="absolute -bottom-2 -right-2 bg-green-500 w-5 h-5 rounded-full border-4 border-white dark:border-gray-900">
                        </div>
                    </div>

                    <div class="text-center sm:text-left flex-1">
                        <div class="flex items-center justify-center sm:justify-start gap-2">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $creatif ? $creatif->nom . ' ' . $creatif->prenom : Auth::user()->username }}
                            </h2>
                            <a href="{{ route('creatifs.edit') }}"
                                class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex flex-wrap justify-center sm:justify-start gap-y-2 gap-x-4 mt-2">
                            @if ($creatif?->specialite)
                                <span class="flex items-center text-sm font-medium text-indigo-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 mr-2"></span>
                                    {{ $creatif->specialite }}
                                </span>
                            @endif
                            @if ($creatif?->localisation)
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $creatif->localisation }}
                                </span>
                            @endif
                        </div>

                        @if ($creatif?->bio)
                            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed max-w-lg">
                                {{ $creatif->bio }}
                            </p>
                        @endif

                        <div class="flex justify-center sm:justify-start gap-4 mt-4">
                            <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center lg:justify-end gap-3 self-center lg:self-start">
                    <div class="flex bg-gray-50 dark:bg-gray-800/50 p-1 rounded-xl">
                        <button class="relative p-2.5 text-gray-500 hover:text-indigo-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span
                                class="absolute top-2 right-2 w-2 h-2 bg-blue-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </button>
                    </div>
                    @if (!$creatif)
                        <a href="{{ route('creatifs.create') }}"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all shadow-md shadow-indigo-200">
                            Compléter profil
                        </a>
                    @endif
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-800 flex justify-between items-center">
                <span class="text-[11px] uppercase tracking-wider font-bold text-gray-400">
                    Membre depuis {{ Auth::user()->created_at->translatedFormat('F Y') }}
                </span>
                @if ($creatif?->portfolio_url)
                    <a href="{{ $creatif->portfolio_url }}" target="_blank"
                        class="text-xs text-indigo-500 hover:underline font-medium">
                        {{ str_replace(['http://', 'https://'], '', $creatif->portfolio_url) }}
                    </a>
                @endif
            </div>
        </div>

        @if ($pourcentage < 100)
            <div class="bg-gradient-to-r from-indigo-50 to-violet-50 border border-indigo-100 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Configurez votre espace créatif</h3>
                        <p class="text-sm text-gray-500 mt-0.5">{{ $progression }}/{{ $total }} étapes
                            complétées</p>
                    </div>
                    <span class="text-2xl font-extrabold text-indigo-600">{{ (int) $pourcentage }}%</span>
                </div>

                <div class="w-full bg-white rounded-full h-2 mb-6 overflow-hidden">
                    <div class="bg-indigo-600 h-2 rounded-full transition-all duration-500"
                        style="width: {{ $pourcentage }}%"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <a href="{{ route('creatifs.edit') }}"
                        class="flex items-center gap-3 p-4 bg-white rounded-xl border {{ $etapes['profil'] ? 'border-green-200' : 'border-indigo-200 hover:border-indigo-400' }} transition-all">
                        <div
                            class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 {{ $etapes['profil'] ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                            @if ($etapes['profil'])
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p
                                class="text-sm font-semibold {{ $etapes['profil'] ? 'text-green-700' : 'text-gray-900' }}">
                                {{ $etapes['profil'] ? '✓ Profil complété' : 'Compléter mon profil' }}
                            </p>
                            <p class="text-xs text-gray-400">Photo, bio, spécialité, localisation</p>
                        </div>
                        @if (!$etapes['profil'])
                            <svg class="w-4 h-4 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        @endif
                    </a>

                    <a href="{{ $etapes['profil'] ? route('projets.create') : '#' }}"
                        class="flex items-center gap-3 p-4 bg-white rounded-xl border {{ $etapes['projet'] ? 'border-green-200' : 'border-indigo-200' }} transition-all {{ !$etapes['profil'] ? 'opacity-50 cursor-not-allowed' : 'hover:border-indigo-400' }}">
                        <div
                            class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 {{ $etapes['projet'] ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                            @if ($etapes['projet'])
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p
                                class="text-sm font-semibold {{ $etapes['projet'] ? 'text-green-700' : 'text-gray-900' }}">
                                {{ $etapes['projet'] ? '✓ Premier projet ajouté' : 'Ajouter mon premier projet' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ !$etapes['profil'] ? 'Complétez d\'abord votre profil' : 'Partagez votre première réalisation' }}
                            </p>
                        </div>
                        @if (!$etapes['projet'] && $etapes['profil'])
                            <svg class="w-4 h-4 text-indigo-400 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        @endif
                    </a>

                </div>
            </div>
        @endif

        <hr class="border-gray-100">

        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">

            @if ($aDesProjets)
                <div class="flex items-center justify-between mb-6">
                    <span class="text-base font-bold text-gray-900 dark:text-white">Mes projets</span>
                    <span class="text-sm text-gray-400">{{ count($projects) }}
                        projet{{ count($projects) > 1 ? 's' : '' }}</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    <a href="{{ route('projets.create') }}"
                        class="group flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl hover:border-indigo-500 transition-all duration-300 min-h-[240px]">
                        <div
                            class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="mt-4 font-medium text-gray-600 dark:text-gray-400">Nouveau projet</span>
                    </a>

                    @foreach ($projects as $project)
                        <div
                            class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-all duration-300">

                            <div class="relative overflow-hidden" style="height: 180px;">
                                <img src="{{ $project->image ?: 'https://via.placeholder.com/400x300' }}"
                                    alt="{{ $project->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 dark:text-white truncate text-sm mb-1">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                    {{ $project->description }}
                                </p>

                                <div
                                    class="flex items-center justify-between mt-4 pt-3 border-t border-gray-50 dark:border-gray-700">
                                    <a href="{{ route('projects.show', $project->slug) }}"
                                        class="text-indigo-600 text-xs font-semibold hover:text-indigo-700 transition-colors">
                                        Voir →
                                    </a>
                                    <div class="flex gap-1">
                                        <a href="{{ route('projets.edit', $project->id) }}"
                                            class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.414-9.414z" />
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('projets.destroy', $project->id) }}"
                                            onsubmit="return confirm('Supprimer ce projet ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="flex flex-col items-center justify-center py-16 bg-gray-50 dark:bg-gray-800/50 rounded-3xl border-2 border-dotted border-gray-200 dark:border-gray-700">
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-full shadow-sm mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Aucun projet pour le moment</h3>
                    <p class="text-gray-500 mt-2 mb-8 text-center max-w-sm">
                        Votre portfolio est vide. Ajoutez votre première réalisation pour impressionner vos visiteurs.
                    </p>
                    @if ($profilComplet)
                        <a href="{{ route('projets.create') }}"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-full shadow-lg shadow-indigo-200 transition-all">
                            + Créer mon premier projet
                        </a>
                    @else
                        <a href="{{ route('creatifs.edit') }}"
                            class="px-8 py-3 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-full shadow-lg transition-all">
                            ⚠️ Compléter mon profil d'abord
                        </a>
                    @endif
                </div>
            @endif
        </div>

    </div>


</x-app-layout>

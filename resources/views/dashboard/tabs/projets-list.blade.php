{{--
    Onglet "Projets" — grille des projets du créatif (ou état vide).
    Variables attendues : $projects, $profilComplet, $aDesProjets.
--}}
<div class="flex items-center justify-between mb-5">
    <div>
        <h2 class="text-lg font-black text-gray-900 dark:text-white">{{ __('Mes projets') }}</h2>
        <p class="text-xs text-gray-400 mt-0.5">{{ trans_choice(':count projet dans votre portfolio|:count projets dans votre portfolio', count($projects), ['count' => count($projects)]) }}</p>
    </div>
    @if ($profilComplet)
        <a href="{{ route('projets.create') }}"
            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            {{ __('Nouveau projet') }}
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
                        <a href="{{ route('projets.edit', $project) }}"
                            class="p-1.5 bg-white/90 text-gray-700 hover:text-indigo-600 rounded-lg transition-all shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.414-9.414z" />
                            </svg>
                        </a>
                        <form method="POST"
                            action="{{ route('projets.destroy', $project) }}"
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
                            {{ __('Voir le projet') }} →
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
                class="mt-3 text-sm font-semibold text-gray-500 group-hover:text-indigo-600 transition-colors">{{ __('Nouveau projet') }}</span>
        </a>

    </div>
@else
    <div
        class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('Aucun projet pour le moment') }}</h3>
        <p class="text-sm text-gray-400 text-center max-w-xs mb-6">{{ __('Ajoutez votre première réalisation pour impressionner vos visiteurs.') }}</p>
        @if ($profilComplet)
            <a href="{{ route('projets.create') }}"
                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full transition-all">
                + {{ __('Créer mon premier projet') }}
            </a>
        @else
            <a href="{{ route('creatifs.edit') }}"
                class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-full transition-all">
                {{ __("Compléter mon profil d'abord") }}
            </a>
        @endif
    </div>
@endif

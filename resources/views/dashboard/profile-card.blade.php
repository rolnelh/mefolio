{{--
    Carte "profil" affichée dans la colonne de gauche du tableau de bord,
    à côté du rail de navigation (x-dashboard-sidebar).

    Variables attendues (fournies par dashboard.blade.php) :
    - $creatif      \App\Models\Creatif|null  Le profil créatif du user connecté.
    - $projects     Collection  Les projets du créatif (sert au compteur "Projets").
    - $totalLikes   int         Somme des likes reçus sur tous ses projets.
--}}
<div
    class="flex-1 min-w-0 max-w-xs bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    {{-- Avatar --}}
    <div class="px-6 pt-6 pb-4 text-center border-b border-gray-50 dark:border-gray-800">
        <div class="relative inline-block mb-3">
            @if ($creatif?->photo)
                <img src="{{ $creatif->photo }}" alt="Profil"
                    class="w-20 h-20 rounded-2xl object-cover ring-4 ring-indigo-50 dark:ring-indigo-900/20 shadow-md mx-auto">
            @else
                <div
                    class="w-20 h-20 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl font-black ring-4 ring-indigo-50 dark:ring-indigo-900/20 shadow-md mx-auto">
                    {{ strtoupper(substr($creatif?->prenom ?: Auth::user()->username, 0, 1)) }}
                </div>
            @endif
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
        class="grid grid-cols-4 divide-x divide-gray-50 dark:divide-gray-800 border-b border-gray-50 dark:border-gray-800">
        <div class="py-3 text-center">
            <p class="text-lg font-black text-gray-900 dark:text-white">{{ count($projects) }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ __('Projets') }}</p>
        </div>
        <div class="py-3 text-center">
            <p class="text-lg font-black text-gray-900 dark:text-white">{{ number_format($creatif->builder_score ?? 0) }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ __('Score') }}</p>
        </div>
        <div class="py-3 text-center">
            <p class="text-lg font-black text-gray-900 dark:text-white">{{ $totalLikes }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ __('Likes') }}</p>
        </div>
        <div class="py-3 text-center">
            <p class="text-lg font-black text-gray-900 dark:text-white">{{ number_format($creatif->profile_views ?? 0) }}</p>
            <p class="text-[10px] text-gray-400 uppercase tracking-wider">{{ __('Vues') }}</p>
        </div>
    </div>

    {{-- Liens sociaux --}}
    <div class="px-6 py-4 border-b border-gray-50 dark:border-gray-800">
        <div class="flex justify-center gap-3">
            @if ($creatif?->portfolio_url)
                <a href="{{ $creatif->portfolio_url }}" target="_blank"
                    class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                    title="{{ __('Portfolio') }}">
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
            {{ __('Modifier mon profil') }}
        </a>
        @if ($creatif?->slug)
            <a href="{{ route('creatifs.show', $creatif->slug) }}" target="_blank"
                class="flex items-center justify-center gap-2 w-full py-2 bg-gray-50 hover:bg-gray-100 text-gray-600 text-xs font-semibold rounded-xl transition-all border border-gray-100">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                {{ __('Voir mon profil public') }}
            </a>
        @endif
    </div>

    {{-- Membre depuis --}}
    <div class="px-6 pb-4">
        <p class="text-[10px] uppercase tracking-widest font-bold text-gray-300 text-center">
            {{ __('Membre depuis :date', ['date' => Auth::user()->created_at->translatedFormat('F Y')]) }}
        </p>
    </div>
</div>

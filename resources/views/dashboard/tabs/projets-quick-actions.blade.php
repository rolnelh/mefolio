{{--
    Onglet "Projets" — raccourcis en haut de page (avant la checklist
    d'onboarding). Variables attendues : $profilComplet (bool).
--}}
<div class="grid grid-cols-1 {{ $profilComplet ? 'sm:grid-cols-2' : 'sm:grid-cols-3' }} gap-3">
    @unless ($profilComplet)
        <div class="bg-violet-100 rounded-2xl p-4">
            <p class="text-sm font-bold text-gray-900">{{ __('Complétez votre profil') }}</p>
            <p class="text-xs text-gray-600 mt-0.5 mb-3">{{ __('Soyez repéré par les clients.') }}</p>
            <a href="{{ route('dashboard', ['tab' => 'profil']) }}"
                class="inline-flex items-center gap-1 bg-gray-900 hover:bg-black text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-all">
                {{ __('Modifier mon profil') }}
            </a>
        </div>
    @endunless
    <div class="bg-emerald-100 rounded-2xl p-4">
        <p class="text-sm font-bold text-gray-900">{{ __('Trouvez votre prochaine mission') }}</p>
        <p class="text-xs text-gray-600 mt-0.5 mb-3">{{ __('Explorez les opportunités du moment.') }}</p>
        <a href="{{ route('missions.index') }}"
            class="inline-flex items-center gap-1 bg-gray-900 hover:bg-black text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-all">
            {{ __('Explorer les missions') }}
        </a>
    </div>
    <div class="bg-amber-100 rounded-2xl p-4">
        <p class="text-sm font-bold text-gray-900">{{ __('Partagez votre travail') }}</p>
        <p class="text-xs text-gray-600 mt-0.5 mb-3">{{ __('Ajoutez un projet à votre portfolio.') }}</p>
        <a href="{{ $profilComplet ? route('projets.create') : route('dashboard', ['tab' => 'profil']) }}"
            class="inline-flex items-center gap-1 bg-gray-900 hover:bg-black text-white text-xs font-bold px-3 py-1.5 rounded-lg transition-all">
            {{ $profilComplet ? __('Ajouter un projet') : __('Compléter mon profil') }}
        </a>
    </div>
</div>

{{-- Statistiques réelles : uniquement une fois qu'il y a de l'activité à montrer --}}
@if ($aDesProjets)
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mt-6">
        @foreach ([
            ['label' => __('Projets publiés'), 'val' => count($projects)],
            ['label' => 'Builder Score', 'val' => number_format($creatif->builder_score ?? 0)],
            ['label' => __('Likes reçus'), 'val' => $totalLikes],
            ['label' => __('Commentaires'), 'val' => $totalComments],
            ['label' => __('Vues du profil'), 'val' => number_format($creatif->profile_views ?? 0)],
        ] as $stat)
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center">
                <div class="text-xl font-black text-gray-900">{{ $stat['val'] }}</div>
                <div class="text-[11px] text-gray-400 mt-0.5">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>
@endif

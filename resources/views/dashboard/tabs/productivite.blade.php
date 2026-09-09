{{--
    Onglet "Productivité" — anneau de progression du Builder Score et
    barème des points. Variables attendues :
    - $creatif        \App\Models\Creatif|null
    - $scorer         \App\Services\BuilderScoreService
    - $projects       Collection
    - $totalLikes     int
    - $totalComments  int
--}}
<div class="flex items-center justify-between mb-5">
    <div>
        <h2 class="text-lg font-black text-gray-900">{{ __('Productivité') }}</h2>
        <p class="text-xs text-gray-400 mt-0.5">{{ __('Votre activité détermine votre Builder Score et votre place dans le classement.') }}</p>
    </div>
    <a href="{{ route('classement.index') }}"
        class="text-xs font-semibold text-indigo-600 hover:underline whitespace-nowrap">
        {{ __('Voir le classement') }} →
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
                    <span class="text-[9px] text-gray-400 uppercase tracking-wider text-center leading-tight">{{ __('niveau') }}<br>{{ __('suivant') }}</span>
                </div>
            </div>
            <p class="mt-4 text-sm font-bold text-indigo-600">{{ $level['label'] }}</p>
            @if ($nextLevel)
                <p class="text-[11px] text-gray-400 mt-0.5">
                    {{ __(':points pts avant « :level »', ['points' => number_format(max(0, $nextLevel['min'] - ($creatif->builder_score ?? 0))), 'level' => $nextLevel['label']]) }}
                </p>
            @else
                <p class="text-[11px] text-gray-400 mt-0.5">{{ __('Niveau maximum atteint') }}</p>
            @endif
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 gap-4">
            @foreach ([
                ['label' => 'Builder Score', 'val' => number_format($creatif->builder_score ?? 0)],
                ['label' => __('Position sur Mefolio'), 'val' => __('Top :pct%', ['pct' => $topPct])],
                ['label' => __('Projets publiés'), 'val' => count($projects)],
                ['label' => __('Interactions reçues'), 'val' => $totalLikes + $totalComments],
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
        <h3 class="font-bold text-gray-900 mb-1">{{ __('Comment faire progresser votre score') }}</h3>
        <p class="text-xs text-gray-400 mb-4">{{ __('Chaque action sur Mefolio vous rapporte des points, qui déterminent votre niveau et votre rang dans le classement.') }}</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ([
                ['label' => __('Compléter son profil'), 'pts' => 30],
                ['label' => __('Publier un nouveau projet'), 'pts' => 20],
                ['label' => __('Terminer une mission'), 'pts' => 50],
                ['label' => __('Mettre à jour un projet'), 'pts' => 5],
                ['label' => __('Recevoir un commentaire'), 'pts' => 3],
                ['label' => __('Recevoir un like'), 'pts' => 1],
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
        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __("Créez d'abord votre profil créatif") }}</h3>
        <p class="text-sm text-gray-400 text-center max-w-xs mb-6">{{ __('Votre productivité et votre Builder Score se calculent à partir de votre activité de créatif.') }}</p>
        <a href="{{ route('creatifs.edit') }}"
            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full transition-all">
            {{ __('Compléter mon profil') }}
        </a>
    </div>
@endif

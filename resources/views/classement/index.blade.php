<x-app-layout>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <div class="text-center mb-12">
        <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">
            {{ __('Classement des') }}<br>
            <span class="text-indigo-600">{{ __('talents africains') }}</span>
        </h1>
        <p class="text-gray-500 text-sm max-w-lg mx-auto">
            {{ __('Les créatifs les plus actifs de la communauté Mefolio, classés par Builder Score.') }}
        </p>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-12">
        @foreach([
            ['val' => $creatifs->count(), 'label' => __('Talents classés')],
            ['val' => number_format($creatifs->sum('builder_score')), 'label' => __('Points totaux')],
            ['val' => $creatifs->where('available_for_work', true)->count(), 'label' => __('Disponibles')],
        ] as $s)
        <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center shadow-sm">
            <p class="text-2xl font-black text-gray-900">{{ $s['val'] }}</p>
            <p class="text-xs text-gray-400 mt-0.5">{{ $s['label'] }}</p>
        </div>
        @endforeach
    </div>

    @if($creatifs->count() >= 3)
    <div class="grid grid-cols-3 gap-3 mb-10 items-end">
        @foreach([1, 0, 2] as $pos)
        @php
            $c = $creatifs->get($pos);
            if (!$c) continue;
            $level = $scorer->getLevel($c);
            $ringColors = ['ring-yellow-400', 'ring-indigo-400', 'ring-orange-300'];
            $gradients = [
                'from-yellow-400 to-orange-400',
                'from-indigo-500 to-violet-500',
                'from-orange-400 to-amber-400',
            ];
            $heights = ['py-10', 'py-16', 'py-8'];
            $rank = $pos + 1;
        @endphp
        <div class="text-center">
            <div class="relative inline-block mb-3">
                <img src="{{ $c->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($c->prenom ?? 'M') . '&background=6366f1&color=fff&size=200' }}"
                    class="w-16 h-16 rounded-2xl object-cover mx-auto ring-4 {{ $ringColors[$pos] }} shadow-lg">
                <div class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-white shadow flex items-center justify-center text-[11px] font-black text-gray-700">
                    {{ $rank }}
                </div>
            </div>
            <div class="bg-gradient-to-b {{ $gradients[$pos] }} rounded-2xl {{ $heights[$pos] }} px-3 flex flex-col items-center justify-start pt-4">
                <p class="text-white font-black text-sm leading-tight">{{ $c->prenom }}</p>
                <p class="text-white/80 text-[10px]">{{ $c->specialite }}</p>
                <p class="text-white font-black text-lg mt-2">{{ number_format($c->builder_score ?? 0) }}</p>
                <p class="text-white/70 text-[10px]">{{ __('pts') }}</p>
                <p class="text-white text-[11px] font-bold mt-1">{{ $level['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 grid grid-cols-12 gap-4">
            <span class="col-span-1 text-[10px] font-black text-gray-400 uppercase tracking-wider">#</span>
            <span class="col-span-5 text-[10px] font-black text-gray-400 uppercase tracking-wider">{{ __('Talent') }}</span>
            <span class="col-span-3 text-[10px] font-black text-gray-400 uppercase tracking-wider">{{ __('Niveau') }}</span>
            <span class="col-span-2 text-[10px] font-black text-gray-400 uppercase tracking-wider text-right">{{ __('Score') }}</span>
            <span class="col-span-1"></span>
        </div>

        @forelse($creatifs as $i => $c)
        @php $level = $scorer->getLevel($c); @endphp
        <div class="px-6 py-4 grid grid-cols-12 gap-4 items-center {{ $i % 2 === 0 ? '' : 'bg-gray-50/40' }} hover:bg-indigo-50/30 transition-colors group border-b border-gray-50 last:border-0">

            <div class="col-span-1">
                <span class="text-sm font-black text-gray-300">{{ $i + 1 }}</span>
            </div>

            <div class="col-span-5 flex items-center gap-3 min-w-0">
                <img src="{{ $c->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($c->prenom ?? 'M') . '&background=6366f1&color=fff&size=64' }}"
                    class="w-10 h-10 rounded-xl object-cover flex-shrink-0">
                <div class="min-w-0">
                    <p class="font-bold text-gray-900 text-sm truncate">{{ $c->prenom }} {{ $c->nom }}</p>
                    <p class="text-[11px] text-gray-400 truncate">{{ $c->specialite }}</p>
                </div>
            </div>

            <div class="col-span-3">
                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                    {{ $level['label'] }}
                </span>
            </div>

            <div class="col-span-2 text-right">
                <p class="text-sm font-black text-gray-900">{{ number_format($c->builder_score ?? 0) }}</p>
                <p class="text-[10px] text-gray-400">pts</p>
            </div>

            <div class="col-span-1 flex items-center justify-end gap-1.5">
                @if($c->available_for_work)
                <span class="w-2 h-2 bg-green-500 rounded-full flex-shrink-0" title="{{ __('Disponible') }}"></span>
                @endif
                @if($c->slug)
                <a href="{{ route('creatifs.show', $c->slug) }}"
                    class="text-indigo-400 hover:text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
                @endif
            </div>

        </div>
        @empty
        <div class="text-center py-16 text-gray-400">
            <p class="text-sm font-medium">{{ __("Le classement sera disponible dès qu'un premier créatif rejoindra Mefolio.") }}</p>
        </div>
        @endforelse
    </div>

    <div class="mt-12 bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-10 text-center text-white">
        <h2 class="text-2xl font-black mb-2">{{ __('Rejoignez le classement') }}</h2>
        <p class="text-indigo-200 text-sm mb-6 max-w-md mx-auto">
            {{ __('Créez votre profil, publiez vos projets et montez dans le classement des meilleurs talents africains.') }}
        </p>
        @guest
        <a href="{{ route('register') }}"
            class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
            {{ __('Créer mon profil gratuit') }} →
        </a>
        @else
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
            {{ __('Mon tableau de bord') }} →
        </a>
        @endguest
    </div>

</div>
</x-app-layout>

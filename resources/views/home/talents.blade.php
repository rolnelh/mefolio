{{--
    Section "Nos talents créatifs" : cartes de profil façon réseau social,
    en alternant deux styles :
      - sombre : photo arrondie en haut, texte blanc, bouton contour ;
      - clair : photo plein cadre, texte posé sur un voile blanc flouté,
        bouton blanc.
    Chaque carte affiche nom, spécialité, extrait de bio, nombre de projets
    et Builder Score, et mène au profil du créatif.

    Variables attendues : $creatifs (Collection, injectée par
    HomeController, avec projects_count via withCount).
--}}
@php
    $initiales = fn ($c) => strtoupper(mb_substr($c->prenom ?: ($c->nom ?: '?'), 0, 1));
@endphp

<section class="bg-white py-20 md:py-28 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight leading-tight">
                    <span class="text-gray-900">{{ __('Nos talents') }}</span>
                    <span class="text-gray-400">{{ __('créatifs') }}</span>
                </h2>
                <p class="mt-3 max-w-md text-gray-500">
                    {{ __("L'élite de notre communauté. Des esprits audacieux qui repoussent les limites du possible.") }}
                </p>
            </div>
            <a href="{{ route('creatifs.index') }}"
                class="inline-flex items-center gap-2 self-start md:self-auto rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 ring-1 ring-gray-900/10 hover:ring-gray-900/25 transition">
                {{ __("Voir tout l'écosystème") }} <span aria-hidden="true">→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($creatifs as $i => $creatif)
                @php
                    $nomComplet = trim($creatif->prenom . ' ' . $creatif->nom);
                    $sombre = $i % 2 === 0;
                    $profil = route('creatifs.show', $creatif->slug);
                    $stats = [
                        ['valeur' => $creatif->projects_count ?? 0, 'libelle' => __('projets'), 'icone' => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-19.5 0v6a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25v-6m-19.5 0h19.5'],
                        ['valeur' => $creatif->builder_score ?? 0, 'libelle' => 'Builder Score', 'icone' => 'M11.48 3.5a.56.56 0 011.04 0l2.13 5.11 5.52.44c.5.04.7.66.32.99l-4.2 3.6 1.28 5.38a.56.56 0 01-.84.61L12 16.73l-4.73 2.9a.56.56 0 01-.84-.61l1.28-5.38-4.2-3.6a.56.56 0 01.32-.99l5.52-.44 2.13-5.11z'],
                    ];
                @endphp

                @if ($sombre)
                    {{-- Style sombre --}}
                    <a href="{{ $profil }}" class="group flex flex-col rounded-[26px] bg-gray-900 p-3 ring-1 ring-white/10 shadow-xl shadow-gray-900/20 transition-transform duration-300 hover:-translate-y-1">
                        <span class="block aspect-[4/3.6] overflow-hidden rounded-[18px] bg-gray-800">
                            @if ($creatif->photo)
                                <img src="{{ $creatif->photo }}" alt="{{ $nomComplet }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-500 to-violet-600 text-5xl font-bold text-white">{{ $initiales($creatif) }}</span>
                            @endif
                        </span>
                        <span class="flex flex-1 flex-col px-2 pt-4 pb-1">
                            <span class="text-lg font-semibold text-white">{{ $nomComplet ?: __('Créatif') }}</span>
                            <span class="mt-1 line-clamp-2 text-xs leading-relaxed text-gray-400">
                                {{ $creatif->specialite ?: __('Créatif') }}@if ($creatif->bio) · {{ \Illuminate\Support\Str::limit($creatif->bio, 70) }}@endif
                            </span>
                            <span class="mt-auto flex items-center justify-between gap-3 pt-4">
                                <span class="flex items-center gap-3 text-xs text-gray-300">
                                    @foreach ($stats as $stat)
                                        <span class="inline-flex items-center gap-1" title="{{ $stat['libelle'] }}">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icone'] }}" /></svg>
                                            {{ $stat['valeur'] }}
                                        </span>
                                    @endforeach
                                </span>
                                <span class="rounded-full px-4 py-2 text-xs font-semibold text-white ring-1 ring-white/25 transition-colors group-hover:bg-white group-hover:text-gray-900">{{ __('Voir le profil') }} +</span>
                            </span>
                        </span>
                    </a>
                @else
                    {{-- Style clair --}}
                    <a href="{{ $profil }}" class="group relative flex min-h-[360px] flex-col justify-end overflow-hidden rounded-[26px] bg-gray-100 ring-1 ring-gray-900/10 shadow-xl shadow-gray-900/10 transition-transform duration-300 hover:-translate-y-1">
                        @if ($creatif->photo)
                            <img src="{{ $creatif->photo }}" alt="{{ $nomComplet }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <span class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-amber-200 to-rose-300 pb-24 text-6xl font-bold text-white">{{ $initiales($creatif) }}</span>
                        @endif
                        <span class="absolute inset-x-0 bottom-0 h-[58%] bg-gradient-to-t from-white via-white/85 to-transparent backdrop-blur-[2px] [mask-image:linear-gradient(to_top,#000_60%,transparent)]"></span>
                        <span class="relative flex flex-col px-5 pb-4">
                            <span class="text-lg font-semibold text-gray-900">{{ $nomComplet ?: __('Créatif') }}</span>
                            <span class="mt-1 line-clamp-2 text-xs leading-relaxed text-gray-600">
                                {{ $creatif->specialite ?: __('Créatif') }}@if ($creatif->bio) · {{ \Illuminate\Support\Str::limit($creatif->bio, 70) }}@endif
                            </span>
                            <span class="flex items-center justify-between gap-3 pt-4">
                                <span class="flex items-center gap-3 text-xs text-gray-700">
                                    @foreach ($stats as $stat)
                                        <span class="inline-flex items-center gap-1" title="{{ $stat['libelle'] }}">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icone'] }}" /></svg>
                                            {{ $stat['valeur'] }}
                                        </span>
                                    @endforeach
                                </span>
                                <span class="rounded-full bg-white px-4 py-2 text-xs font-semibold text-gray-900 shadow-md ring-1 ring-gray-900/5 transition-colors group-hover:bg-gray-900 group-hover:text-white">{{ __('Voir le profil') }} +</span>
                            </span>
                        </span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</section>

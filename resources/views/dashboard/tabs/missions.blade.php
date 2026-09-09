{{--
    Onglet "Mes missions" — candidatures envoyées + missions publiées.
    Variables attendues : $appliedMissions, $postedMissions (Collections).
--}}
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
            <h2 class="text-lg font-black text-gray-900">{{ __('Mes missions') }}</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ __('Vos candidatures envoyées et les missions que vous avez publiées.') }}</p>
        </div>
        <a href="{{ route('missions.create') }}"
            class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all whitespace-nowrap">
            {{ __('Publier une mission') }}
        </a>
    </div>

    {{-- Mes candidatures --}}
    <div>
        <h3 class="text-sm font-black text-gray-900 mb-4">
            {{ __('Mes candidatures (:count)', ['count' => $appliedMissions->count()]) }}
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
                                {{ ['pending' => __('En attente'), 'accepted' => __('Acceptée'), 'rejected' => __('Refusée')][$application->status] }}
                            </span>
                        </div>
                        <p class="font-bold text-gray-900 text-sm leading-snug mb-1">
                            {{ $mission->title ?? __('Mission supprimée') }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $mission?->user?->username ?? '-' }} ·
                            {{ __('envoyée :time', ['time' => $application->created_at->diffForHumans()]) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-sm text-gray-400">{{ __("Vous n'avez postulé à aucune mission pour le moment.") }}</p>
                <a href="{{ route('missions.index') }}"
                    class="inline-block mt-2 text-indigo-600 font-semibold text-xs hover:underline">
                    {{ __('Parcourir les missions') }} →
                </a>
            </div>
        @endif
    </div>

    {{-- Mes missions publiées --}}
    <div>
        <h3 class="text-sm font-black text-gray-900 mb-4">
            {{ __('Mes missions publiées (:count)', ['count' => $postedMissions->count()]) }}
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
                                {{ ['open' => __('Ouverte'), 'in_progress' => __('En cours'), 'completed' => __('Terminée'), 'cancelled' => __('Annulée')][$mission->status] ?? $mission->status }}
                            </span>
                        </div>
                        <p class="font-bold text-gray-900 text-sm leading-snug mb-1">{{ $mission->title }}</p>
                        <p class="text-xs text-gray-500">
                            {{ trans_choice(':count candidature|:count candidatures', $mission->applications_count, ['count' => $mission->applications_count]) }}
                        </p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-sm text-gray-400">{{ __("Vous n'avez publié aucune mission pour le moment.") }}</p>
                <a href="{{ route('missions.create') }}"
                    class="inline-block mt-2 text-indigo-600 font-semibold text-xs hover:underline">
                    {{ __('Publier une mission') }} →
                </a>
            </div>
        @endif
    </div>
</div>

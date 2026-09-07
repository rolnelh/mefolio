<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-black text-gray-900">Mes missions</h1>
                <p class="text-sm text-gray-500 mt-1">Missions publiées et candidatures envoyées.</p>
            </div>
            <a href="{{ route('missions.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-colors">
                Publier une mission
            </a>
        </div>

        <div class="mb-12">
            <h2 class="text-lg font-black text-gray-900 mb-4">Mes publications ({{ $posted->count() }})</h2>
            <div class="space-y-3">
                @forelse ($posted as $mission)
                    <a href="{{ route('missions.show', $mission) }}"
                        class="flex items-center justify-between bg-white border border-gray-100 rounded-2xl px-6 py-4 hover:shadow-md transition-all">
                        <div>
                            <p class="font-bold text-gray-900 text-sm">{{ $mission->title }}</p>
                            <p class="text-xs text-gray-400">{{ $mission->applications_count }} candidature(s)</p>
                        </div>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $mission->status === 'open' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                            {{ ['open' => 'Ouverte', 'in_progress' => 'En cours', 'completed' => 'Terminée', 'cancelled' => 'Annulée'][$mission->status] ?? $mission->status }}
                        </span>
                    </a>
                @empty
                    <p class="text-sm text-gray-400">Vous n'avez publié aucune mission pour le moment.</p>
                @endforelse
            </div>
        </div>

        <div>
            <h2 class="text-lg font-black text-gray-900 mb-4">Mes candidatures ({{ $applied->count() }})</h2>
            <div class="space-y-3">
                @forelse ($applied as $application)
                    <a href="{{ route('missions.show', $application->mission) }}"
                        class="flex items-center justify-between bg-white border border-gray-100 rounded-2xl px-6 py-4 hover:shadow-md transition-all">
                        <div>
                            <p class="font-bold text-gray-900 text-sm">{{ $application->mission->title ?? 'Mission supprimée' }}</p>
                            <p class="text-xs text-gray-400">Envoyée {{ $application->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ match($application->status) { 'accepted' => 'bg-green-50 text-green-600', 'rejected' => 'bg-red-50 text-red-600', default => 'bg-amber-50 text-amber-600' } }}">
                            {{ ['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Refusée'][$application->status] }}
                        </span>
                    </a>
                @empty
                    <p class="text-sm text-gray-400">Vous n'avez postulé à aucune mission pour le moment.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>

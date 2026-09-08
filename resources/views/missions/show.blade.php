<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <a href="{{ route('missions.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Toutes les missions
        </a>

        <div class="bg-white border border-gray-100 rounded-3xl p-8 md:p-10">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="text-xs font-bold text-indigo-500 uppercase tracking-wide">{{ $mission->domaine }}</span>
                @if ($mission->urgent)
                    <span class="text-[10px] bg-red-50 text-red-600 border border-red-100 font-bold px-2 py-0.5 rounded-full uppercase tracking-wide">Urgent</span>
                @endif
                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $mission->status === 'open' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                    {{ ['open' => 'Ouverte', 'in_progress' => 'En cours', 'completed' => 'Terminée', 'cancelled' => 'Annulée'][$mission->status] ?? $mission->status }}
                </span>
            </div>

            <h1 class="text-3xl font-black text-gray-900 mb-4">{{ $mission->title }}</h1>

            <div class="flex flex-wrap gap-6 text-sm text-gray-500 mb-8 pb-8 border-b border-gray-100">
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400">Budget</p>
                    <p class="font-bold text-gray-900">
                        @if ($mission->budget_min || $mission->budget_max)
                            {{ number_format($mission->budget_min ?? $mission->budget_max) }}
                            @if ($mission->budget_max && $mission->budget_min && $mission->budget_max != $mission->budget_min)
                                – {{ number_format($mission->budget_max) }}
                            @endif
                            FCFA
                        @else
                            À négocier
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400">Durée</p>
                    <p class="font-bold text-gray-900">{{ $mission->duree ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400">Lieu</p>
                    <p class="font-bold text-gray-900">{{ $mission->lieu ?: ($mission->remote ? 'Remote' : '-') }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400">Niveau</p>
                    <p class="font-bold text-gray-900">{{ $mission->niveau ?: '-' }}</p>
                </div>
            </div>

            <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed mb-8">
                {!! nl2br(e($mission->description)) !!}
            </div>

            @if (!empty($mission->tags))
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach ($mission->tags as $tag)
                        <span class="text-xs bg-gray-50 text-gray-600 font-medium px-3 py-1 rounded-full border border-gray-100">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif

            <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-sm font-black text-indigo-600">
                    {{ substr($mission->user->username ?? '?', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">{{ $mission->user->username ?? '-' }}</p>
                    <p class="text-xs text-gray-400">Publié {{ $mission->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        {{-- Candidature --}}
        @auth
            @if ($mission->user_id === auth()->id())
                <div class="mt-8 bg-white border border-gray-100 rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-gray-900">Candidatures reçues ({{ $mission->applications->count() }})</h2>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('missions.edit', $mission) }}" class="text-sm font-semibold text-gray-500 hover:text-indigo-600">Modifier</a>
                            <form method="POST" action="{{ route('missions.destroy', $mission) }}" onsubmit="return confirm('Supprimer cette mission ?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm font-semibold text-red-500 hover:text-red-700">Supprimer</button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse ($mission->applications as $application)
                            <div class="border border-gray-100 rounded-2xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="font-bold text-gray-900 text-sm">
                                        {{ $application->user->creatif->prenom ?? $application->user->username }}
                                        {{ $application->user->creatif->nom ?? '' }}
                                    </p>
                                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ match($application->status) { 'accepted' => 'bg-green-50 text-green-600', 'rejected' => 'bg-red-50 text-red-600', default => 'bg-amber-50 text-amber-600' } }}">
                                        {{ ['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Refusée'][$application->status] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">{{ $application->message }}</p>
                                @if ($application->status === 'pending')
                                    <div class="flex items-center gap-3">
                                        <form method="POST" action="{{ route('missions.applications.update', [$mission, $application]) }}">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="accepted">
                                            <button class="text-xs font-semibold text-green-600 hover:text-green-800">Accepter</button>
                                        </form>
                                        <form method="POST" action="{{ route('missions.applications.update', [$mission, $application]) }}">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="text-xs font-semibold text-red-500 hover:text-red-700">Refuser</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-400">Aucune candidature reçue pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            @elseif ($mission->status === 'open')
                <div class="mt-8 bg-white border border-gray-100 rounded-3xl p-8">
                    <h2 class="text-lg font-black text-gray-900 mb-4">
                        {{ $userApplication ? 'Votre candidature' : 'Postuler à cette mission' }}
                    </h2>
                    @if ($userApplication)
                        <p class="text-sm text-gray-600 mb-2">{{ $userApplication->message }}</p>
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ match($userApplication->status) { 'accepted' => 'bg-green-50 text-green-600', 'rejected' => 'bg-red-50 text-red-600', default => 'bg-amber-50 text-amber-600' } }}">
                            {{ ['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Refusée'][$userApplication->status] }}
                        </span>
                    @else
                        <form method="POST" action="{{ route('missions.apply', $mission) }}">
                            @csrf
                            <textarea name="message" rows="4" required placeholder="Présentez-vous et expliquez pourquoi vous êtes fait(e) pour cette mission..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4"></textarea>
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-6 py-2.5 rounded-xl transition-colors">
                                Envoyer ma candidature
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        @else
            <div class="mt-8 bg-gray-50 border border-gray-100 rounded-3xl p-8 text-center">
                <p class="text-sm text-gray-500 mb-4">Connectez-vous pour postuler à cette mission.</p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-bold px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">
                    Se connecter
                </a>
            </div>
        @endauth

    </div>
</x-app-layout>

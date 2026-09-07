<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <a href="{{ route('challenges.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Tous les challenges
        </a>

        <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden">
            @if ($challenge->image)
                <img src="{{ $challenge->image }}" class="w-full h-64 object-cover">
            @endif
            <div class="p-8 md:p-10">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $challenge->status === 'open' ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                        {{ $challenge->status === 'open' ? 'Ouvert' : 'Fermé' }}
                    </span>
                    @if ($challenge->category)
                        <span class="text-xs font-bold text-indigo-500">{{ $challenge->category }}</span>
                    @endif
                </div>

                <h1 class="text-3xl font-black text-gray-900 mb-6">{{ $challenge->title }}</h1>

                <div class="flex flex-wrap gap-6 text-sm mb-8 pb-8 border-b border-gray-100">
                    @if ($challenge->sponsor)
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Sponsor</p>
                            <p class="font-bold text-gray-900">{{ $challenge->sponsor }}</p>
                        </div>
                    @endif
                    @if ($challenge->prize)
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Récompense</p>
                            <p class="font-bold text-gray-900">{{ $challenge->prize }}</p>
                        </div>
                    @endif
                    @if ($challenge->deadline)
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Date limite</p>
                            <p class="font-bold text-gray-900">{{ $challenge->deadline->format('d/m/Y') }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400">Participants</p>
                        <p class="font-bold text-gray-900">{{ $challenge->participants->count() }}</p>
                    </div>
                </div>

                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($challenge->description)) !!}
                </div>
            </div>
        </div>

        @auth
            @if ($challenge->status === 'open')
                <div class="mt-8 bg-white border border-gray-100 rounded-3xl p-8">
                    <h2 class="text-lg font-black text-gray-900 mb-4">
                        {{ $userParticipation ? 'Votre participation' : 'Participer à ce challenge' }}
                    </h2>
                    @if ($userParticipation)
                        <p class="text-sm text-gray-600 mb-2">{{ $userParticipation->submission_note }}</p>
                        @if ($userParticipation->submission_url)
                            <a href="{{ $userParticipation->submission_url }}" target="_blank" class="text-sm text-indigo-600 hover:underline">
                                Voir la soumission
                            </a>
                        @endif
                    @else
                        <form method="POST" action="{{ route('challenges.participate', $challenge) }}" class="space-y-4">
                            @csrf
                            <textarea name="submission_note" rows="4" required placeholder="Décrivez votre participation..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                            <input type="url" name="submission_url" placeholder="Lien vers votre travail (optionnel)"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-6 py-2.5 rounded-xl transition-colors">
                                Envoyer ma participation
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        @else
            <div class="mt-8 bg-gray-50 border border-gray-100 rounded-3xl p-8 text-center">
                <p class="text-sm text-gray-500 mb-4">Connectez-vous pour participer à ce challenge.</p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-bold px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition-colors">
                    Se connecter
                </a>
            </div>
        @endauth

    </div>
</x-app-layout>

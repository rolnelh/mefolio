<x-app-layout>
    <div class="max-w-3xl mx-auto py-32 px-4 text-center">

        {{-- Emoji --}}
        <div class="inline-flex items-center justify-center w-24 h-24 bg-indigo-50 rounded-3xl mb-8 text-5xl">
            {{ $emoji }}
        </div>

        {{-- Badge --}}
        <div
            class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-600 font-semibold px-4 py-1.5 rounded-full text-sm mb-6">
            <span class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></span>
            En cours de développement
        </div>

        <h1 class="text-4xl font-black text-gray-900 mb-4">{{ $page }}</h1>
        <p class="text-lg text-gray-500 max-w-xl mx-auto mb-12 leading-relaxed">
            {{ $description }}
        </p>

        {{-- Newsletter --}}
        <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-8 text-white mb-8">
            <h2 class="text-xl font-bold mb-2">Soyez notifié en premier</h2>
            <p class="text-indigo-200 text-sm mb-6">Laissez votre email pour être alerté dès le lancement.</p>
            <div class="flex gap-3 max-w-sm mx-auto">
                <input type="email" placeholder="votre@email.com"
                    class="flex-1 px-4 py-3 rounded-xl text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-white">
                <button
                    class="bg-white text-indigo-600 font-bold px-5 py-3 rounded-xl hover:bg-indigo-50 transition whitespace-nowrap">
                    M'alerter
                </button>
            </div>
        </div>

        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
            ← Retour à l'accueil
        </a>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <span
                class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-600 font-semibold px-4 py-1.5 rounded-full text-sm mb-4">
                <span class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></span>
                Bientôt disponible
            </span>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Missions Freelance</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                Trouvez des missions, proposez vos services, soyez rémunérés via Mobile Money.
                La marketplace des talents africains arrive très bientôt.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

            @foreach ([
        ['titre' => 'Création d\'une identité visuelle', 'budget' => '150.000 FCFA', 'domaine' => 'Design', 'lieu' => 'Cotonou, Bénin', 'emoji' => '🎨', 'duree' => '2 semaines', 'niveau' => 'Intermédiaire'],
        ['titre' => 'Développement d\'une landing page', 'budget' => '200.000 FCFA', 'domaine' => 'Développement Web', 'lieu' => 'Remote', 'emoji' => '💻', 'duree' => '1 semaine', 'niveau' => 'Junior'],
        ['titre' => 'Shooting photo produits cosmétiques', 'budget' => '80.000 FCFA', 'domaine' => 'Photographie', 'lieu' => 'Abidjan, CI', 'emoji' => '📸', 'duree' => '3 jours', 'niveau' => 'Tous niveaux'],
        ['titre' => 'Montage vidéo promotionnel', 'budget' => '120.000 FCFA', 'domaine' => 'Vidéo', 'lieu' => 'Remote', 'emoji' => '🎥', 'duree' => '1 semaine', 'niveau' => 'Intermédiaire'],
        ['titre' => 'Création de contenu réseaux sociaux', 'budget' => '60.000 FCFA', 'domaine' => 'Marketing Digital', 'lieu' => 'Remote', 'emoji' => '📱', 'duree' => '1 mois', 'niveau' => 'Junior'],
        ['titre' => 'Application mobile de livraison', 'budget' => '500.000 FCFA', 'domaine' => 'Développement Mobile', 'lieu' => 'Dakar, SN', 'emoji' => '📲', 'duree' => '2 mois', 'niveau' => 'Senior'],
    ] as $mission)
                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-6 relative overflow-hidden">
                    {{-- Badge coming soon --}}
                    <div
                        class="absolute top-3 right-3 bg-amber-50 text-amber-600 text-xs font-semibold px-2 py-1 rounded-full">
                        Bientôt
                    </div>

                    <div class="flex items-start gap-4 mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-2xl flex-shrink-0">
                            {{ $mission['emoji'] }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-base leading-snug">{{ $mission['titre'] }}</h3>
                            <span class="text-xs text-indigo-600 font-semibold">{{ $mission['domaine'] }}</span>
                        </div>
                    </div>

                    <div class="space-y-2 mb-5">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            {{ $mission['lieu'] }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ $mission['duree'] }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-1.342" />
                            </svg>
                            {{ $mission['niveau'] }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                        <span class="text-lg font-bold text-gray-900">{{ $mission['budget'] }}</span>
                        <button disabled
                            class="bg-gray-100 text-gray-400 text-sm font-semibold px-4 py-2 rounded-xl cursor-not-allowed">
                            Postuler bientôt
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-indigo-600 rounded-3xl p-10 text-center text-white">
            <h2 class="text-2xl font-bold mb-2">Soyez notifié en premier</h2>
            <p class="text-indigo-200 mb-6">Inscrivez-vous pour recevoir les premières missions dès le lancement.</p>
            <div class="flex gap-3 max-w-md mx-auto">
                <input type="email" placeholder="votre@email.com"
                    class="flex-1 px-4 py-3 rounded-xl text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-white">
                <button class="bg-white text-indigo-600 font-bold px-6 py-3 rounded-xl hover:bg-indigo-50 transition">
                    M'alerter
                </button>
            </div>
        </div>
    </div>
</x-app-layout>

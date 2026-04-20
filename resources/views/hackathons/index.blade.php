<x-app-layout>

    {{-- HERO --}}
    <section class="relative bg-[#050810] py-24 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-[20%] right-0 w-[50%] h-[60%] rounded-full bg-orange-600/10 blur-[120px]"></div>
            <div class="absolute bottom-0 -left-[10%] w-[40%] h-[50%] rounded-full bg-indigo-600/10 blur-[100px]"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div
                class="inline-flex items-center gap-2 bg-orange-500/10 border border-orange-500/20 text-orange-400 text-xs font-bold px-4 py-1.5 rounded-full mb-8 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse"></span>
                Hub des opportunités africaines
            </div>
            <h1 class="text-5xl sm:text-7xl font-black text-white tracking-tight leading-none mb-6">
                Programmes &<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400">
                    Hackathons
                </span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Tous les grands programmes africains centralisés sur Mefolio.
                <span class="text-white font-semibold">ASSIN, Sèmè City, SENUM</span> et plus —
                candidatez directement depuis votre profil.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">

        {{-- Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-20">
            @foreach ([['num' => '20+', 'label' => 'Programmes référencés', 'emoji' => '🏛️'], ['num' => '8', 'label' => 'Pays couverts', 'emoji' => '🌍'], ['num' => '500M+', 'label' => 'FCFA de dotations', 'emoji' => '💰'], ['num' => '0 FCFA', 'label' => 'Pour candidater', 'emoji' => '🆓']] as $stat)
                <div class="bg-gray-50 rounded-2xl p-6 text-center">
                    <div class="text-2xl mb-2">{{ $stat['emoji'] }}</div>
                    <div class="text-2xl font-black text-gray-900">{{ $stat['num'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        {{-- Programmes vedettes --}}
        <div class="mb-20">
            <div class="mb-10">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-orange-500 mb-2">À la une</p>
                <h2 class="text-3xl font-black text-gray-900">Programmes phares</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- ASSIN --}}
                <div
                    class="relative bg-gradient-to-br from-green-900 to-emerald-800 rounded-3xl p-8 text-white overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-48 h-48 bg-green-500/10 rounded-full -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-2xl">
                                🇧🇯</div>
                            <div>
                                <p class="text-xs text-green-300 font-bold uppercase tracking-wider">Bénin · Annuel</p>
                                <h3 class="text-xl font-black">ASSIN</h3>
                            </div>
                            <span
                                class="ml-auto text-xs bg-amber-400/20 text-amber-300 border border-amber-400/30 font-semibold px-2.5 py-1 rounded-full">Bientôt</span>
                        </div>
                        <p class="text-green-100 text-sm leading-relaxed mb-6">
                            L'Agence du Service Civique National de l'Innovation (ASSIN) accompagne les jeunes
                            entrepreneurs béninois à travers des programmes d'incubation, de financement et de formation
                            pour transformer leurs idées en startups viables.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach (['Entrepreneuriat', 'Innovation', 'Tech', 'Financement', 'Incubation'] as $tag)
                                <span
                                    class="text-xs bg-white/10 text-green-200 px-2.5 py-1 rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/10">
                            <div>
                                <p class="text-xs text-green-300">Cible</p>
                                <p class="text-sm font-bold">18–35 ans</p>
                            </div>
                            <div>
                                <p class="text-xs text-green-300">Durée</p>
                                <p class="text-sm font-bold">6–12 mois</p>
                            </div>
                            <div>
                                <p class="text-xs text-green-300">Pays</p>
                                <p class="text-sm font-bold">🇧🇯 Bénin</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sèmè City --}}
                <div
                    class="relative bg-gradient-to-br from-blue-900 to-indigo-800 rounded-3xl p-8 text-white overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-48 h-48 bg-blue-500/10 rounded-full -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-2xl">🏙️
                            </div>
                            <div>
                                <p class="text-xs text-blue-300 font-bold uppercase tracking-wider">Bénin · Continu</p>
                                <h3 class="text-xl font-black">Sèmè City</h3>
                            </div>
                            <span
                                class="ml-auto text-xs bg-amber-400/20 text-amber-300 border border-amber-400/30 font-semibold px-2.5 py-1 rounded-full">Bientôt</span>
                        </div>
                        <p class="text-blue-100 text-sm leading-relaxed mb-6">
                            Cité de l'innovation et du savoir du Bénin, Sèmè City est un écosystème unique qui réunit
                            créateurs, chercheurs et entrepreneurs africains pour co-construire l'avenir du continent à
                            travers des résidences, labs et programmes d'accélération.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach (['Innovation', 'Résidence', 'Créativité', 'Recherche', 'Africa'] as $tag)
                                <span
                                    class="text-xs bg-white/10 text-blue-200 px-2.5 py-1 rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/10">
                            <div>
                                <p class="text-xs text-blue-300">Cible</p>
                                <p class="text-sm font-bold">Tous profils</p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-300">Format</p>
                                <p class="text-sm font-bold">Résidence</p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-300">Pays</p>
                                <p class="text-sm font-bold">🇧🇯 Bénin</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Tous les programmes --}}
        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black text-gray-900">Tous les programmes</h2>
                <span
                    class="text-xs bg-amber-50 text-amber-600 font-semibold px-3 py-1.5 rounded-full border border-amber-100">Données
                    de référence</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ([
        ['nom' => 'SENUM', 'full' => 'Semaine du Numérique', 'pays' => '🇧🇯', 'type' => 'Événement annuel', 'desc' => 'La grande semaine nationale dédiée au numérique au Bénin — conférences, hackathons, expositions tech.', 'tags' => ['Numérique', 'Tech', 'Hackathon'], 'color' => 'from-purple-50 to-violet-50', 'border' => 'border-purple-100'],
        ['nom' => 'Talents4Startup', 'full' => 'From Bénin to the World', 'pays' => '🇧🇯', 'type' => 'Programme d\'accélération', 'desc' => 'Programme d\'accompagnement des jeunes entrepreneurs béninois vers les marchés internationaux.', 'tags' => ['Startup', 'Mentoring', 'International'], 'color' => 'from-indigo-50 to-blue-50', 'border' => 'border-indigo-100'],
        ['nom' => 'Tony Elumelu', 'full' => 'TEF Entrepreneurship', 'pays' => '🌍', 'type' => 'Financement panafricain', 'desc' => 'Le plus grand programme philanthropique dédié aux entrepreneurs africains — 5 000$ de seed funding.', 'tags' => ['Financement', 'Pan-africain', '5000$'], 'color' => 'from-orange-50 to-amber-50', 'border' => 'border-orange-100'],
        ['nom' => 'Orange Fab', 'full' => 'Orange Digital Center', 'pays' => '🌍', 'type' => 'Accélérateur', 'desc' => 'Programme d\'accélération pour startups tech en Afrique subsaharienne avec accompagnement Orange.', 'tags' => ['Tech', 'Accélération', 'Mobile'], 'color' => 'from-orange-50 to-yellow-50', 'border' => 'border-yellow-100'],
        ['nom' => 'CTIC Dakar', 'full' => 'Centre TIC Sénégal', 'pays' => '🇸🇳', 'type' => 'Incubateur', 'desc' => 'Premier incubateur de startups numériques en Afrique de l\'Ouest, basé à Dakar.', 'tags' => ['Sénégal', 'Incubation', 'West Africa'], 'color' => 'from-green-50 to-teal-50', 'border' => 'border-green-100'],
        ['nom' => 'iHub Nairobi', 'full' => 'Innovation Hub', 'pays' => '🇰🇪', 'type' => 'Hub tech', 'desc' => 'Le hub technologique le plus influent d\'Afrique de l\'Est, berceau de nombreuses startups continent.', 'tags' => ['Kenya', 'Hub', 'East Africa'], 'color' => 'from-red-50 to-pink-50', 'border' => 'border-red-100'],
    ] as $prog)
                    <div
                        class="bg-gradient-to-br {{ $prog['color'] }} border {{ $prog['border'] }} rounded-2xl p-6 hover:shadow-md transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-lg">{{ $prog['pays'] }}</span>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-gray-400">{{ $prog['type'] }}</span>
                                </div>
                                <h3 class="text-lg font-black text-gray-900">{{ $prog['nom'] }}</h3>
                                <p class="text-xs text-gray-500">{{ $prog['full'] }}</p>
                            </div>
                            <span
                                class="text-[10px] bg-amber-100 text-amber-600 font-semibold px-2 py-1 rounded-full whitespace-nowrap">Bientôt</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed mb-4">{{ $prog['desc'] }}</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($prog['tags'] as $tag)
                                <span
                                    class="text-[11px] bg-white/70 text-gray-600 font-medium px-2 py-0.5 rounded-full border border-white">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Proposer un programme --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-20">
            <div class="bg-gradient-to-br from-indigo-600 to-violet-600 rounded-3xl p-8 text-white">
                <div class="text-3xl mb-4">🔔</div>
                <h3 class="text-xl font-black mb-2">Soyez alerté</h3>
                <p class="text-indigo-200 text-sm mb-6">Recevez une notification dès qu'un programme correspond à votre
                    profil.</p>
                <div class="flex gap-2">
                    <input type="email" placeholder="votre@email.com"
                        class="flex-1 px-4 py-2.5 rounded-xl text-gray-900 text-sm focus:outline-none">
                    <button
                        class="bg-white text-indigo-600 font-bold px-4 py-2.5 rounded-xl hover:bg-indigo-50 transition whitespace-nowrap text-sm">
                        M'alerter
                    </button>
                </div>
            </div>
            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-8">
                <div class="text-3xl mb-4">📢</div>
                <h3 class="text-xl font-black text-gray-900 mb-2">Vous organisez un programme ?</h3>
                <p class="text-gray-500 text-sm mb-6">Référencez votre hackathon, concours ou programme d'accélération
                    sur Mefolio et touchez des milliers de talents africains.</p>
                <a href="mailto:contact@mefolio.com"
                    class="inline-flex items-center gap-2 bg-gray-900 text-white text-sm font-bold px-6 py-2.5 rounded-xl hover:bg-indigo-600 transition-all">
                    Nous contacter →
                </a>
            </div>
        </div>

    </div>
</x-app-layout>

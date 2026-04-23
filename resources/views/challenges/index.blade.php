<x-app-layout>

    {{-- HERO --}}
    {{-- <section class="relative bg-[#050810] py-20 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[50%] h-[60%] rounded-full bg-yellow-500/10 blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-[40%] h-[50%] rounded-full bg-indigo-600/10 blur-[100px]"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            
            <h1 class="text-5xl sm:text-6xl font-black text-white tracking-tight leading-none mb-6">
                Prouvez votre<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-400">
                    talent. ⚡
                </span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Participez à des défis créatifs sponsorisés, gagnez des prix et faites reconnaître vos compétences par les meilleures entreprises africaines.
            </p>
        </div>
    </section> --}}

    <section class="relative bg-[#050810] py-20 overflow-hidden">

        {{-- Background glow --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[50%] h-[60%] rounded-full bg-yellow-500/10 blur-[120px]"></div>
            <div class="absolute bottom-0 left-0 w-[40%] h-[50%] rounded-full bg-indigo-600/10 blur-[100px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                {{-- LEFT CONTENT --}}
                <div class="text-center lg:text-left">

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-relaxed mb-6">
                        Prouvez votre<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-400">
                            talent. ⚡
                        </span>
                    </h1>

                    <p class="text-lg text-gray-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Participez à des défis créatifs sponsorisés, gagnez des prix et faites reconnaître vos
                        compétences par les meilleures entreprises africaines.
                    </p>

                </div>

                {{-- RIGHT IMAGE --}}
                <div class="flex justify-center lg:justify-end">
                    <img src="{{ asset('/images/challenges.webp') }}" alt="Challenges Mefolio"
                        class="w-full max-w-lg rounded-xl shadow-2xl">
                </div>

            </div>

        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        {{-- Stats --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
            @foreach ([['val' => '12', 'label' => 'Challenges actifs', 'emoji' => '⚡'], ['val' => '2.5M FCFA', 'label' => 'En dotations', 'emoji' => '💰'], ['val' => '350+', 'label' => 'Participants', 'emoji' => '👥'], ['val' => '8', 'label' => 'Sponsors', 'emoji' => '🏢']] as $s)
                <div class="bg-white border border-gray-100 rounded-2xl p-5 text-center hover:shadow-md transition-all">
                    <div class="text-2xl mb-2">{{ $s['emoji'] }}</div>
                    <p class="text-2xl font-black text-gray-900">{{ $s['val'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $s['label'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Challenge vedette --}}
        <div
            class="bg-gradient-to-br from-yellow-900 via-orange-900 to-red-900 rounded-3xl p-8 md:p-12 mb-12 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full -translate-y-1/2 translate-x-1/2">
            </div>
            <div class="relative z-10">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span
                        class="text-xs bg-yellow-400/20 border border-yellow-400/30 text-yellow-300 font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        🔥 Challenge vedette
                    </span>
                    <span
                        class="text-xs bg-red-400/20 border border-red-400/30 text-red-300 font-bold px-3 py-1 rounded-full">
                        ⏰ 12 jours restants
                    </span>
                    <span class="text-xs bg-white/10 text-white/80 font-bold px-3 py-1 rounded-full">
                        Bientôt disponible
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                    Design the Future of Africa 🌍
                </h2>
                <p class="text-orange-200 leading-relaxed mb-6 max-w-2xl">
                    Créez une identité visuelle futuriste qui représente l'Afrique de 2030. Logo, palette, typographie —
                    montrez votre vision du continent de demain. Sponsorisé par Sèmè City.
                </p>
                <div class="flex flex-wrap gap-6 mb-8">
                    <div>
                        <p class="text-orange-400 text-xs font-bold uppercase tracking-wider">1er Prix</p>
                        <p class="text-white text-2xl font-black">500 000 FCFA</p>
                    </div>
                    <div>
                        <p class="text-orange-400 text-xs font-bold uppercase tracking-wider">2ème Prix</p>
                        <p class="text-white text-2xl font-black">200 000 FCFA</p>
                    </div>
                    <div>
                        <p class="text-orange-400 text-xs font-bold uppercase tracking-wider">Participants</p>
                        <p class="text-white text-2xl font-black">47</p>
                    </div>
                    <div>
                        <p class="text-orange-400 text-xs font-bold uppercase tracking-wider">Domaine</p>
                        <p class="text-white text-2xl font-black">🎨 Design</p>
                    </div>
                </div>
                <button disabled
                    class="inline-flex items-center gap-2 bg-white/20 text-white/60 font-bold px-8 py-3 rounded-full cursor-not-allowed text-sm border border-white/20">
                    Participer bientôt →
                </button>
            </div>
        </div>

        {{-- Grille challenges --}}
        <div class="mb-8">
            <h2 class="text-2xl font-black text-gray-900 mb-6">Tous les challenges</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ([
        ['titre' => 'Logo pour une startup fintech africaine', 'domaine' => 'Design', 'emoji' => '🎨', 'prix' => '150 000 FCFA', 'duree' => '7 jours', 'participants' => 23, 'sponsor' => 'FinTechBJ', 'niveau' => 'Tous niveaux', 'color' => 'from-indigo-50 to-blue-50', 'border' => 'border-indigo-100'],
        ['titre' => 'Développer une app de covoiturage MVP', 'domaine' => 'Dev Mobile', 'emoji' => '💻', 'prix' => '300 000 FCFA', 'duree' => '21 jours', 'participants' => 8, 'sponsor' => 'MobilityAfrica', 'niveau' => 'Senior', 'color' => 'from-violet-50 to-purple-50', 'border' => 'border-violet-100'],
        ['titre' => 'Campagne photo "Artisans d\'Afrique"', 'domaine' => 'Photographie', 'emoji' => '📸', 'prix' => '100 000 FCFA', 'duree' => '14 jours', 'participants' => 31, 'sponsor' => 'CultureBénin', 'niveau' => 'Intermédiaire', 'color' => 'from-orange-50 to-amber-50', 'border' => 'border-orange-100'],
        ['titre' => 'Motion design intro YouTube Afrique', 'domaine' => 'Vidéo', 'emoji' => '🎥', 'prix' => '80 000 FCFA', 'duree' => '10 jours', 'participants' => 15, 'sponsor' => 'AfriMedia', 'niveau' => 'Intermédiaire', 'color' => 'from-red-50 to-pink-50', 'border' => 'border-red-100'],
        ['titre' => 'Rédiger 5 articles tech pour blog africain', 'domaine' => 'Rédaction', 'emoji' => '✍️', 'prix' => '60 000 FCFA', 'duree' => '7 jours', 'participants' => 19, 'sponsor' => 'TechAfrik', 'niveau' => 'Tous niveaux', 'color' => 'from-green-50 to-teal-50', 'border' => 'border-green-100'],
        ['titre' => 'Jingle audio pour startup béninoise', 'domaine' => 'Audio', 'emoji' => '🎵', 'prix' => '75 000 FCFA', 'duree' => '5 jours', 'participants' => 11, 'sponsor' => 'SoundBJ', 'niveau' => 'Junior', 'color' => 'from-cyan-50 to-sky-50', 'border' => 'border-cyan-100'],
    ] as $c)
                    <div
                        class="bg-gradient-to-br {{ $c['color'] }} border {{ $c['border'] }} rounded-2xl p-6 hover:shadow-md transition-all group">
                        <div class="flex items-start justify-between mb-4">
                            <div
                                class="w-11 h-11 bg-white rounded-xl flex items-center justify-center text-2xl shadow-sm">
                                {{ $c['emoji'] }}
                            </div>
                            <span
                                class="text-[10px] bg-white/80 text-gray-500 font-semibold px-2 py-1 rounded-full border border-white">
                                ⏰ {{ $c['duree'] }}
                            </span>
                        </div>
                        <h3
                            class="font-bold text-gray-900 text-sm leading-snug mb-2 group-hover:text-indigo-600 transition-colors">
                            {{ $c['titre'] }}
                        </h3>
                        <p class="text-xs text-indigo-600 font-semibold mb-3">{{ $c['domaine'] }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500 mb-4">
                            <span>🎓 {{ $c['niveau'] }}</span>
                            <span>👥 {{ $c['participants'] }} participants</span>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-white/50">
                            <div>
                                <p class="text-[10px] text-gray-400">Sponsor : {{ $c['sponsor'] }}</p>
                                <p class="text-base font-black text-gray-900">{{ $c['prix'] }}</p>
                            </div>
                            <button disabled
                                class="text-xs bg-white/60 text-gray-400 font-bold px-4 py-2 rounded-xl cursor-not-allowed border border-white">
                                Bientôt
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-3xl p-10 text-center text-white">
            <h2 class="text-2xl font-black mb-2">🏆 Proposez un challenge</h2>
            <p class="text-yellow-100 mb-6 max-w-lg mx-auto">Vous êtes une entreprise ou une organisation ? Sponsorisez
                un challenge et trouvez les meilleurs talents africains.</p>
            <a href="mailto:contact@mefolio.com?subject=Sponsoriser un challenge Mefolio"
                class="inline-flex items-center gap-2 bg-white text-orange-600 font-bold px-8 py-3 rounded-full hover:bg-orange-50 transition-all hover:scale-105">
                Nous contacter →
            </a>
        </div>

    </div>
</x-app-layout>

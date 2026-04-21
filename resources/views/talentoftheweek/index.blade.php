<x-app-layout>
    <section class="relative bg-white py-8 lg:py-12 overflow-hidden min-h-[70vh] flex items-center">
        <div class="absolute inset-0 z-0 opacity-[0.02]"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-[10%] right-[5%] w-[40%] h-[50%] rounded-full bg-orange-50/50 blur-[100px]"></div>
            <div class="absolute bottom-0 left-[5%] w-[30%] h-[40%] rounded-full bg-indigo-50/40 blur-[80px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div class="text-left order-2 lg:order-1">
                    {{-- <div
                        class="inline-flex items-center gap-2 bg-orange-50 border border-orange-100 text-orange-600 text-[10px] font-black px-4 py-1.5 rounded-full mb-6 uppercase tracking-[0.2em]">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                        Hub des opportunités africaines
                    </div> --}}

                    <h1
                        class="text-5xl sm:text-5xl lg:text-7xl font-black text-slate-900 tracking-tight leading-[0.95] mb-6">
                        Talent &<br>
                        <span class="text-orange-500">of the Week 🏆</span>
                    </h1>

                    <p class="text-lg text-slate-500 max-w-xl leading-relaxed mb-8">
                        Chaque semaine, Mefolio met en lumière un talent africain exceptionnel. Découvrez,
                        inspirez-vous,
                        connectez-vous.
                    </p>

                    <div class="flex flex-wrap gap-4">

                        <a href="#explorer"
                            class="px-6 py-3 bg-orange-500 text-white text-sm font-bold rounded-full hover:bg-orange-600 transition-all">
                            Participer au programme →
                        </a>
                    </div>
                </div>

                <div class="relative order-1 lg:order-2 lg:-mt-16">
                    <div class="absolute -inset-2 rounded-[2.5rem] rotate-1"></div>

                    <div class="relative p-2 overflow-hidden">
                        <img src="{{ asset('images/talentoftheweek.png') }}" alt="Programmes et Hackathons Afrique"
                            class="w-full h-auto rounded-[1.8rem] object-cover">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <div class="max-w-6xl mx-auto px-6 lg:px-8 py-16">

        <div
            class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-100 rounded-3xl p-8 md:p-12 mb-16">
            <div class="flex flex-col md:flex-row gap-8 items-center">
                <div class="relative flex-shrink-0">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/048/216/761/small/modern-male-avatar-with-black-hair-and-hoodie-illustration-free-png.png"
                        class="w-40 h-40 rounded-3xl object-cover shadow-2xl ring-4 ring-yellow-200">
                    <div
                        class="absolute -top-3 -right-3 w-10 h-10 bg-yellow-400 rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="text-lg">🏆</span>
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <div
                        class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full mb-4">
                        ⭐ Talent of the Week — Semaine 01
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 mb-1">Dieudonné Houndagnon</h2>
                    <p class="text-indigo-600 font-semibold mb-3">UI/UX Designer · Graphic Artist</p>
                    <p class="text-sm text-gray-500 mb-2 flex items-center justify-center md:justify-start gap-1">
                        📍 Cotonou, Bénin
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-6 max-w-lg">
                        Dieudonné est une designer béninois de 24 ans qui transforme les interfaces numériques en
                        expériences culturellement riches. Son travail mêle typographie africaine, couleurs terracotta
                        et design system moderne. En 2 ans, elle a collaboré avec 15 startups west-africaines.
                    </p>
                    <div class="flex flex-wrap gap-2 justify-center md:justify-start mb-6">
                        @foreach (['UI/UX Design', 'Branding', 'Figma', 'Illustration', 'Motion'] as $skill)
                            <span
                                class="text-xs bg-white border border-yellow-200 text-gray-700 font-semibold px-3 py-1 rounded-full">{{ $skill }}</span>
                        @endforeach
                    </div>
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <a href="#"
                            class="px-6 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-full hover:bg-indigo-600 transition-all">
                            Voir son profil →
                        </a>
                        <a href="#"
                            class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-full hover:border-indigo-300 transition-all">
                            Ses projets
                        </a>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-yellow-100">
                @foreach ([['val' => '47', 'label' => 'Projets publiés'], ['val' => '2.3k', 'label' => 'Vues ce mois'], ['val' => '98%', 'label' => 'Satisfaction clients']] as $s)
                    <div class="text-center">
                        <p class="text-2xl font-black text-gray-900">{{ $s['val'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $s['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Anciens talents --}}
        <div class="mb-16">
            <h2 class="text-2xl font-black text-gray-900 mb-8">Hall of Fame 🌟</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ([
        ['nom' => 'Kofi Asante', 'spec' => 'Photographe', 'pays' => '🇬🇭', 'ville' => 'Accra', 'semaine' => 'Semaine 16', 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face'],
        ['nom' => 'Fatou Diallo', 'spec' => 'Développeuse Full-Stack', 'pays' => '🇸🇳', 'ville' => 'Dakar', 'semaine' => 'Semaine 15', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=200&h=200&fit=crop&crop=face'],
        ['nom' => 'Emeka Obi', 'spec' => 'Motion Designer', 'pays' => '🇳🇬', 'ville' => 'Lagos', 'semaine' => 'Semaine 14', 'img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop&crop=face'],
        ['nom' => 'Nia Mensah', 'spec' => 'Illustratrice', 'pays' => '🇨🇮', 'ville' => 'Abidjan', 'semaine' => 'Semaine 13', 'img' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop&crop=face'],
        ['nom' => 'Diallo Traoré', 'spec' => 'Architecte 3D', 'pays' => '🇲🇱', 'ville' => 'Bamako', 'semaine' => 'Semaine 12', 'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop&crop=face'],
        ['nom' => 'Adjoa Koffi', 'spec' => 'Brand Designer', 'pays' => '🇧🇯', 'ville' => 'Cotonou', 'semaine' => 'Semaine 11', 'img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=200&h=200&fit=crop&crop=face'],
    ] as $t)
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <img src="{{ $t['img'] }}" class="w-14 h-14 rounded-2xl object-cover flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-400 mb-0.5">{{ $t['semaine'] }}</p>
                                <h3 class="font-bold text-gray-900 truncate">{{ $t['nom'] }} {{ $t['pays'] }}
                                </h3>
                                <p class="text-xs text-indigo-600 font-semibold">{{ $t['spec'] }}</p>
                                <p class="text-xs text-gray-400">📍 {{ $t['ville'] }}</p>
                            </div>
                            <div class="text-yellow-400 text-xl">🏆</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Nominer --}}
        <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-10 text-center text-white">
            <div class="text-3xl mb-4">🌍</div>
            <h2 class="text-2xl font-black mb-2">Nominé un talent africain</h2>
            <p class="text-indigo-200 mb-6 max-w-lg mx-auto">Vous connaissez un créatif africain exceptionnel ?
                Nominé-le pour le Talent of the Week et aidez-le à briller.</p>
            <a href="mailto:contact@mefolio.com?subject=Nomination Talent of the Week"
                class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
                Nominer un talent →
            </a>
        </div>

    </div>
</x-app-layout>

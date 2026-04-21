<x-app-layout>

    {{-- HERO --}}
    <section class="relative bg-[#050810] py-28 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[60%] h-[70%] rounded-full bg-indigo-600/10 blur-[150px]"></div>
            <div class="absolute bottom-0 left-0 w-[40%] h-[50%] rounded-full bg-violet-600/10 blur-[100px]"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div
                class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold px-4 py-1.5 rounded-full mb-8 uppercase tracking-widest">
                🚧 Mefolio 2.0 — Currently Building the African Talent Ecosystem
            </div>
            <h1 class="text-5xl sm:text-7xl font-black text-white tracking-tight leading-[1.05] mb-8">
                Vision<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">
                    Africa 2030
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Construire l'infrastructure digitale qui révèle, connecte et propulse les talents africains vers les
                opportunités mondiales.
            </p>
        </div>
    </section>

    <div class="max-w-5xl mx-auto px-6 lg:px-8 py-20 space-y-20">

        {{-- Le problème --}}
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-500 mb-3">Le constat</p>
            <h2 class="text-3xl font-black text-gray-900 mb-8">L'Afrique regorge de talents.<br>Ils restent invisibles.
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ([['num' => '300M+', 'label' => 'Jeunes africains 18-35 ans', 'desc' => 'Le continent le plus jeune du monde, avec une créativité explosive.', 'color' => 'red'], ['num' => '72%', 'label' => 'Sans visibilité digitale', 'desc' => 'La majorité des créatifs africains n\'ont aucune présence professionnelle en ligne.', 'color' => 'orange'], ['num' => '0', 'label' => 'Plateforme dédiée', 'desc' => 'Aucune plateforme africaine pensée pour valoriser ces talents à l\'échelle mondiale.', 'color' => 'red']] as $p)
                    <div class="bg-{{ $p['color'] }}-50 border border-{{ $p['color'] }}-100 rounded-2xl p-6">
                        <p class="text-4xl font-black text-{{ $p['color'] }}-600 mb-2">{{ $p['num'] }}</p>
                        <p class="font-bold text-gray-900 mb-2">{{ $p['label'] }}</p>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $p['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Mission --}}
        <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-3xl p-10 md:p-14 text-white">
            <p class="text-indigo-300 text-xs font-bold uppercase tracking-widest mb-4">Notre Mission</p>
            <h2 class="text-3xl md:text-4xl font-black mb-6 leading-tight">
                "Révéler, connecter et propulser les talents africains vers les opportunités qu'ils méritent."
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 pt-8 border-t border-white/10">
                @foreach ([['emoji' => '🔍', 'titre' => 'Révéler', 'desc' => 'Donner une vitrine professionnelle à chaque créatif africain.'], ['emoji' => '🤝', 'titre' => 'Connecter', 'desc' => 'Relier les talents aux recruteurs, startups et entreprises locales et internationales.'], ['emoji' => '🚀', 'titre' => 'Propulser', 'desc' => 'Offrir les outils pour monétiser, grandir et s\'exporter.']] as $m)
                    <div>
                        <div class="text-3xl mb-3">{{ $m['emoji'] }}</div>
                        <h3 class="font-bold text-lg mb-2">{{ $m['titre'] }}</h3>
                        <p class="text-indigo-200 text-sm leading-relaxed">{{ $m['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pourquoi maintenant --}}
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-3">Pourquoi maintenant</p>
            <h2 class="text-3xl font-black text-gray-900 mb-8">Le moment est parfait.</h2>
            <div class="space-y-4">
                @foreach ([['num' => '01', 'titre' => 'La jeunesse africaine est en ligne', 'desc' => 'Avec 600M d\'utilisateurs internet d\'ici 2025, l\'Afrique connaît la plus forte croissance digitale mondiale. Les talents y sont, les outils manquent.'], ['num' => '02', 'titre' => 'Mobile Money révolutionne les paiements', 'desc' => 'MTN, Moov, Wave — les paiements mobiles explosent en Afrique. Les freelancers peuvent enfin être rémunérés facilement, sans PayPal ni Stripe.'], ['num' => '03', 'titre' => 'Les recruteurs cherchent des talents africains', 'desc' => 'De plus en plus d\'entreprises mondiales tournent leur regard vers l\'Afrique pour recruter. La demande existe. L\'infrastructure de découverte manque.'], ['num' => '04', 'titre' => 'Les écosystèmes startup africains maturent', 'desc' => 'ASSIN, Sèmè City, OrangeDigitalCenter, Tony Elumelu — des programmes sérieux émergent partout. Mefolio peut devenir le hub qui les centralise.']] as $r)
                    <div class="flex gap-6 p-6 bg-gray-50 rounded-2xl hover:bg-indigo-50 transition-all group">
                        <span
                            class="text-3xl font-black text-indigo-200 group-hover:text-indigo-400 transition-colors flex-shrink-0">{{ $r['num'] }}</span>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2">{{ $r['titre'] }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $r['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Histoire personnelle --}}
        <div class="bg-white border border-gray-100 rounded-3xl p-10 md:p-14 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-4">Le fondateur</p>
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="flex-shrink-0">
                    <div
                        class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110 group-hover:bg-green-100">
                        <img src="{{ asset('images/profil.webp') }}" alt="Paiements" class="w-full h-full rounded-lg object-contain">
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-gray-900 mb-1">Dieudonné Houndagnon</h2>
                    <p class="text-indigo-600 font-semibold mb-6">Fondateur & CEO — Mefolio · Cotonou, Bénin 🇧🇯</p>
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                        <p>
                            J'ai grandi à Cotonou en voyant autour de moi des talents incroyables — des designers, des
                            développeurs, des photographes — qui produisaient un travail remarquable mais restaient
                            invisibles au-delà de leur quartier.
                        </p>
                        <p>
                            Moi-même développeur, j'ai vécu cette frustration : comment présenter mon travail
                            professionnellement ? Comment être trouvé par des recruteurs ? Comment être payé pour mes
                            missions sans avoir de compte PayPal ou Stripe ?
                        </p>
                        <p>
                            Mefolio est né de cette frustration. Ce n'est pas juste un portfolio en ligne. C'est une
                            infrastructure qui manquait à toute une génération de créatifs africains.
                        </p>
                        <p class="font-semibold text-gray-900">
                            "Si tu as le talent, Mefolio te donne la scène."
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Roadmap 2030 --}}
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-3">La feuille de route</p>
            <h2 class="text-3xl font-black text-gray-900 mb-8">Vision Africa 2030</h2>
            <div class="relative">
                <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-indigo-100"></div>
                <div class="space-y-6">
                    @foreach ([['date' => '2026', 'titre' => 'Phase Pilote — Bénin', 'desc' => 'Lancement MVP, 1 000 premiers talents béninois, intégration Mobile Money.', 'status' => 'En cours', 'color' => 'indigo'], ['date' => '2027', 'titre' => 'Expansion Afrique de l\'Ouest', 'desc' => 'Sénégal, Côte d\'Ivoire, Mali, Ghana — 50 000 talents actifs.', 'status' => 'Planifié', 'color' => 'violet'], ['date' => '2028', 'titre' => 'Afrique Francophone', 'desc' => 'Marketplace services, système premium, partenariats universités.', 'status' => 'Vision', 'color' => 'blue'], ['date' => '2030', 'titre' => 'Continent & International', 'desc' => '1 million de talents africains sur Mefolio. 5M$ de transactions générées pour les créatifs.', 'status' => 'Ambition', 'color' => 'green']] as $r)
                        <div class="flex gap-6 pl-12 relative">
                            <div
                                class="absolute left-4 top-3 w-4 h-4 rounded-full bg-{{ $r['color'] }}-500 border-4 border-white shadow">
                            </div>
                            <div class="flex-1 bg-gray-50 rounded-2xl p-5 hover:shadow-md transition-all">
                                <div class="flex items-center gap-3 mb-2">
                                    <span
                                        class="text-lg font-black text-{{ $r['color'] }}-600">{{ $r['date'] }}</span>
                                    <span
                                        class="text-xs bg-{{ $r['color'] }}-100 text-{{ $r['color'] }}-700 font-semibold px-2 py-0.5 rounded-full">{{ $r['status'] }}</span>
                                </div>
                                <h3 class="font-bold text-gray-900 mb-1">{{ $r['titre'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $r['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="bg-[#050810] rounded-3xl p-12 text-center text-white">
            <div class="text-4xl mb-4">🌍</div>
            <h2 class="text-3xl font-black mb-4">Rejoignez le mouvement</h2>
            <p class="text-gray-400 mb-8 max-w-lg mx-auto">Mefolio ne construit pas juste une plateforme. Nous
                construisons l'avenir du talent africain. Et vous pouvez en faire partie dès maintenant.</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-full transition-all hover:scale-105">
                    Créer mon profil →
                </a>
                <a href="mailto:contact@mefolio.com"
                    class="px-8 py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-full transition-all border border-white/20">
                    Nous contacter
                </a>
            </div>
        </div>

    </div>
</x-app-layout>

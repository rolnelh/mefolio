<x-app-layout>

    <section class="relative bg-[#050810] py-24 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-violet-600/10 blur-[120px]">
            </div>
            <div class="absolute -bottom-[10%] -left-[10%] w-[50%] h-[50%] rounded-full bg-indigo-600/10 blur-[100px]">
            </div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <div
                class="inline-flex items-center gap-2 bg-violet-500/10 border border-violet-500/20 text-violet-400 text-xs font-bold px-4 py-1.5 rounded-full mb-8 uppercase tracking-widest">
                <span class="w-1.5 h-1.5 bg-violet-400 rounded-full animate-pulse"></span>
                Bientôt disponible
            </div>
            <h1 class="text-5xl sm:text-7xl font-black text-white tracking-tight leading-none mb-6">
                Le marché des<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-indigo-400">
                    services créatifs
                </span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Commandez des services créatifs directement aux meilleurs talents africains.
                Logo, site web, vidéo, photo — payez en <span class="text-white font-semibold">Mobile Money.</span>
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">

        <div class="text-center mb-16">
            <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-3">Ce qui arrive</p>
            <h2 class="text-3xl font-black text-gray-900">Les catégories de services</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-20">
            @foreach ([['emoji' => '🎨', 'titre' => 'Design & Identité', 'desc' => 'Logo, charte graphique, branding'], ['emoji' => '💻', 'titre' => 'Développement Web', 'desc' => 'Sites, apps, landing pages'], ['emoji' => '📸', 'titre' => 'Photographie', 'desc' => 'Portrait, produit, événement'], ['emoji' => '🎥', 'titre' => 'Vidéo & Montage', 'desc' => 'Publicité, reels, motion'], ['emoji' => '✍️', 'titre' => 'Rédaction', 'desc' => 'Contenu, copywriting, SEO'], ['emoji' => '📱', 'titre' => 'Réseaux Sociaux', 'desc' => 'Gestion, stratégie, contenu'], ['emoji' => '🎵', 'titre' => 'Audio & Musique', 'desc' => 'Jingle, podcast, mixage'], ['emoji' => '🖨️', 'titre' => 'Print & Affiches', 'desc' => 'Flyers, kakémono, packaging']] as $cat)
                <div
                    class="group bg-white border border-gray-100 rounded-2xl p-5 hover:border-indigo-200 hover:shadow-lg transition-all cursor-default">
                    <div class="text-3xl mb-3">{{ $cat['emoji'] }}</div>
                    <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $cat['titre'] }}</h3>
                    <p class="text-xs text-gray-400">{{ $cat['desc'] }}</p>
                    <span
                        class="inline-block mt-3 text-[10px] bg-amber-50 text-amber-600 font-semibold px-2 py-0.5 rounded-full">Bientôt</span>
                </div>
            @endforeach
        </div>

        <div class="bg-gray-50 rounded-3xl p-10 mb-20">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-black text-gray-900">Comment ça va fonctionner</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach ([['num' => '01', 'titre' => 'Trouvez un talent', 'desc' => 'Parcourez les profils et sélectionnez le créatif qui correspond à votre besoin.', 'emoji' => '🔍'], ['num' => '02', 'titre' => 'Commandez', 'desc' => 'Définissez votre projet, vos délais et votre budget directement sur la plateforme.', 'emoji' => '📋'], ['num' => '03', 'titre' => 'Collaborez', 'desc' => 'Échangez, suivez l\'avancement et donnez vos retours en temps réel.', 'emoji' => '💬'], ['num' => '04', 'titre' => 'Payez en Mobile Money', 'desc' => 'Réglez en toute sécurité via MTN, Moov, Wave ou tout autre moyen local.', 'emoji' => '📲']] as $step)
                    <div class="text-center">
                        <div class="text-3xl mb-3">{{ $step['emoji'] }}</div>
                        <div class="text-xs font-black text-indigo-500 mb-2 tracking-widest">{{ $step['num'] }}</div>
                        <h3 class="font-bold text-gray-900 mb-2">{{ $step['titre'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black text-gray-900">Aperçu des services à venir</h2>
                <span
                    class="text-xs bg-amber-50 text-amber-600 font-semibold px-3 py-1.5 rounded-full border border-amber-100">Données
                    de démo</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
        ['titre' => 'Création de logo professionnel', 'cat' => 'Design', 'prix' => 'À partir de 25 000 FCFA', 'delai' => '3 jours', 'note' => '4.9', 'emoji' => '🎨', 'vendeur' => 'Kofi A.', 'pays' => '🇧🇯'],
        ['titre' => 'Site vitrine moderne & responsive', 'cat' => 'Dev Web', 'prix' => 'À partir de 80 000 FCFA', 'delai' => '7 jours', 'note' => '5.0', 'emoji' => '💻', 'vendeur' => 'Ama K.', 'pays' => '🇨🇮'],
        ['titre' => 'Shooting photo produits', 'cat' => 'Photo', 'prix' => 'À partir de 30 000 FCFA', 'delai' => '2 jours', 'note' => '4.8', 'emoji' => '📸', 'vendeur' => 'Moussa D.', 'pays' => '🇸🇳'],
        ['titre' => 'Montage vidéo publicitaire', 'cat' => 'Vidéo', 'prix' => 'À partir de 40 000 FCFA', 'delai' => '5 jours', 'note' => '4.7', 'emoji' => '🎥', 'vendeur' => 'Fatou B.', 'pays' => '🇲🇱'],
        ['titre' => 'Gestion réseaux sociaux 1 mois', 'cat' => 'Social Media', 'prix' => 'À partir de 50 000 FCFA', 'delai' => '30 jours', 'note' => '4.9', 'emoji' => '📱', 'vendeur' => 'Yemi O.', 'pays' => '🇳🇬'],
        ['titre' => 'Charte graphique complète', 'cat' => 'Branding', 'prix' => 'À partir de 60 000 FCFA', 'delai' => '5 jours', 'note' => '5.0', 'emoji' => '🖌️', 'vendeur' => 'Adjoa M.', 'pays' => '🇬🇭'],
    ] as $service)
                    <div
                        class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all group">
                        <div
                            class="h-40 bg-gradient-to-br from-indigo-50 to-violet-50 flex items-center justify-center text-6xl relative">
                            {{ $service['emoji'] }}
                            <span
                                class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-widest text-indigo-500 bg-indigo-50 border border-indigo-100 px-2 py-1 rounded-lg">{{ $service['cat'] }}</span>
                            <span
                                class="absolute top-3 right-3 text-xs bg-amber-50 text-amber-600 font-semibold px-2 py-1 rounded-lg border border-amber-100">Bientôt</span>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 mb-3 leading-snug">{{ $service['titre'] }}</h3>
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-600">
                                    {{ substr($service['vendeur'], 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-600 font-medium">{{ $service['vendeur'] }}
                                    {{ $service['pays'] }}</span>
                                <span class="ml-auto text-xs text-amber-500 font-bold">⭐ {{ $service['note'] }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div>
                                    <p class="text-xs text-gray-400">Délai : {{ $service['delai'] }}</p>
                                    <p class="text-sm font-bold text-gray-900 mt-0.5">{{ $service['prix'] }}</p>
                                </div>
                                <button disabled
                                    class="bg-gray-100 text-gray-400 text-xs font-bold px-4 py-2 rounded-xl cursor-not-allowed">
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-gradient-to-r from-violet-600 to-indigo-600 rounded-3xl p-10 text-center text-white">
            <h2 class="text-2xl font-black mb-2">Tu es un talent créatif ?</h2>
            <p class="text-violet-200 mb-6 max-w-lg mx-auto">Inscris-toi maintenant et sois parmi les premiers à
                proposer tes services sur Mefolio dès le lancement.</p>
            <a href="{{ route('register') }}"
                class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105 shadow-lg">
                Créer mon profil gratuitement →
            </a>
        </div>

    </div>
</x-app-layout>

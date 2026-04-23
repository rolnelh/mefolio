<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-3">Mefolio Blog</p>
                <h1 class="text-4xl sm:text-5xl font-black text-gray-900 leading-none">
                    Actualités &
                    <span class="text-indigo-600">Inspiration.</span>
                </h1>
            </div>
            <p class="text-sm text-gray-700 max-w-xs leading-relaxed">
                Ressources, conseils et histoires pour les créatifs africains qui construisent leur avenir.
            </p>
        </div>

        {{-- Catégories --}}
        <div class="flex flex-wrap gap-2 mb-10">
            @foreach (['Tous', 'Design', 'Développement', 'Freelance', 'Opportunités', 'Inspiration', 'Outils', 'Africa Tech'] as $cat)
                <button
                    class="{{ $cat === 'Tous' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-indigo-300' }} px-4 py-2 rounded-full text-sm font-semibold transition-all">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        {{-- Article vedette --}}
        <div class="group relative bg-[#050810] rounded-3xl overflow-hidden mb-12 cursor-pointer">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1200&auto=format&fit=crop"
                alt="Article vedette"
                class="w-full h-80 object-cover opacity-50 group-hover:opacity-40 transition-opacity duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-xs bg-indigo-600 text-white font-bold px-3 py-1 rounded-full">🔥 À la une</span>
                    <span class="text-xs text-gray-300">Africa Tech · 5 min de lecture</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-black text-white mb-3 leading-tight">
                    Comment les créatifs africains conquièrent le marché mondial du freelance en 2026
                </h2>
                <p class="text-gray-300 text-sm mb-4 max-w-2xl line-clamp-2">
                    Une nouvelle génération de designers, développeurs et créateurs africains s'impose sur les
                    plateformes mondiales. Découvrez leurs stratégies et comment Mefolio joue un rôle clé dans cette
                    révolution.
                </p>
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-black">
                        M</div>
                    <span class="text-gray-300 text-xs">Équipe Mefolio · 21 Avril 2026</span>
                </div>
            </div>
        </div>

        {{-- Grille articles --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-16">
            @foreach ([
        ['titre' => '10 outils gratuits indispensables pour les designers africains', 'cat' => 'Design', 'emoji' => '🎨', 'temps' => '4 min', 'date' => '19 Avr 2026', 'auteur' => 'Adjoa K.', 'img' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&auto=format&fit=crop'],
        ['titre' => 'Comment fixer son tarif freelance quand on débute en Afrique', 'cat' => 'Freelance', 'emoji' => '💰', 'temps' => '6 min', 'date' => '17 Avr 2026', 'auteur' => 'Kofi A.', 'img' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=600&auto=format&fit=crop'],
        ['titre' => 'ASSIN 2026 : comment postuler et maximiser vos chances', 'cat' => 'Opportunités', 'emoji' => '🚀', 'temps' => '5 min', 'date' => '15 Avr 2026', 'auteur' => 'Équipe Mefolio', 'img' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&auto=format&fit=crop'],
        ['titre' => 'Next.js vs Laravel : quel stack pour votre prochain projet web africain ?', 'cat' => 'Développement', 'emoji' => '💻', 'temps' => '8 min', 'date' => '12 Avr 2026', 'auteur' => 'Dieudonné H.', 'img' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&auto=format&fit=crop'],
        ['titre' => '5 photographes africains qui inspirent la nouvelle génération', 'cat' => 'Inspiration', 'emoji' => '📸', 'temps' => '3 min', 'date' => '10 Avr 2026', 'auteur' => 'Fatou D.', 'img' => 'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=600&auto=format&fit=crop'],
        ['titre' => 'Mobile Money & freelance : le guide complet pour se faire payer en Afrique', 'cat' => 'Freelance', 'emoji' => '📱', 'temps' => '7 min', 'date' => '8 Avr 2026', 'auteur' => 'Équipe Mefolio', 'img' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600&auto=format&fit=crop'],
    ] as $article)
                <article
                    class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 cursor-pointer">
                    <div class="overflow-hidden" style="height: 190px;">
                        <img src="{{ $article['img'] }}" alt="{{ $article['titre'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span
                                class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">{{ $article['emoji'] }}
                                {{ $article['cat'] }}</span>
                            <span class="text-gray-200">·</span>
                            <span class="text-[11px] text-gray-400">{{ $article['temps'] }} de lecture</span>
                        </div>
                        <h3
                            class="font-bold text-gray-900 leading-snug mb-3 group-hover:text-indigo-600 transition-colors text-sm">
                            {{ $article['titre'] }}
                        </h3>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-black text-indigo-600">
                                    {{ substr($article['auteur'], 0, 1) }}
                                </div>
                                <span class="text-[11px] text-gray-500 font-medium">{{ $article['auteur'] }}</span>
                            </div>
                            <span class="text-[11px] text-gray-400">{{ $article['date'] }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Newsletter --}}
        <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-10 text-center text-white">
            <div class="text-3xl mb-4">📬</div>
            <h2 class="text-2xl font-black mb-2">Newsletter Mefolio</h2>
            <p class="text-indigo-200 mb-6 max-w-lg mx-auto text-sm">Recevez chaque semaine les meilleurs articles,
                opportunités et actualités du monde créatif africain.</p>
            <div class="flex gap-3 max-w-sm mx-auto">
                <input type="email" placeholder="votre@email.com"
                    class="flex-1 px-4 py-3 rounded-xl text-gray-900 text-sm focus:outline-none">
                <button
                    class="bg-white text-indigo-600 font-bold px-5 py-3 rounded-xl hover:bg-indigo-50 transition whitespace-nowrap text-sm">
                    S'abonner
                </button>
            </div>
        </div>

    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        {{-- HERO --}}
        <section class="relative bg-[#050810] py-20 overflow-hidden rounded-2xl">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-indigo-600/10 blur-[120px]">
                </div>
                <div
                    class="absolute -bottom-[10%] -left-[10%] w-[50%] h-[50%] rounded-full bg-violet-600/10 blur-[100px]">
                </div>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
                <div
                    class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold px-4 py-1.5 rounded-full mb-8 uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-pulse"></span>
                    Bientôt disponible
                </div>
                <h1 class="text-5xl sm:text-6xl font-black text-white tracking-tight leading-none mb-6">
                    Missions<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">
                        Freelance
                    </span>
                </h1>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                    Trouvez des missions, proposez vos services, soyez rémunérés via
                    <span class="text-white font-semibold">Mobile Money.</span>
                </p>

                {{-- Barre de recherche principale --}}
                <div class="mt-10 flex gap-3 max-w-2xl mx-auto">
                    <div class="flex-1 relative">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Ex: développeur web, designer logo..."
                            class="w-full pl-11 pr-4 py-3.5 bg-white/10 border border-white/20 text-white placeholder:text-gray-500 rounded-2xl text-sm focus:outline-none focus:border-indigo-400 focus:bg-white/15 transition-all">
                    </div>
                    <button
                        class="px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl transition-all hover:scale-105 text-sm">
                        Rechercher
                    </button>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{
            domaine: '',
            budget: '',
            duree: '',
            lieu: '',
            niveau: '',
            tri: 'recent',
            showFilters: false,
            activeFilters: 0,
            updateCount() {
                this.activeFilters = [this.domaine, this.budget, this.duree, this.lieu, this.niveau].filter(v => v !== '').length;
            }
        }">

            {{-- BARRE DE FILTRES --}}
            <div class="mb-8">

                {{-- Filtres rapides (pills) --}}
                <div class="flex items-center gap-3 flex-wrap mb-4">

                    {{-- Domaine --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            :class="domaine ? 'bg-indigo-600 text-white border-indigo-600' :
                                'bg-white text-gray-700 border-gray-200 hover:border-indigo-300'"
                            class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                            🎨 {{ 'Domaine' }}
                            <span x-show="domaine" x-text="domaine" class="max-w-[80px] truncate"></span>
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                            @foreach ([['val' => 'design', 'label' => 'Design & UI/UX', 'emoji' => '🎨'], ['val' => 'dev-web', 'label' => 'Développement Web', 'emoji' => '💻'], ['val' => 'dev-mobile', 'label' => 'Développement Mobile', 'emoji' => '📱'], ['val' => 'photo', 'label' => 'Photographie', 'emoji' => '📸'], ['val' => 'video', 'label' => 'Vidéo & Montage', 'emoji' => '🎥'], ['val' => 'marketing', 'label' => 'Marketing Digital', 'emoji' => '📣'], ['val' => 'redaction', 'label' => 'Rédaction & Contenu', 'emoji' => '✍️'], ['val' => 'audio', 'label' => 'Audio & Musique', 'emoji' => '🎵'], ['val' => 'branding', 'label' => 'Branding & Identité', 'emoji' => '🏷️']] as $opt)
                                <button
                                    @click="domaine = (domaine === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; updateCount()"
                                    :class="domaine === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                        'text-gray-700 hover:bg-gray-50'"
                                    class="flex items-center gap-2.5 w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                                    <span>{{ $opt['emoji'] }}</span>
                                    <span>{{ $opt['label'] }}</span>
                                    <svg x-show="domaine === '{{ $opt['val'] }}'"
                                        class="w-4 h-4 ml-auto text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Budget --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            :class="budget ? 'bg-indigo-600 text-white border-indigo-600' :
                                'bg-white text-gray-700 border-gray-200 hover:border-indigo-300'"
                            class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                            💰 Budget
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                            @foreach ([['val' => 'moins-25k', 'label' => 'Moins de 25 000 FCFA'], ['val' => '25k-50k', 'label' => '25 000 – 50 000 FCFA'], ['val' => '50k-100k', 'label' => '50 000 – 100 000 FCFA'], ['val' => '100k-250k', 'label' => '100 000 – 250 000 FCFA'], ['val' => 'plus-250k', 'label' => 'Plus de 250 000 FCFA']] as $opt)
                                <button
                                    @click="budget = (budget === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; updateCount()"
                                    :class="budget === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                        'text-gray-700 hover:bg-gray-50'"
                                    class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                                    <span>{{ $opt['label'] }}</span>
                                    <svg x-show="budget === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600"
                                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Durée --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            :class="duree ? 'bg-indigo-600 text-white border-indigo-600' :
                                'bg-white text-gray-700 border-gray-200 hover:border-indigo-300'"
                            class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                            ⏱️ Durée
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                            @foreach ([['val' => '1-3j', 'label' => '1 à 3 jours'], ['val' => '1sem', 'label' => '1 semaine'], ['val' => '2sem', 'label' => '2 semaines'], ['val' => '1mois', 'label' => '1 mois'], ['val' => 'plus-1mois', 'label' => 'Plus d\'1 mois']] as $opt)
                                <button
                                    @click="duree = (duree === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; updateCount()"
                                    :class="duree === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                        'text-gray-700 hover:bg-gray-50'"
                                    class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                                    <span>{{ $opt['label'] }}</span>
                                    <svg x-show="duree === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600"
                                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Localisation --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            :class="lieu ? 'bg-indigo-600 text-white border-indigo-600' :
                                'bg-white text-gray-700 border-gray-200 hover:border-indigo-300'"
                            class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                            📍 Lieu
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                            @foreach ([['val' => 'remote', 'label' => '🌐 Remote / En ligne'], ['val' => 'cotonou', 'label' => '🇧🇯 Cotonou'], ['val' => 'dakar', 'label' => '🇸🇳 Dakar'], ['val' => 'abidjan', 'label' => '🇨🇮 Abidjan'], ['val' => 'bamako', 'label' => '🇲🇱 Bamako'], ['val' => 'lagos', 'label' => '🇳🇬 Lagos'], ['val' => 'accra', 'label' => '🇬🇭 Accra']] as $opt)
                                <button
                                    @click="lieu = (lieu === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; updateCount()"
                                    :class="lieu === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                        'text-gray-700 hover:bg-gray-50'"
                                    class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                                    <span>{{ $opt['label'] }}</span>
                                    <svg x-show="lieu === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600"
                                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Niveau --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false"
                            :class="niveau ? 'bg-indigo-600 text-white border-indigo-600' :
                                'bg-white text-gray-700 border-gray-200 hover:border-indigo-300'"
                            class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                            🎓 Niveau
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute top-full left-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                            @foreach ([['val' => 'tous', 'label' => '✅ Tous niveaux'], ['val' => 'junior', 'label' => '🌱 Junior'], ['val' => 'intermediaire', 'label' => '⚡ Intermédiaire'], ['val' => 'senior', 'label' => '🚀 Senior']] as $opt)
                                <button
                                    @click="niveau = (niveau === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; updateCount()"
                                    :class="niveau === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                        'text-gray-700 hover:bg-gray-50'"
                                    class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                                    <span>{{ $opt['label'] }}</span>
                                    <svg x-show="niveau === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600"
                                        fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Reset si filtres actifs --}}
                    <button x-show="activeFilters > 0"
                        @click="domaine=''; budget=''; duree=''; lieu=''; niveau=''; updateCount()"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-full border border-red-200 bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Effacer (<span x-text="activeFilters"></span>)
                    </button>

                    {{-- Séparateur + Tri --}}
                    <div class="ml-auto flex items-center gap-2">
                        <span class="text-xs text-gray-400 font-medium">Trier par</span>
                        <select x-model="tri"
                            class="text-sm font-semibold text-gray-700 border border-gray-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white cursor-pointer">
                            <option value="recent">🕐 Plus récentes</option>
                            <option value="budget-desc">💰 Budget décroissant</option>
                            <option value="budget-asc">💰 Budget croissant</option>
                            <option value="duree">⏱️ Durée courte</option>
                            <option value="populaire">🔥 Plus populaires</option>
                        </select>
                    </div>
                </div>

                {{-- Tags actifs --}}
                <div x-show="activeFilters > 0" class="flex flex-wrap gap-2 pt-3 border-t border-gray-100">
                    <span class="text-xs text-gray-400 font-semibold pt-1">Filtres actifs :</span>
                    <span x-show="domaine"
                        class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        🎨 <span x-text="domaine"></span>
                        <button @click="domaine=''; updateCount()" class="ml-1 hover:text-red-500">×</button>
                    </span>
                    <span x-show="budget"
                        class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        💰 <span x-text="budget"></span>
                        <button @click="budget=''; updateCount()" class="ml-1 hover:text-red-500">×</button>
                    </span>
                    <span x-show="duree"
                        class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        ⏱️ <span x-text="duree"></span>
                        <button @click="duree=''; updateCount()" class="ml-1 hover:text-red-500">×</button>
                    </span>
                    <span x-show="lieu"
                        class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        📍 <span x-text="lieu"></span>
                        <button @click="lieu=''; updateCount()" class="ml-1 hover:text-red-500">×</button>
                    </span>
                    <span x-show="niveau"
                        class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        🎓 <span x-text="niveau"></span>
                        <button @click="niveau=''; updateCount()" class="ml-1 hover:text-red-500">×</button>
                    </span>
                </div>
            </div>

            {{-- RÉSULTATS --}}
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-gray-500">
                    <span class="font-bold text-gray-900">6</span> missions disponibles
                    <span x-show="activeFilters > 0" class="text-indigo-600 font-semibold"> · filtrées</span>
                </p>
            </div>

            {{-- GRILLE MISSIONS --}}
            {{-- ... ici tes cards de missions ... --}}


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
                    class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-6 overflow-hidden">

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
                            <h3 class="font-bold text-gray-900 text-base leading-snug">{{ $mission['titre'] }}
                            </h3>
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


        <div class="bg-indigo-600 rounded-2xl sm:rounded-3xl p-6 sm:p-10 text-center text-white">
            <h2 class="text-xl sm:text-2xl font-bold mb-2">Soyez notifié en premier</h2>
            <p class="text-indigo-200 text-sm sm:text-base mb-8">
                Inscrivez-vous pour recevoir les premières missions dès le lancement.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" placeholder="votre@email.com"
                    class="w-full flex-1 px-4 py-3.5 rounded-xl text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-white transition-all">

                <button
                    class="w-full sm:w-auto bg-white text-indigo-600 font-bold px-8 py-3.5 rounded-xl hover:bg-indigo-50 active:scale-95 transition-all">
                    M'alerter
                </button>
            </div>
        </div>
    </div>
</x-app-layout>

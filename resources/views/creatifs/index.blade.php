<x-app-layout>
    {{-- <section class="bg-white py-12 lg:py-18 text-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold tracking-tight sm:text-6xl text-center md:text-left">
                Découvrez nos talents créatifs
            </h2>
            <p class="mt-6 text-xl leading-8 text-gray-600 max-w-3xl">
                Explorez les profils inspirants de designers, développeurs et illustrateurs.
                Chaque créatif a une histoire unique à raconter.
            </p>
        </div>
    </section> --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{
        domaine: '',
        pays: '',
        disponible: false,
        tri: 'recent'
    }">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-500 mb-2">Mefolio · Communauté</p>
                <h1 class="text-4xl font-black text-gray-900">Découvrez les<br><span
                        class="text-indigo-600 italic">talents.</span></h1>
            </div>
            <p class="text-sm text-gray-400 max-w-xs">Designers, développeurs, photographes — les meilleurs créatifs
                africains sont sur Mefolio.</p>
        </div>

        {{-- Barre de recherche --}}
        <div class="relative mb-6 max-w-xl">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" placeholder="Rechercher un créatif, une compétence..."
                class="w-full pl-11 pr-4 py-3 rounded-2xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white">
        </div>

        {{-- Filtres pills --}}
        <div class="flex flex-wrap items-center gap-3 mb-8 pb-6 border-b border-gray-100">

            {{-- Domaine --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.outside="open = false"
                    :class="domaine ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-700 border-gray-200'"
                    class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold hover:border-indigo-300 transition-all">
                    🎯 Domaine
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="absolute top-full left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                    @foreach ([['val' => 'design', 'label' => '🎨 Design & UI/UX'], ['val' => 'dev-web', 'label' => '💻 Développement Web'], ['val' => 'dev-mobile', 'label' => '📱 Développement Mobile'], ['val' => 'photo', 'label' => '📸 Photographie'], ['val' => 'video', 'label' => '🎥 Vidéo & Montage'], ['val' => 'marketing', 'label' => '📣 Marketing Digital'], ['val' => 'redaction', 'label' => '✍️ Rédaction'], ['val' => 'audio', 'label' => '🎵 Audio & Musique']] as $opt)
                        <button
                            @click="domaine = (domaine === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false"
                            :class="domaine === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                            <span>{{ $opt['label'] }}</span>
                            <svg x-show="domaine === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600"
                                fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Pays --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.outside="open = false"
                    :class="pays ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-700 border-gray-200'"
                    class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold hover:border-indigo-300 transition-all">
                    🌍 Pays
                    <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="absolute top-full left-0 mt-2 w-44 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                    @foreach ([['val' => 'bj', 'label' => '🇧🇯 Bénin'], ['val' => 'sn', 'label' => '🇸🇳 Sénégal'], ['val' => 'ci', 'label' => '🇨🇮 Côte d\'Ivoire'], ['val' => 'gh', 'label' => '🇬🇭 Ghana'], ['val' => 'ml', 'label' => '🇲🇱 Mali'], ['val' => 'ng', 'label' => '🇳🇬 Nigeria'], ['val' => 'cm', 'label' => '🇨🇲 Cameroun']] as $opt)
                        <button
                            @click="pays = (pays === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false"
                            :class="pays === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                'text-gray-700 hover:bg-gray-50'"
                            class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                            <span>{{ $opt['label'] }}</span>
                            <svg x-show="pays === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600" fill="none"
                                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Disponible --}}
            <button @click="disponible = !disponible"
                :class="disponible ? 'bg-green-600 text-white border-green-600' :
                    'bg-white text-gray-700 border-gray-200 hover:border-green-300'"
                class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                <span class="w-2 h-2 rounded-full" :class="disponible ? 'bg-white' : 'bg-green-400'"></span>
                Disponible maintenant
            </button>

            {{-- Reset --}}
            <button x-show="domaine || pays || disponible" @click="domaine=''; pays=''; disponible=false"
                class="flex items-center gap-1.5 px-4 py-2 rounded-full border border-red-200 bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Effacer
            </button>

            {{-- Tri --}}
            <div class="ml-auto flex items-center gap-2">
                <span class="text-xs text-gray-400">Trier par</span>
                <select x-model="tri"
                    class="text-sm font-semibold text-gray-700 border border-gray-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white cursor-pointer">
                    <option value="recent">🕐 Plus récents</option>
                    <option value="populaire">🔥 Plus populaires</option>
                    <option value="projets">🎨 Plus de projets</option>
                </select>
            </div>
        </div>

        {{-- Grille créatifs existante ici --}}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-6 max-w-7xl mx-auto">
        @forelse ($creatifs as $creatif)
            <div class="group relative pt-12">
                <div
                    class="relative bg-zinc-900 rounded-[2.5rem] p-8 transition-all duration-500 group-hover:shadow-[0_40px_80px_-15px_rgba(0,0,0,0.35)] group-hover:-translate-y-2 border border-white/5">

                    <div class="absolute -top-12 left-8">
                        <div class="relative">
                            <img class="w-28 h-28 rounded-3xl object-cover shadow-2xl -rotate-6 group-hover:rotate-0 group-hover:scale-105 transition-all duration-500 border-4 border-white"
                                src="{{ $creatif->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($creatif->prenom ?? 'M') . '&background=6366f1&color=fff' }}"
                                alt="{{ $creatif->nom }}">
                            <div
                                class="absolute inset-0 rounded-3xl bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                        </div>
                    </div>

                    <div class="mt-12">

                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400/80">
                            {{ $creatif->specialite ?? 'Créatif' }}
                        </span>

                        <a href="{{ route('creatifs.show', $creatif->slug) }}" class="block mt-2">
                            <h3 class="text-2xl font-bold text-white transition-colors">
                                {{ $creatif->prenom }} <span class="text-blue-500">{{ $creatif->nom }}</span>
                            </h3>
                        </a>

                        <p
                            class="mt-4 text-gray-400 text-sm leading-relaxed line-clamp-3 group-hover:text-gray-300 transition-colors">
                            {{ Str::limit($creatif->bio, 100) }}
                        </p>

                        <div class="mt-4 pt-4 border-t border-white/5 flex items-center justify-between">
                            <a href="{{ route('creatifs.show', $creatif->slug) }}"
                                class="text-[10px] font-bold uppercase tracking-widest text-gray-500 group-hover:text-white transition-colors">
                                Voir le profil
                            </a>

                            <div class="flex items-center gap-4">
                                @if ($creatif->github)
                                    <a href="{{ $creatif->github }}" target="_blank"
                                        class="text-gray-500 hover:text-white transition-all transform hover:-translate-y-1">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.041-1.416-4.041-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                        </svg>
                                    </a>
                                @endif

                                @if ($creatif->linkedin)
                                    <a href="{{ $creatif->linkedin }}" target="_blank"
                                        class="text-gray-500 hover:text-[#0077b5] transition-all transform hover:-translate-y-1">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Aucun créatif trouvé pour le moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10 mx-auto p-6 max-w-7xl">
        {{ $creatifs->links() }}
    </div>
</x-app-layout>

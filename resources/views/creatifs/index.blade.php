<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mt-10 mb-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900">{{ __('Découvrez les talents.') }}</h1>
            </div>
            <p class="text-sm text-gray-700 max-w-xs">{{ __('Designers, développeurs, photographes : les meilleurs créatifs africains sont sur Mefolio.') }}</p>
        </div>

        <form method="GET" x-data="{
            domaine: '{{ request('domaine') }}',
            pays: '{{ request('pays') }}',
            disponible: {{ request()->boolean('disponible') ? 'true' : 'false' }}
        }">
            {{-- Barre de recherche --}}
            <div class="relative mb-6 max-w-xl">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="{{ __('Rechercher un créatif, une compétence...') }}"
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white">
            </div>

            {{-- Filtres pills --}}
            <div class="flex flex-wrap items-center gap-3 mb-8 pb-6 border-b border-gray-100">

                {{-- Domaine --}}
                <div x-data="{ open: false }" class="relative">
                    <input type="hidden" name="domaine" :value="domaine">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                        :class="domaine ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-700 border-gray-200'"
                        class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold hover:border-indigo-300 transition-all">
                        {{ __('Domaine') }}
                        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute top-full left-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                        @foreach ([['val' => 'design', 'label' => __('Design & UI/UX')], ['val' => 'dev-web', 'label' => __('Développement Web')], ['val' => 'dev-mobile', 'label' => __('Développement Mobile')], ['val' => 'photo', 'label' => __('Photographie')], ['val' => 'video', 'label' => __('Vidéo & Montage')], ['val' => 'marketing', 'label' => __('Marketing Digital')], ['val' => 'redaction', 'label' => __('Rédaction')], ['val' => 'audio', 'label' => __('Audio & Musique')]] as $opt)
                            <button type="button"
                                @click="domaine = (domaine === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; $nextTick(() => $el.closest('form').submit())"
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
                    <input type="hidden" name="pays" :value="pays">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                        :class="pays ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-700 border-gray-200'"
                        class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold hover:border-indigo-300 transition-all">
                        {{ __('Pays') }}
                        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute top-full left-0 mt-2 w-44 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-40">
                        @foreach ([['val' => 'bj', 'label' => 'Bénin'], ['val' => 'sn', 'label' => 'Sénégal'], ['val' => 'ci', 'label' => 'Côte d\'Ivoire'], ['val' => 'gh', 'label' => 'Ghana'], ['val' => 'ml', 'label' => 'Mali'], ['val' => 'ng', 'label' => 'Nigeria'], ['val' => 'cm', 'label' => 'Cameroun']] as $opt)
                            <button type="button"
                                @click="pays = (pays === '{{ $opt['val'] }}' ? '' : '{{ $opt['val'] }}'); open = false; $nextTick(() => $el.closest('form').submit())"
                                :class="pays === '{{ $opt['val'] }}' ? 'bg-indigo-50 text-indigo-600' :
                                    'text-gray-700 hover:bg-gray-50'"
                                class="flex items-center justify-between w-full px-3 py-2 rounded-xl text-sm font-medium transition-colors">
                                <span>{{ $opt['label'] }}</span>
                                <svg x-show="pays === '{{ $opt['val'] }}'" class="w-4 h-4 text-indigo-600"
                                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Disponible --}}
                <input type="hidden" name="disponible" :value="disponible ? 1 : 0">
                <button type="button" @click="disponible = !disponible; $nextTick(() => $el.closest('form').submit())"
                    :class="disponible ? 'bg-green-600 text-white border-green-600' :
                        'bg-white text-gray-700 border-gray-200 hover:border-green-300'"
                    class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold transition-all">
                    <span class="w-2 h-2 rounded-full" :class="disponible ? 'bg-white' : 'bg-green-400'"></span>
                    {{ __('Disponible maintenant') }}
                </button>

                {{-- Reset --}}
                @if (request()->anyFilled(['q', 'domaine', 'pays', 'disponible']))
                    <a href="{{ route('creatifs.index') }}"
                        class="flex items-center gap-1.5 px-4 py-2 rounded-full border border-red-200 bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        {{ __('Effacer') }}
                    </a>
                @endif

                {{-- Tri --}}
                <div class="ml-auto flex items-center gap-2">
                    <span class="text-xs text-gray-400">{{ __('Trier par') }}</span>
                    <select name="tri" onchange="this.form.submit()"
                        class="text-sm font-semibold text-gray-700 border border-gray-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white cursor-pointer">
                        <option value="recent" @selected(request('tri', 'recent') === 'recent')>{{ __('Plus récents') }}
                        </option>
                        <option value="populaire" @selected(request('tri') === 'populaire')>{{ __('Plus populaires') }}
                        </option>
                        <option value="projets" @selected(request('tri') === 'projets')>{{ __('Plus de projets') }}</option>
                    </select>
                </div>
            </div>
        </form>

        {{-- Grille créatifs --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($creatifs as $creatif)
                <x-creatif-card :creatif="$creatif" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">{{ __('Aucun créatif trouvé pour le moment.') }}</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $creatifs->links() }}
        </div>
    </div>
</x-app-layout>

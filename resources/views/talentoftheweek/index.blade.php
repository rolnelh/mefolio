<x-app-layout>
    <section class="relative bg-white py-8 lg:py-12 overflow-hidden min-h-[50vh] flex items-center">
        <div class="absolute inset-0 z-0 opacity-[0.02]"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-[10%] right-[5%] w-[40%] h-[50%] rounded-full bg-orange-50/50 blur-[100px]"></div>
            <div class="absolute bottom-0 left-[5%] w-[30%] h-[40%] rounded-full bg-indigo-50/40 blur-[80px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-left order-2 lg:order-1">
                    <h1 class="text-5xl sm:text-5xl lg:text-7xl font-black text-slate-900 tracking-tight leading-[0.95] mb-6">
                        Talent &<br>
                        <span class="text-orange-500">of the Week</span>
                    </h1>
                    <p class="text-lg text-slate-500 max-w-xl leading-relaxed mb-8">
                        Chaque semaine, Mefolio met en lumière un talent africain exceptionnel. Découvrez,
                        inspirez-vous, connectez-vous.
                    </p>
                </div>
                <div class="relative order-1 lg:order-2 lg:-mt-16">
                    <div class="relative p-2 overflow-hidden">
                        <img src="{{ asset('images/talentoftheweek.png') }}" alt="Talent of the Week"
                            class="w-full h-auto rounded-[1.8rem] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-6 lg:px-8 py-16">

        @if ($current && $current->creatif)
            @php $c = $current->creatif; @endphp
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border border-yellow-100 rounded-3xl p-8 md:p-12 mb-16">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="relative flex-shrink-0">
                        <img src="{{ $c->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($c->prenom ?? 'M') . '&background=f59e0b&color=fff&size=200' }}"
                            class="w-40 h-40 rounded-3xl object-cover shadow-2xl ring-4 ring-yellow-200">
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full mb-4">
                            Talent of the Week — {{ $current->week_label }}
                        </div>
                        <h2 class="text-3xl font-black text-gray-900 mb-1">{{ $c->prenom }} {{ $c->nom }}</h2>
                        <p class="text-indigo-600 font-semibold mb-3">{{ $c->specialite }}</p>
                        @if ($c->localisation)
                            <p class="text-sm text-gray-500 mb-2">{{ $c->localisation }}</p>
                        @endif
                        @if ($current->note)
                            <p class="text-gray-600 leading-relaxed mb-6 max-w-lg">{{ $current->note }}</p>
                        @elseif ($c->bio)
                            <p class="text-gray-600 leading-relaxed mb-6 max-w-lg">{{ $c->bio }}</p>
                        @endif
                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                            <a href="{{ route('creatifs.show', $c->slug) }}"
                                class="px-6 py-2.5 bg-gray-900 text-white text-sm font-bold rounded-full hover:bg-indigo-600 transition-all">
                                Voir son profil →
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-yellow-100">
                    @foreach ([
                        ['val' => $c->projects()->count(), 'label' => 'Projets publiés'],
                        ['val' => number_format($c->builder_score), 'label' => 'Builder Score'],
                        ['val' => $c->available_for_work ? 'Oui' : 'Non', 'label' => 'Disponible'],
                    ] as $s)
                        <div class="text-center">
                            <p class="text-2xl font-black text-gray-900">{{ $s['val'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $s['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-12 text-center mb-16">
                <p class="text-sm font-medium text-gray-500">Aucun talent n'est mis en avant pour le moment. Revenez bientôt !</p>
            </div>
        @endif

        @if ($hallOfFame->count())
            <div class="mb-16">
                <h2 class="text-2xl font-black text-gray-900 mb-8">Hall of Fame</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($hallOfFame as $spotlight)
                        @continue(!$spotlight->creatif)
                        <div class="bg-white border border-gray-100 rounded-2xl p-5 hover:shadow-md transition-all group">
                            <div class="flex items-center gap-4">
                                <img src="{{ $spotlight->creatif->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($spotlight->creatif->prenom ?? 'M') }}"
                                    class="w-14 h-14 rounded-2xl object-cover flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-gray-400 mb-0.5">{{ $spotlight->week_label }}</p>
                                    <h3 class="font-bold text-gray-900 truncate">{{ $spotlight->creatif->prenom }} {{ $spotlight->creatif->nom }}</h3>
                                    <p class="text-xs text-indigo-600 font-semibold">{{ $spotlight->creatif->specialite }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="bg-gradient-to-r from-indigo-600 to-violet-600 rounded-3xl p-10 text-center text-white">
            <h2 class="text-2xl font-black mb-2">Nominez un talent africain</h2>
            <p class="text-indigo-200 mb-6 max-w-lg mx-auto">Vous connaissez un créatif africain exceptionnel ?
                Nominez-le pour le Talent of the Week et aidez-le à briller.</p>

            @auth
                <form method="POST" action="{{ route('talentoftheweek.nominate') }}" class="max-w-lg mx-auto text-left space-y-3 bg-white/10 rounded-2xl p-6">
                    @csrf
                    <div>
                        <input type="text" name="creatif_name" required placeholder="Nom du talent"
                            class="w-full px-4 py-2.5 rounded-xl text-gray-900 text-sm focus:outline-none">
                    </div>
                    <div>
                        <input type="email" name="contact_email" placeholder="Email de contact (optionnel)"
                            class="w-full px-4 py-2.5 rounded-xl text-gray-900 text-sm focus:outline-none">
                    </div>
                    <div>
                        <textarea name="reason" rows="3" required placeholder="Pourquoi ce talent mérite d'être mis en avant ?"
                            class="w-full px-4 py-2.5 rounded-xl text-gray-900 text-sm focus:outline-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-white text-indigo-600 font-bold px-6 py-2.5 rounded-xl hover:bg-indigo-50 transition-all">
                        Envoyer la nomination
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 bg-white text-indigo-600 font-bold px-8 py-3 rounded-full hover:bg-indigo-50 transition-all hover:scale-105">
                    Se connecter pour nominer →
                </a>
            @endauth
        </div>

    </div>
</x-app-layout>

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
                        <p class="text-yellow-700 text-xs font-bold uppercase tracking-widest mb-3">
                            Talent of the Week · {{ $current->week_label }}
                        </p>
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

    </div>

    {{-- Badge flottant : nominer un talent --}}
    <div x-data="{
            open: {{ $errors->any() || session('nomination_success') ? 'true' : 'false' }},
            success: {{ session('nomination_success') ? 'true' : 'false' }}
        }"
        x-init="if (success) { setTimeout(() => { open = false; success = false }, 6000) }"
        class="fixed bottom-6 right-6 z-50">

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="absolute bottom-full right-0 mb-4 w-80 max-w-[calc(100vw-3rem)]" x-cloak>

            {{-- État succès --}}
            <div x-show="success" x-cloak class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
                </div>
                <h3 class="font-black text-gray-900 mb-1">Nomination envoyée !</h3>
                <p class="text-sm text-gray-500">Merci, notre équipe va l'examiner avec attention.</p>
            </div>

            {{-- État formulaire --}}
            <div x-show="!success" x-cloak class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-black text-gray-900">Nominer un talent</h3>
                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @auth
                    <form method="POST" action="{{ route('talentoftheweek.nominate') }}" class="space-y-3">
                        @csrf
                        <input type="text" name="creatif_name" required value="{{ old('creatif_name') }}"
                            placeholder="Nom du talent"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                            placeholder="Email de contact (optionnel)"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <textarea name="reason" rows="3" required placeholder="Pourquoi ce talent mérite d'être mis en avant ?"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('reason') }}</textarea>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2.5 rounded-xl transition-all">
                            Envoyer la nomination
                        </button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 mb-4">Vous connaissez un créatif africain exceptionnel ?
                        Connectez-vous pour le nominer.</p>
                    <a href="{{ route('login') }}"
                        class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2.5 rounded-xl transition-all">
                        Se connecter pour nominer
                    </a>
                @endauth
            </div>
        </div>

        <button type="button" @click="open = !open; if (!open) success = false"
            class="flex items-center gap-2.5 bg-gray-900 hover:bg-black text-white pl-3 pr-5 py-3 rounded-full shadow-xl transition-all hover:scale-105">
            <span class="w-8 h-8 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                </svg>
            </span>
            <span class="text-sm font-bold">Nominer un talent</span>
        </button>
    </div>
</x-app-layout>

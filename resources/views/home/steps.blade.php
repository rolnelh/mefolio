{{--
    Section "Trois étapes vers votre carrière créative" : cartes ascendantes
    reliées par une courbe SVG sur desktop, empilées sur mobile. Aucune
    variable externe requise.
--}}
<section class="bg-white py-24 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-4">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mt-3">
                Trois étapes vers votre carrière créative.
            </h2>
        </div>

        @php
            $steps = [
                [
                    'num' => '01', 'title' => 'Créez votre profil',
                    'desc' => 'Renseignez votre spécialité, votre bio et votre portfolio en quelques minutes.',
                    'bg' => 'bg-indigo-600', 'pill' => 'bg-indigo-50 text-indigo-600',
                    'pos' => 'left-0 top-[260px]',
                    'icon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z',
                ],
                [
                    'num' => '02', 'title' => 'Publiez vos projets',
                    'desc' => 'Montrez votre travail, recevez des likes et des commentaires de la communauté.',
                    'bg' => 'bg-violet-600', 'pill' => 'bg-violet-50 text-violet-600',
                    'pos' => 'left-[280px] top-[130px]',
                    'icon' => 'M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25',
                ],
                [
                    'num' => '03', 'title' => 'Soyez repéré',
                    'desc' => 'Postulez à des missions, grimpez le classement et faites-vous remarquer.',
                    'bg' => 'bg-emerald-500', 'pill' => 'bg-emerald-50 text-emerald-600',
                    'pos' => 'left-[560px] top-0',
                    'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
                ],
            ];
        @endphp

        {{-- Cartes ascendantes reliées par une courbe (desktop) --}}
        <div class="hidden md:block relative mx-auto mt-16" style="width: 820px; height: 400px;">
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 820 400" fill="none">
                <path d="M260 320 C 330 320, 330 190, 280 190" stroke="#c7d2fe" stroke-width="2" />
                <path d="M540 190 C 610 190, 610 60, 560 60" stroke="#ddd6fe" stroke-width="2" />
            </svg>

            @foreach ($steps as $step)
                <div class="absolute {{ $step['pos'] }} w-64 bg-white rounded-2xl border border-gray-100 shadow-lg shadow-gray-900/5 p-5 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-10 h-10 rounded-xl {{ $step['bg'] }} flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                            </svg>
                        </span>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full {{ $step['pill'] }}">{{ $step['num'] }}</span>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm mb-1.5">{{ $step['title'] }}</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Version mobile : empilée --}}
        <div class="md:hidden space-y-4 mt-10">
            @foreach ($steps as $step)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-10 h-10 rounded-xl {{ $step['bg'] }} flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                            </svg>
                        </span>
                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full {{ $step['pill'] }}">{{ $step['num'] }}</span>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm mb-1.5">{{ $step['title'] }}</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route(auth()->check() ? 'dashboard' : 'register') }}"
                class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold transition-all hover:scale-[1.02]">
                Commencer maintenant
            </a>
        </div>
    </div>
</section>

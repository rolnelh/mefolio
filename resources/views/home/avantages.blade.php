{{--
    Section "diagramme" : logo central relié à 6 raccourcis (Portfolio,
    Créatifs, Missions, Classement, Programmes, Blog). Version SVG sur
    desktop, grille simple sur mobile. Aucune variable externe requise.
--}}
<section class="bg-[#FAFAF8] py-24 px-6 overflow-hidden">
    <div class="max-w-3xl mx-auto text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
            Tout votre parcours créatif, <span class="text-indigo-600">connecté</span>.
        </h2>
        <p class="text-slate-500 mt-4 max-w-xl mx-auto">
            Portfolio, missions, communauté, classement : plus besoin de jongler entre dix outils différents.
        </p>
    </div>

    @php
        $avantages = [
            ['label' => 'Portfolio', 'href' => route('projects.index'), 'pos' => 'left-[6%] top-[2%]', 'icon' => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-19.5 0v6a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25v-6m-19.5 0h19.5M8.25 21v-9'],
            ['label' => 'Créatifs', 'href' => route('creatifs.index'), 'pos' => 'left-[1%] top-[44%]', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Missions', 'href' => route('missions.index'), 'pos' => 'left-[6%] top-[86%]', 'icon' => 'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653'],
            ['label' => 'Classement', 'href' => route('classement.index'), 'pos' => 'right-[6%] top-[2%]', 'icon' => 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172'],
            ['label' => 'Programmes', 'href' => route('hackathons.index'), 'pos' => 'right-[1%] top-[44%]', 'icon' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347M12 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0a50.717 50.717 0 00-2.658-.814 59.906 59.906 0 0110.399-5.84'],
            ['label' => 'Blog', 'href' => route('blog'), 'pos' => 'right-[6%] top-[86%]', 'icon' => 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6 12l-1.5 1.5m1.5-1.5l1.5 1.5m-6-1.5l-1.5 1.5m0 0l-1.5-1.5m1.5 1.5V9'],
        ];
    @endphp

    {{-- Diagramme (desktop) --}}
    <div class="hidden md:block relative max-w-4xl mx-auto aspect-[1100/460]">
        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1100 460" preserveAspectRatio="none" fill="none">
            <path d="M150 40 C 400 40, 420 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
            <path d="M85 208 C 320 208, 400 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
            <path d="M150 420 C 400 420, 420 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
            <path d="M950 40 C 700 40, 680 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
            <path d="M1015 208 C 780 208, 700 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
            <path d="M950 420 C 700 420, 680 230, 550 230" stroke="#E5E5E0" stroke-width="2" />
        </svg>

        {{-- Noeud central --}}
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
            <div class="w-20 h-20 rounded-full bg-gray-900 shadow-xl flex items-center justify-center ring-8 ring-white">
                <x-application-logo class="h-9 w-auto text-white" />
            </div>
        </div>

        @foreach ($avantages as $a)
            <a href="{{ $a['href'] }}" class="absolute {{ $a['pos'] }} z-10 flex flex-col items-center gap-2 group">
                <span class="w-14 h-14 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-700 group-hover:border-indigo-300 group-hover:text-indigo-600 group-hover:shadow-md transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['icon'] }}" />
                    </svg>
                </span>
                <span class="text-xs font-semibold text-gray-600 group-hover:text-indigo-600 transition-colors">{{ $a['label'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- Grille (mobile) --}}
    <div class="grid grid-cols-3 gap-4 md:hidden max-w-sm mx-auto">
        @foreach ($avantages as $a)
            <a href="{{ $a['href'] }}" class="flex flex-col items-center gap-2 group">
                <span class="w-14 h-14 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-700 group-hover:border-indigo-300 group-hover:text-indigo-600 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['icon'] }}" />
                    </svg>
                </span>
                <span class="text-xs font-semibold text-gray-600 text-center">{{ $a['label'] }}</span>
            </a>
        @endforeach
    </div>
</section>

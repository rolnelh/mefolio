{{--
    Section "Ce que Mefolio change" : grille de six cartes blanches (deux
    rangées de trois sur desktop), chacune avec une illustration à gauche,
    un titre, une courte description et une flèche en haut à droite. Toute
    la carte est un lien. Illustrations : icônes existantes de
    public/images. Aucune variable externe requise.
--}}
@php
    $benefices = [
        ['titre' => __('Visibilité sans frontières'), 'desc' => __('Un profil vu par les recruteurs locaux et internationaux.'), 'image' => 'images/globe.png', 'href' => route('creatifs.index')],
        ['titre' => __('Paiements locaux intégrés'), 'desc' => __('MTN MoMo, Wave, Moov, Kkiapay, Fedapay : retraits directs.'), 'image' => 'images/cash.png', 'href' => route('services.index')],
        ['titre' => __('Marketplace de missions'), 'desc' => __('Des missions freelance accessibles en un clic.'), 'image' => 'images/optimization.png', 'href' => route('missions.index')],
        ['titre' => __('Portfolio professionnel'), 'desc' => __('Vos projets présentés comme ils le méritent.'), 'image' => 'images/design.png', 'href' => route('projects.index')],
        ['titre' => __('Écosystème startup réuni'), 'desc' => __('Hackathons, challenges, Sèmè City et ASSIN au même endroit.'), 'image' => 'images/struggle.png', 'href' => route('hackathons.index')],
        ['titre' => __('Reconnaissance des talents'), 'desc' => __('Classement Builder Score et Talent of the Week.'), 'image' => 'images/talentoftheweek-menu.webp', 'href' => route('classement.index')],
    ];
@endphp

<section class="bg-[#FAFAF8] py-24 px-6">
    <div class="max-w-5xl mx-auto">
        <h2 class="mb-10 text-center text-3xl md:text-4xl font-semibold tracking-tight text-gray-900">{{ __('Ce que Mefolio change') }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($benefices as $b)
                <a href="{{ $b['href'] }}"
                    class="group relative flex items-center gap-5 rounded-2xl bg-white p-5 ring-1 ring-gray-900/5 shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <span class="flex h-16 w-16 shrink-0 items-center justify-center">
                        <img src="{{ asset($b['image']) }}" alt="" loading="lazy"
                            class="max-h-14 max-w-14 rounded-lg object-contain drop-shadow-[0_8px_10px_rgba(0,0,0,0.18)] transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110">
                    </span>
                    <span class="min-w-0 pr-5">
                        <span class="block text-sm font-semibold text-gray-900">{{ $b['titre'] }}</span>
                        <span class="mt-1 block text-xs leading-relaxed text-gray-400">{{ $b['desc'] }}</span>
                    </span>
                    <svg class="absolute right-4 top-4 h-3.5 w-3.5 text-gray-400 transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-gray-900"
                        fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M8 7h9v9" />
                    </svg>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{--
    Section "Ce que Mefolio change" : 4 cartes bénéfices. Aucune variable
    externe requise.
--}}
<section class="bg-[#FAFAF8] py-24 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-end justify-between gap-6 mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">Ce que Mefolio change</h2>
            <a href="{{ route('services.index') }}"
                class="text-xs font-semibold text-slate-500 hover:text-slate-900 transition-colors whitespace-nowrap">
                Voir tous les services
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ([
                [
                    'title' => 'Visibilité sans frontières',
                    'desc' => "Sortez de l'ombre. Un profil MeFolio optimisé pour connecter les talents aux recruteurs locaux et internationaux.",
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18zM12 3a14.98 14.98 0 00-3 9c0 3.5 1.2 6.7 3 9m0-18a14.98 14.98 0 013 9c0 3.5-1.2 6.7-3 9m-9-9h18" />',
                ],
                [
                    'title' => 'Paiements locaux intégrés',
                    'desc' => "L'argent arrive là où vous êtes. Retraits directs via MTN MoMo, Wave, Kkiapay, Fedapay, Moov ... sans détours.",
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />',
                ],
                [
                    'title' => 'Marketplace de missions',
                    'desc' => 'Ne cherchez plus, postulez. Un accès direct aux missions freelance pour décrocher vos futurs contrats en un clic.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653" />',
                ],
                [
                    'title' => 'Écosystème startup fragmenté',
                    'desc' => 'Hackathons, challenges créatifs et programmes Sèmè City & ASIN regroupés au même endroit.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />',
                ],
            ] as $item)
                <div class="bg-white border border-gray-100 rounded-2xl p-6">
                    <svg class="w-6 h-6 text-slate-900 mb-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                    <h3 class="font-bold text-slate-900 text-sm mb-1.5">{{ $item['title'] }}</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

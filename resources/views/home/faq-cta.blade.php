{{--
    Fin de la page d'accueil : section FAQ puis bandeau d'appel à l'action.

    FAQ : grand cadre blanc arrondi. À gauche, petit libellé "FAQ", titre,
    et en bas un encart "Encore une question ?" avec bouton de contact. À
    droite, questions numérotées (01, 02...) en accordéon : une seule
    ouverte à la fois (x-data local, ouverte = index de la question).

    CTA : cadre blanc contenant un panneau en léger dégradé, petit libellé,
    grand titre centré, sous-titre, bouton sombre + lien secondaire.

    Aucune variable externe requise.
--}}
@php
    $faqs = [
        ['q' => __('Comment créer mon portfolio ?'), 'a' => __("Le processus est instantané. Cliquez sur « S'inscrire », validez votre email et personnalisez votre espace. Pas de configuration complexe, juste votre talent mis en avant.")],
        ['q' => __('Est-ce vraiment gratuit ?'), 'a' => __("Oui, l'accès de base et la publication de projets sont 100% gratuits. Nous croyons en l'accessibilité du talent local pour dynamiser l'écosystème tech en Afrique.")],
        ['q' => __('Comment les recruteurs me trouvent-ils ?'), 'a' => __("Votre profil est indexé dans notre moteur de recherche de talents. Vous disposez aussi d'une URL personnalisée professionnelle que vous pouvez partager directement sur votre CV ou LinkedIn.")],
        ['q' => __('Quels types de fichiers puis-je publier ?'), 'a' => __('Vous pouvez importer des images (JPG, PNG), lier des dépôts GitHub pour le code, ou intégrer des liens externes comme Figma, Behance ou des vidéos de démonstration.')],
        ['q' => __('Comment décrocher des missions ?'), 'a' => __('Les entreprises publient leurs missions freelance sur Mefolio. Parcourez-les depuis le menu Missions et postulez directement depuis votre compte.')],
    ];
@endphp

<section class="bg-[#FAFAF8] px-4 sm:px-6 py-20">

    {{-- FAQ --}}
    <div class="mx-auto max-w-6xl rounded-[32px] bg-white p-6 sm:p-10 lg:p-12 ring-1 ring-gray-900/5 shadow-[0_1px_2px_rgba(0,0,0,0.04)]">
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,5fr)_minmax(0,7fr)] gap-10 lg:gap-16">

            <div class="flex flex-col">
                <p class="flex items-center gap-2 text-xs font-medium text-violet-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-violet-600"></span>
                    FAQ
                </p>
                <h2 class="mt-4 max-w-sm text-3xl sm:text-4xl font-medium tracking-tight leading-tight text-gray-900">
                    {{ __('Questions fréquentes') }}
                </h2>

                <div class="mt-10 lg:mt-auto">
                    <p class="text-sm font-semibold text-gray-900">{{ __('Encore une question ?') }}</p>
                    <p class="mt-2 max-w-xs text-xs leading-relaxed text-gray-500">
                        {{ __('Notre équipe est toujours disponible pour des réponses rapides, claires et fiables.') }}
                    </p>
                    <a href="mailto:contact@mefolio.com"
                        class="mt-5 inline-flex items-center rounded-lg bg-violet-600 px-5 py-2.5 text-xs font-semibold text-white shadow-md shadow-violet-600/25 hover:bg-violet-700 transition">
                        {{ __('Nous contacter') }}
                    </a>
                </div>
            </div>

            <div x-data="{ ouverte: 0 }" class="space-y-3">
                @foreach ($faqs as $i => $faq)
                    <div class="rounded-2xl bg-gray-50 ring-1 ring-gray-900/5 transition-colors"
                        :class="ouverte === {{ $i }} ? 'bg-white shadow-sm' : 'hover:bg-gray-100/70'">
                        <button type="button" @click="ouverte = ouverte === {{ $i }} ? null : {{ $i }}"
                            :aria-expanded="ouverte === {{ $i }}"
                            class="flex w-full items-center gap-5 px-5 py-4 text-left">
                            <span class="w-6 shrink-0 text-xs text-gray-400">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="flex-1 text-sm font-medium text-gray-900">{{ $faq['q'] }}</span>
                            <svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" d="M5 12h14" />
                                <path x-show="ouverte !== {{ $i }}" stroke-linecap="round" d="M12 5v14" />
                            </svg>
                        </button>
                        <div x-show="ouverte === {{ $i }}" x-transition.opacity.duration.200ms x-cloak>
                            <p class="pl-16 pr-12 pb-5 text-xs leading-relaxed text-gray-500">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Appel à l'action --}}
    <div class="mx-auto mt-16 max-w-4xl rounded-[28px] bg-white p-3 ring-1 ring-gray-900/5 shadow-[0_20px_60px_-30px_rgba(17,24,39,0.25)]">
        <div class="rounded-[20px] bg-gradient-to-b from-white via-white to-rose-50 px-6 py-14 sm:py-20 text-center">
            <p class="text-[11px] font-medium text-gray-400">{{ __('Rejoignez la communauté Mefolio') }}</p>
            <h2 class="mx-auto mt-4 max-w-xl text-3xl sm:text-4xl font-medium tracking-tight leading-tight text-gray-900">
                {{ __('Prêt à booster votre visibilité ?') }}
            </h2>
            <p class="mx-auto mt-4 max-w-md text-sm text-gray-400">
                {{ __('Rejoignez la communauté des créatifs qui transforment leur passion en carrière sur Mefolio.') }}
            </p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route(auth()->check() ? 'dashboard' : 'register') }}"
                    class="inline-flex items-center rounded-full bg-gray-900 px-6 py-2.5 text-sm font-semibold text-white hover:bg-black transition">
                    {{ __('Créer mon profil') }}
                </a>
                <a href="mailto:contact@mefolio.com"
                    class="inline-flex items-center gap-1.5 rounded-full bg-white px-6 py-2.5 text-sm font-semibold text-gray-700 ring-1 ring-gray-900/10 hover:ring-gray-900/25 transition">
                    {{ __("Contacter l'équipe") }} <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
</section>

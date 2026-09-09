{{--
    Section FAQ (accordéon) + bandeau d'appel à l'action final.
    Aucune variable externe requise.
--}}
<section class="py-24 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-10 lg:gap-16 items-start">

        <div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                Questions fréquentes posées par nos créatifs.
            </h2>
            <p class="text-slate-500 mt-6 text-sm leading-relaxed max-w-xs">
                Notre équipe est toujours disponible pour des réponses rapides, claires et fiables.
            </p>
            <a href="mailto:contact@mefolio.com"
                class="inline-flex items-center gap-2 mt-8 bg-gray-900 hover:bg-black text-white text-sm font-bold px-6 py-3 rounded-full transition-all hover:scale-[1.02]">
                Contacter l'équipe
            </a>
        </div>

        <div class="space-y-3">
            @foreach ([
                ['q' => 'Comment créer mon portfolio ?', 'a' => "Le processus est instantané. Cliquez sur « S'inscrire », validez votre email et personnalisez votre espace. Pas de configuration complexe, juste votre talent mis en avant."],
                ['q' => 'Est-ce vraiment gratuit ?', 'a' => "Oui, l'accès de base et la publication de projets sont 100% gratuits. Nous croyons en l'accessibilité du talent local pour dynamiser l'écosystème tech en Afrique."],
                ['q' => 'Comment les recruteurs me trouvent-ils ?', 'a' => "Votre profil est indexé dans notre moteur de recherche de talents. Vous disposez aussi d'une URL personnalisée professionnelle que vous pouvez partager directement sur votre CV ou LinkedIn."],
                ['q' => 'Quels types de fichiers puis-je publier ?', 'a' => 'Vous pouvez importer des images (JPG, PNG), lier des dépôts GitHub pour le code, ou intégrer des liens externes comme Figma, Behance ou des vidéos de démonstration.'],
            ] as $i => $faq)
                <details class="group bg-white border border-gray-100 rounded-2xl px-6 hover:border-gray-200 transition-colors" @if ($i === 0) open @endif>
                    <summary class="flex items-center justify-between gap-4 cursor-pointer list-none py-5">
                        <h3 class="text-base font-bold text-slate-900">{{ $faq['q'] }}</h3>
                        <span class="relative flex-shrink-0 w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center">
                            <span class="absolute w-3 h-0.5 bg-gray-900 rounded-full"></span>
                            <span class="absolute w-0.5 h-3 bg-gray-900 rounded-full group-open:opacity-0 transition-opacity"></span>
                        </span>
                    </summary>
                    <div class="text-slate-500 leading-relaxed text-sm pb-5">
                        {{ $faq['a'] }}
                    </div>
                </details>
            @endforeach
        </div>

    </div>

    <div class="max-w-3xl mx-auto mt-8">
        <div class="relative overflow-hidden rounded-[2rem] p-10 sm:p-14 text-center bg-gradient-to-br from-indigo-50 via-violet-50 to-amber-50 border border-indigo-100">
            <div class="w-12 h-12 mx-auto mb-5 rounded-2xl bg-gray-900 flex items-center justify-center shadow-lg">
                <x-application-logo class="h-6 w-auto text-white" />
            </div>
            <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mb-2">Prêt à booster votre visibilité ?</h3>
            <p class="text-slate-500 text-sm max-w-sm mx-auto mb-8">
                Rejoignez la communauté des créatifs qui transforment leur passion en carrière sur Mefolio.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route(auth()->check() ? 'dashboard' : 'register') }}"
                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white text-sm font-bold px-7 py-3 rounded-full transition-all hover:scale-[1.02]">
                    Créer mon profil
                </a>
                <a href="mailto:contact@mefolio.com"
                    class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900 text-sm font-semibold px-7 py-3 rounded-full transition-all">
                    Contacter l'équipe
                </a>
            </div>
        </div>
    </div>
</section>

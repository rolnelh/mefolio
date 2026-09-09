{{--
    Section "Nos talents créatifs" — grille de x-creatif-card.
    Variables attendues : $creatifs (Collection, injectée par HomeController).
--}}
<section class="py-16 md:py-32 bg-white text-gray-900 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-24 gap-10">
            <div class="max-w-5xl">
                <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    Nos talents
                    <span class="text-blue-600">créatifs</span>
                </h2>

                <div class="mt-4 flex gap-6">
                    <p class="mt-3 text-gray-500 dark:text-gray-400 font-light max-w-md">
                        L'élite de notre communauté. Des esprits audacieux qui repoussent les limites du possible.
                    </p>
                </div>
            </div>

            <div class="pb-2">
                <a href="{{ route('creatifs.index') }}"
                    class="group inline-flex items-center gap-4 text-gray-900 font-bold uppercase tracking-[0.1em] text-[11px] transition-all">
                    <span class="relative">
                        Voir tout l'écosystème
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </span>
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-200 group-hover:border-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($creatifs as $creatif)
                <x-creatif-card :creatif="$creatif" />
            @endforeach
        </div>
    </div>

</section>

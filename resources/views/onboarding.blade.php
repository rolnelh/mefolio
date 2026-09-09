<x-guest-layout>
    <div class="min-h-screen bg-[#F4F3EF] flex items-center justify-center px-4 py-6">

        <div x-data="{ slide: 0, total: 3 }" x-cloak
            class="relative w-full max-w-md bg-white rounded-[2rem] shadow-2xl shadow-gray-900/10 overflow-hidden flex flex-col lg:max-h-[92vh]">

            {{-- Passer --}}
            <a href="{{ route('register') }}"
                class="absolute top-5 right-5 z-20 text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">
                Passer
            </a>

            {{-- Slide 1 : Portfolio --}}
            <div x-show="slide === 0" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="relative h-64 bg-gradient-to-br from-indigo-50 via-white to-violet-50 flex items-center justify-center overflow-hidden">
                    <div aria-hidden="true" class="absolute -top-8 -right-8 w-40 h-40 bg-indigo-200/40 rounded-full blur-3xl"></div>
                    <div aria-hidden="true" class="absolute -bottom-8 -left-8 w-40 h-40 bg-violet-200/40 rounded-full blur-3xl"></div>
                    <div class="relative w-28 h-28 rounded-3xl bg-gradient-to-br from-indigo-500 to-violet-500 shadow-xl shadow-indigo-200 flex items-center justify-center">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                        </svg>
                    </div>
                </div>
                <div class="px-8 pt-8 pb-6 text-center">
                    <h1 class="text-2xl font-black text-gray-900 mb-3">Construisez votre portfolio</h1>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Montrez vos meilleurs projets et faites-vous remarquer par les recruteurs et
                        clients qui comptent.
                    </p>
                </div>
            </div>

            {{-- Slide 2 : Missions --}}
            <div x-show="slide === 1" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="relative h-64 bg-gradient-to-br from-violet-50 via-white to-amber-50 flex items-center justify-center overflow-hidden">
                    <div aria-hidden="true" class="absolute -top-8 -right-8 w-40 h-40 bg-violet-200/40 rounded-full blur-3xl"></div>
                    <div aria-hidden="true" class="absolute -bottom-8 -left-8 w-40 h-40 bg-amber-200/40 rounded-full blur-3xl"></div>
                    <div class="relative w-28 h-28 rounded-3xl bg-gradient-to-br from-violet-500 to-amber-500 shadow-xl shadow-violet-200 flex items-center justify-center">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18a48.55 48.55 0 01-12.756 0C4.537 20.436 3.75 19.494 3.75 18.4v-4.25m16.5 0a2.18 2.18 0 00.75-1.653v-3.32a2.25 2.25 0 00-1.5-2.121l-6.75-2.25a2.25 2.25 0 00-1.5 0l-6.75 2.25a2.25 2.25 0 00-1.5 2.121v3.32c0 .659.281 1.244.75 1.653m16.5 0a2.18 2.18 0 01-.75 1.653m-15-1.653a2.18 2.18 0 00.75 1.653m0 0A2.25 2.25 0 007.5 18.4v-1.65m9-1.65v1.65a2.25 2.25 0 001.5 2.121M13.5 12h-3" />
                        </svg>
                    </div>
                </div>
                <div class="px-8 pt-8 pb-6 text-center">
                    <h1 class="text-2xl font-black text-gray-900 mb-3">Trouvez des missions rémunérées</h1>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Postulez à des missions freelance réelles, avec des clients qui paient en
                        Mobile Money.
                    </p>
                </div>
            </div>

            {{-- Slide 3 : Communauté --}}
            <div x-show="slide === 2" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="relative h-64 bg-gradient-to-br from-amber-50 via-white to-indigo-50 flex items-center justify-center overflow-hidden">
                    <div aria-hidden="true" class="absolute -top-8 -right-8 w-40 h-40 bg-amber-200/40 rounded-full blur-3xl"></div>
                    <div aria-hidden="true" class="absolute -bottom-8 -left-8 w-40 h-40 bg-indigo-200/40 rounded-full blur-3xl"></div>
                    <div class="relative w-28 h-28 rounded-3xl bg-gradient-to-br from-amber-500 to-indigo-500 shadow-xl shadow-amber-200 flex items-center justify-center">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                        </svg>
                    </div>
                </div>
                <div class="px-8 pt-8 pb-6 text-center">
                    <h1 class="text-2xl font-black text-gray-900 mb-3">Rejoignez une communauté qui vous valorise</h1>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Classement, Talent of the Week, challenges : votre travail est vu et
                        reconnu.
                    </p>
                </div>
            </div>

            {{-- Pagination + actions --}}
            <div class="px-8 pb-8">
                <div class="flex items-center justify-center gap-2 mb-6">
                    <template x-for="i in total" :key="i">
                        <button @click="slide = i - 1" :aria-label="'Aller à l\'étape ' + i"
                            class="h-1.5 rounded-full transition-all"
                            :class="slide === i - 1 ? 'w-6 bg-indigo-600' : 'w-1.5 bg-gray-200'"></button>
                    </template>
                </div>

                <button x-show="slide < total - 1" @click="slide++"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                    Suivant →
                </button>

                <a x-show="slide === total - 1" href="{{ route('register') }}"
                    class="w-full flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                    Créer mon compte gratuitement →
                </a>

                <p class="text-center text-sm text-gray-500 mt-4">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Se connecter</a>
                </p>
            </div>
        </div>
    </div>

    <style>
        html, body {
            scrollbar-width: none;
        }

        html::-webkit-scrollbar, body::-webkit-scrollbar {
            display: none;
        }
    </style>
</x-guest-layout>

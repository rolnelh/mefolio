<x-app-layout>
    <section class="min-h-screen bg-white dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div
                class="flex flex-col md:flex-row md:items-end justify-between mb-16 border-b border-gray-100 dark:border-gray-800 pb-8">
                <div>
                    <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight">
                        Le Mag <span class="text-indigo-600">Mefolio</span>
                    </h2>
                    <p class="mt-3 text-lg text-gray-500 dark:text-gray-400 max-w-2xl">
                        Conseils, tendances et guides pratiques pour booster votre carrière créative.
                    </p>
                </div>
                <div class="mt-6 md:mt-0">
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-bold">
                        {{ count($articles ?? [1, 2, 3, 4]) }} Articles disponibles
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                <article class="group flex flex-col">
                    <div class="relative overflow-hidden rounded-2xl mb-5">
                        <img src="https://images.pexels.com/photos/3184308/pexels-photo-3184308.jpeg" alt="Portfolio"
                            class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                Tutoriel
                            </span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-2xl font-extrabold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors duration-300">
                            Comment créer un portfolio attractif
                        </h3>
                        <p class="mt-3 text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-3">
                            Apprenez à concevoir un portfolio qui attire les recruteurs et les clients, avec des
                            conseils de design et d’organisation.
                        </p>
                    </div>
                    <a href="#"
                        class="mt-6 flex items-center text-sm font-bold text-gray-900 dark:text-white uppercase tracking-tighter hover:gap-3 transition-all">
                        Lire l'article <span class="ml-2 text-indigo-600">→</span>
                    </a>
                </article>

                <article class="group flex flex-col">
                    <div class="relative overflow-hidden rounded-2xl mb-5">
                        <img src="https://images.pexels.com/photos/3184310/pexels-photo-3184310.jpeg"
                            alt="Design Trends"
                            class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-purple-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                Actualité
                            </span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-2xl font-extrabold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors duration-300">
                            Les tendances du design en 2025
                        </h3>
                        <p class="mt-3 text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-3">
                            Découvrez les dernières tendances graphiques et web design pour rester à jour et inspirer
                            vos projets.
                        </p>
                    </div>
                    <a href="#"
                        class="mt-6 flex items-center text-sm font-bold text-gray-900 dark:text-white uppercase tracking-tighter hover:gap-3 transition-all">
                        Lire l'article <span class="ml-2 text-indigo-600">→</span>
                    </a>
                </article>

                <article class="group flex flex-col">
                    <div class="relative overflow-hidden rounded-2xl mb-5">
                        <img src="https://images.pexels.com/photos/3184312/pexels-photo-3184312.jpeg"
                            alt="Collaboration"
                            class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                        <div class="absolute top-4 left-4">
                            <span
                                class="bg-emerald-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                Guide
                            </span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="text-2xl font-extrabold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors duration-300">
                            Collaborer efficacement en ligne
                        </h3>
                        <p class="mt-3 text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-3">
                            Apprenez à organiser vos projets collaboratifs et partager vos ressources avec votre équipe.
                        </p>
                    </div>
                    <a href="#"
                        class="mt-6 flex items-center text-sm font-bold text-gray-900 dark:text-white uppercase tracking-tighter hover:gap-3 transition-all">
                        Lire l'article <span class="ml-2 text-indigo-600">→</span>
                    </a>
                </article>

            </div>

            <div class="mt-24 bg-gray-900 rounded-3xl p-8 md:p-12 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl md:text-3xl font-bold text-white">Ne manquez aucun article</h3>
                    <p class="text-gray-400 mt-2">Inscrivez-vous à notre newsletter hebdomadaire.</p>
                    <form class="mt-8 flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
                        <input type="email" placeholder="votre@email.com"
                            class="px-6 py-3 rounded-xl bg-gray-800 border-none text-white focus:ring-2 focus:ring-indigo-500">
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-xl transition-all">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>

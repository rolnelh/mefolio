<x-app-layout>
    <section class="min-h-screen bg-slate-50 dark:bg-gray-900 py-16 px-4">
        <div class="max-w-3xl mx-auto">

            <div class="mb-6">
                <a href="{{ route('dashboard') }}"
                    class="text-indigo-600 dark:text-indigo-400 text-sm font-medium flex items-center hover:underline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour au tableau de bord
                </a>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">

                <div class="bg-indigo-600 p-8 text-center relative overflow-hidden">
                    <div class="relative z-10">
                        <h1 class="text-3xl font-black text-white italic tracking-tighter">NOUVEAU PROJET</h1>
                        <p class="text-indigo-100 mt-2 font-medium">Partagez votre univers avec la communauté Mefolio
                        </p>
                    </div>
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500 rounded-full opacity-50"></div>
                </div>

                <div class="p-8 sm:p-12">
                    @if (Session::has('success'))
                        <div
                            class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 rounded-2xl flex items-center justify-between shadow-sm">
                            <div class="flex items-center">
                                <span class="text-xl mr-3">🚀</span>
                                <p class="font-bold">{{ Session::get('success') }}</p>
                            </div>
                            <a href="{{ route('userprofile.index') }}"
                                class="bg-emerald-600 text-white px-4 py-1.5 rounded-xl text-sm font-bold hover:bg-emerald-700 transition">Voir</a>
                        </div>
                    @endif

                    <form action="{{ route('projets.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf

                        <div class="space-y-2">
                            <label for="title"
                                class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">
                                <span class="mr-2 text-indigo-500">📌</span> Titre du chef-d'œuvre
                            </label>
                            <input type="text" id="title" name="title" required
                                class="w-full px-5 py-4 rounded-2xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all"
                                placeholder="Quel nom porte ce projet ?">
                        </div>

                        <div class="space-y-2">
                            <label for="description"
                                class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">
                                <span class="mr-2 text-indigo-500">📝</span> L'histoire derrière le projet
                            </label>
                            <textarea id="description" name="description" rows="5" required
                                class="w-full px-5 py-4 rounded-2xl border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:outline-none transition-all"
                                placeholder="Démarche créative, outils (Photoshop, Laravel, etc.)..."></textarea>
                        </div>

                        {{-- <div class="mb-6">
                            <label for="technologies"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-2">
                                Technologies / Outils utilisés
                            </label>
                            <div class="relative">
                                <i class="fas fa-code absolute left-4 top-4 text-gray-400"></i>
                                <input type="text" name="technologies" id="technologies"
                                    value="{{ old('technologies', $projects->technologies) }}"
                                    class="w-full rounded-2xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 pl-11 py-3 shadow-sm"
                                    placeholder="Ex: Laravel, Tailwind CSS, Figma, React...">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 italic">Séparez les outils par des virgules pour un
                                meilleur affichage.</p>
                            @error('technologies')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div class="space-y-2" x-data="{ filesCount: 0 }">
                            <label class="flex items-center text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">
                                <span class="mr-2 text-indigo-500">📁</span> Médias & Fichiers (Plusieurs choix
                                possibles)
                            </label>

                            <div class="relative group">
                                <div
                                    class="flex flex-col items-center justify-center w-full min-h-[220px] border-3 border-dashed border-gray-200 dark:border-gray-700 rounded-3xl bg-gray-50 dark:bg-gray-900 group-hover:bg-indigo-50/50 dark:group-hover:bg-indigo-900/10 group-hover:border-indigo-400 transition-all cursor-pointer">

                                    <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-sm mb-4">
                                        <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>

                                    <div class="text-center">
                                        <p class="text-base font-bold text-gray-700 dark:text-gray-200">
                                            <span
                                                x-text="filesCount === 0 ? 'Sélectionnez vos créations' : filesCount + ' fichier(s) prêt(s)'"></span>
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Images ou Vidéos (MP4,
                                            PNG, JPG)</p>
                                    </div>

                                    <input type="file" name="media[]" id="fichiers" multiple
                                        @change="filesCount = $event.target.files.length" accept="image/*,video/*"
                                        class="absolute inset-0 opacity-0 cursor-pointer" required />
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="group relative w-full flex items-center justify-center bg-indigo-600 text-white py-4 rounded-2xl font-black text-lg uppercase tracking-widest overflow-hidden transition-all hover:bg-indigo-700 shadow-xl shadow-indigo-200 dark:shadow-none active:scale-[0.98]">
                                <span class="relative z-10 flex items-center">
                                    Propulser le projet
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

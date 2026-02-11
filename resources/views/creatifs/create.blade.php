<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-gray-900 py-12 px-4 sm:px-6">
        <div
            class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700">

            <div
                class="relative h-40 bg-gradient-to-br from-indigo-600 via-purple-600 to-fuchsia-500 p-8 flex items-center">
                <div class="relative z-10">
                    <span
                        class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold text-white uppercase tracking-widest">Étape
                        1 : Identité</span>
                    <h2 class="text-3xl font-extrabold text-white tracking-tight mt-2">Créez votre profil créatif</h2>
                    <p class="text-indigo-100 text-sm mt-1">Rejoignez la communauté et exposez votre talent au monde.</p>
                </div>
                <div class="absolute right-0 bottom-0 opacity-15 p-4">
                    <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z" />
                    </svg>
                </div>
            </div>

            <div class="p-6 sm:p-10">
                <form action="{{ route('creatifs.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-10">
                    @csrf

                    <div class="space-y-6">
                        <div class="flex items-center space-x-2 pb-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600">🖼️</span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Apparence du profil</h3>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Bannière de
                                couverture</label>
                            <div
                                class="relative group h-48 w-full rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-indigo-400 bg-gray-50 dark:bg-gray-900 hover:bg-gray-100/50">
                                <div class="text-center p-6 pointer-events-none">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mt-2 text-sm font-semibold text-gray-600 dark:text-gray-400">Cliquez pour
                                        ajouter une image de fond</p>
                                    <p class="text-xs text-gray-400 mt-1">Format recommandé : 1200 x 400px</p>
                                </div>
                                <input type="file" name="couverture"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center gap-6">
                            <div class="relative group">
                                <div
                                    class="h-24 w-24 rounded-2xl bg-indigo-100 dark:bg-gray-700 flex items-center justify-center border-4 border-white dark:border-gray-800 shadow-xl overflow-hidden">
                                    <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <label
                                    class="absolute -bottom-2 -right-2 bg-indigo-600 p-2 rounded-xl text-white shadow-lg cursor-pointer hover:bg-indigo-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <input type="file" name="photo" class="hidden" accept="image/*">
                                </label>
                            </div>
                            <div class="text-center sm:text-left">
                                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Photo de profil</h4>
                                <p class="text-xs text-gray-500">Formats acceptés : JPG, PNG (Max 2Mo)</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-2 pb-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="p-2 bg-purple-50 dark:bg-purple-900/30 rounded-lg text-purple-600">👤</span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Informations de base</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Prénom</label>
                                <input type="text" name="prenom" required
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Nom</label>
                                <input type="text" name="nom" required
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Spécialité</label>
                                <input type="text" name="specialite" required placeholder="ex: Illustrateur UX"
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                            <div class="space-y-1">
                                <label
                                    class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Localisation</label>
                                <input type="text" name="localisation" required placeholder="Ville, Pays"
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-2 pb-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="p-2 bg-fuchsia-50 dark:bg-fuchsia-900/30 rounded-lg text-fuchsia-600">✍️</span>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">À propos de vous</h3>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Biographie</label>
                            <textarea name="bio" rows="4" placeholder="Décrivez votre univers créatif en quelques lignes..." required
                                class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 transition-all"></textarea>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Lien Portfolio /
                                Site</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">🌐</span>
                                <input type="url" name="portfolio_url" placeholder="https://"
                                    class="w-full pl-10 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-2xl transition-all shadow-xl shadow-indigo-200 dark:shadow-none transform hover:-translate-y-1 active:scale-[0.98]">
                            🚀 Finaliser mon inscription
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4 italic">Vous pourrez modifier ces informations
                            à tout moment depuis votre tableau de bord.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

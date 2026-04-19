<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-gray-900 py-12 px-4 sm:px-6">
        <div
            class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700">

            <div class="relative h-32 bg-gradient-to-r from-indigo-600 to-violet-700 p-8">
                <div class="relative z-10">
                    <h2 class="text-3xl font-extrabold text-white tracking-tight">Mon Espace Créatif</h2>
                    <p class="text-indigo-100 text-sm mt-1">Personnalisez votre vitrine professionnelle</p>
                </div>
                <div class="absolute top-0 right-0 p-4 opacity-20">
                    <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                </div>
            </div>

            <div class="p-6 sm:p-10">
                @if (session('success'))
                    <div
                        class="mb-8 flex items-center p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg shadow-sm">
                        <span class="mr-3 text-xl">✨</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('creatifs.update', $creatif?->id ?? 0) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div
                        class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-8 border-b border-gray-100 dark:border-gray-700">
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Identité Visuelle</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ces images seront la première chose que
                                vos clients verront.</p>
                        </div>

                        <div class="lg:col-span-2 space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Bannière
                                    de couverture</label>
                                <div
                                    class="relative group h-40 w-full rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-indigo-400 bg-gray-50 dark:bg-gray-900">
                                    @if ($creatif && $creatif->couverture)
                                        <img src="{{ asset('storage/' . $creatif->couverture) }}"
                                            class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-20 transition-opacity">
                                    @endif
                                    <div class="relative z-10 text-center p-4">
                                        <svg class="mx-auto h-10 w-10 text-gray-400 group-hover:text-indigo-500 transition-colors"
                                            stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <input type="file" name="couverture" id="couverture"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        <p class="mt-1 text-xs font-medium text-gray-600 dark:text-gray-400">Cliquez
                                            pour modifier la bannière</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-6">
                                <div class="relative group">
                                    <img src="{{ $creatif?->photo ? asset('storage/' . $creatif->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($creatif?->prenom ?? Auth::user()->username) . '&background=6366f1&color=fff' }}"
                                        class="h-20 w-20 rounded-full object-cover ring-4 ring-white dark:ring-gray-700 shadow-lg">
                                    <label
                                        class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <input type="file" name="photo" class="hidden">
                                    </label>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Avatar</h4>
                                    <p class="text-xs text-gray-500">JPG ou PNG de haute qualité</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Nom complet</label>
                            <div class="flex space-x-4">
                                <input type="text" name="prenom" value="{{ old('prenom', $creatif?->prenom) }}"
                                    placeholder="Prénom"
                                    class="flex-1 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                                <input type="text" name="nom" value="{{ old('nom', $creatif?->nom) }}"
                                    placeholder="Nom"
                                    class="flex-1 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Spécialité &
                                Titre</label>
                            <input type="text" name="specialite"
                                value="{{ old('specialite', $creatif?->specialite) }}"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">📍
                                Localisation</label>
                            <input type="text" name="localisation"
                                value="{{ old('localisation', $creatif?->localisation) }}"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">🔗 Portfolio
                                (URL)</label>
                            <input type="url" name="portfolio_url"
                                value="{{ old('portfolio_url', $creatif?->portfolio_url) }}"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        </div>

                        <div class="md:col-span-2 space-y-1">
                            <label class="text-sm font-bold text-gray-700 dark:text-gray-300 ml-1">Biographie
                                professionnelle</label>
                            <textarea name="bio" rows="5"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">{{ old('bio', $creatif?->bio) }}</textarea>
                            <p class="text-right text-xs text-gray-400">Utilisez ce texte pour convaincre vos futurs
                                partenaires.</p>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('dashboard') }}"
                            class="w-full sm:w-auto px-6 py-3 text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-900 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:-translate-y-0.5">
                            Sauvegarder les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

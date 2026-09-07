<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <aside class="w-full lg:w-72 flex-shrink-0 lg:sticky lg:top-24">
                <x-dashboard-sidebar active="profil" />
            </aside>

            <main class="flex-1 min-w-0">
                <form action="{{ route('creatifs.update', $creatif?->id ?? 0) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">

                        {{-- Barre d'en-tête sticky : titre + actions --}}
                        <div class="flex items-center justify-between gap-4 px-6 sm:px-8 py-5 border-b border-gray-100 dark:border-gray-800">
                            <div>
                                <h1 class="text-lg font-black text-gray-900 dark:text-white">Mon profil créatif</h1>
                                <p class="text-xs text-gray-400 mt-0.5">Personnalisez votre vitrine professionnelle</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('dashboard') }}"
                                    class="px-4 py-2 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl transition-all">
                                    Annuler
                                </a>
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                                    Enregistrer
                                </button>
                            </div>
                        </div>

                        {{-- Identité visuelle --}}
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 px-6 sm:px-8 py-8 border-b border-gray-100 dark:border-gray-800">
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white">Identité visuelle</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ces images seront la première
                                    chose que vos clients verront.</p>
                            </div>

                            <div class="lg:col-span-2 space-y-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2">Bannière
                                        de couverture</label>
                                    <div
                                        class="relative group h-36 w-full rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center overflow-hidden transition-all hover:border-indigo-400 bg-gray-50 dark:bg-gray-950">
                                        @if ($creatif && $creatif->couverture)
                                            <img src="{{ $creatif->couverture }}"
                                                class="absolute inset-0 w-full h-full object-cover opacity-40 group-hover:opacity-20 transition-opacity">
                                        @endif
                                        <div class="relative z-10 text-center p-4">
                                            <svg class="mx-auto h-8 w-8 text-gray-400 group-hover:text-indigo-500 transition-colors"
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

                                <div class="flex items-center gap-5">
                                    <div class="relative group flex-shrink-0">
                                        <div
                                            class="w-16 h-16 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm">
                                            <img src="{{ $creatif?->photo ?: asset('images/avatar.webp') }}"
                                                class="w-full h-full object-cover" alt="Photo de profil">
                                        </div>
                                        <label
                                            class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
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
                                        <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Photo de profil</h4>
                                        <p class="text-xs text-gray-500">JPG ou PNG de haute qualité</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Informations --}}
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 px-6 sm:px-8 py-8 border-b border-gray-100 dark:border-gray-800">
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white">Informations</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Comment vous présenter aux
                                    clients et autres créatifs.</p>
                            </div>

                            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Prénom</label>
                                    <input type="text" name="prenom" value="{{ old('prenom', $creatif?->prenom) }}"
                                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-950 focus:border-indigo-500 focus:ring-indigo-500 transition-all text-sm">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Nom</label>
                                    <input type="text" name="nom" value="{{ old('nom', $creatif?->nom) }}"
                                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-950 focus:border-indigo-500 focus:ring-indigo-500 transition-all text-sm">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Spécialité &
                                        titre</label>
                                    <input type="text" name="specialite"
                                        value="{{ old('specialite', $creatif?->specialite) }}"
                                        placeholder="Ex : Designer UI/UX"
                                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-950 focus:border-indigo-500 focus:ring-indigo-500 transition-all text-sm">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-700 dark:text-gray-300">Localisation</label>
                                    <input type="text" name="localisation"
                                        value="{{ old('localisation', $creatif?->localisation) }}"
                                        placeholder="Ex : Cotonou, Bénin"
                                        class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-950 focus:border-indigo-500 focus:ring-indigo-500 transition-all text-sm">
                                </div>

                                <label
                                    class="sm:col-span-2 flex items-center justify-between gap-4 p-4 bg-gray-50 dark:bg-gray-950 rounded-xl cursor-pointer">
                                    <span class="flex-1">
                                        <span class="block text-sm font-semibold text-gray-900 dark:text-white">Disponible
                                            pour de nouvelles missions</span>
                                        <span class="block text-xs text-gray-400 mt-0.5">Affiché sur votre profil
                                            public</span>
                                    </span>
                                    <span class="relative inline-flex flex-shrink-0">
                                        <input type="checkbox" name="available_for_work" value="1"
                                            @checked(old('available_for_work', $creatif?->available_for_work ?? true))
                                            class="peer sr-only">
                                        <span
                                            class="w-10 h-6 bg-gray-200 dark:bg-gray-700 rounded-full transition-all peer-checked:bg-indigo-600"></span>
                                        <span
                                            class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full shadow transition-all peer-checked:translate-x-4"></span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 px-6 sm:px-8 py-8 border-b border-gray-100 dark:border-gray-800">
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white">Biographie</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Convainquez vos futurs
                                    partenaires en quelques phrases.
                                    <a href="{{ route('dashboard', ['tab' => 'assistant']) }}"
                                        class="text-indigo-600 font-semibold hover:underline">Besoin d'aide ? Demandez à
                                        l'assistant IA.</a>
                                </p>
                            </div>
                            <div class="lg:col-span-2">
                                <textarea name="bio" rows="5"
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-950 focus:border-indigo-500 focus:ring-indigo-500 transition-all text-sm">{{ old('bio', $creatif?->bio) }}</textarea>
                            </div>
                        </div>

                        {{-- Portfolio --}}
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 px-6 sm:px-8 py-8">
                            <div class="lg:col-span-1">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white">Portfolio</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Un lien externe vers vos
                                    réalisations (Behance, site perso...).</p>
                            </div>
                            <div class="lg:col-span-2 space-y-1">
                                <label class="text-xs font-bold text-gray-700 dark:text-gray-300">URL du portfolio</label>
                                <input type="url" name="portfolio_url"
                                    value="{{ old('portfolio_url', $creatif?->portfolio_url) }}"
                                    placeholder="https://..."
                                    class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-950 focus:border-indigo-500 focus:ring-indigo-500 transition-all text-sm">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-3 mt-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl transition-all">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </main>

        </div>
    </div>
</x-app-layout>

{{-- <x-app-layout>
    <div class="min-h-screen bg-gray-50/40 py-10 px-4">
        <div class="max-w-3xl mx-auto">

            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour au tableau de bord
            </a>

            <div class="mb-8">
                <h1 class="text-3xl font-black text-gray-900">Mon espace créatif <span class="text-indigo-600">.</span>
                </h1>
                <p class="text-gray-400 text-sm mt-1">Personnalisez votre vitrine professionnelle.</p>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-semibold">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('creatifs.update', $creatif?->id ?? 0) }}" method="POST"
                enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Identité visuelle</h2>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-2">Bannière de couverture</label>
                        <div
                            class="relative h-40 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 hover:border-indigo-300 transition-all overflow-hidden cursor-pointer">
                            @if ($creatif && $creatif->couverture)
                                <img src="{{ $creatif->couverture }}"
                                    class="absolute inset-0 w-full h-full object-cover opacity-50">
                            @endif
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <svg class="w-7 h-7 text-gray-400 mb-1.5" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <p class="text-xs font-semibold text-gray-500">
                                    {{ $creatif && $creatif->couverture ? 'Changer la bannière' : 'Ajouter une bannière' }}
                                </p>
                            </div>
                            <input type="file" name="couverture" accept="image/*"
                                class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <div class="flex items-center gap-5">
                        <div class="relative flex-shrink-0">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-gray-100 bg-indigo-50">
                                <img src="{{ $creatif?->photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($creatif?->prenom ?? 'M') . '&background=6366f1&color=fff&size=200' }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <label
                                class="absolute -bottom-2 -right-2 w-7 h-7 bg-indigo-600 rounded-xl flex items-center justify-center cursor-pointer hover:bg-indigo-700 transition-colors shadow-md">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <input type="file" name="photo" accept="image/*" class="hidden">
                            </label>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-700">Photo de profil</p>
                            <p class="text-xs text-gray-400 mt-0.5">JPG ou PNG · Haute qualité recommandée</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-5">Informations</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom', $creatif?->prenom) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom', $creatif?->nom) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Spécialité</label>
                            <input type="text" name="specialite"
                                value="{{ old('specialite', $creatif?->specialite) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Localisation</label>
                            <input type="text" name="localisation"
                                value="{{ old('localisation', $creatif?->localisation) }}" placeholder="Cotonou, Bénin"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Biographie
                                professionnelle</label>
                            <textarea name="bio" rows="5"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ old('bio', $creatif?->bio) }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Lien Portfolio</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm">🌐</span>
                                <input type="url" name="portfolio_url"
                                    value="{{ old('portfolio_url', $creatif?->portfolio_url) }}"
                                    placeholder="https://monportfolio.com"
                                    class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="md:col-span-2" x-data="{
                            skills: {{ json_encode($creatif?->skills ?? []) }},
                            input: '',
                            add() { const v = this.input.trim(); if (v && !this.skills.includes(v) && this.skills.length < 15) { this.skills.push(v);
                                    this.input = ''; } },
                            remove(i) { this.skills.splice(i, 1); }
                        }">
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Stack & Compétences</label>
                            <input type="hidden" name="skills" :value="JSON.stringify(skills)">
                            <div
                                class="flex flex-wrap gap-2 p-3 bg-gray-50 border border-gray-200 rounded-xl min-h-[52px] focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-transparent">
                                <template x-for="(skill, i) in skills" :key="i">
                                    <span
                                        class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-1.5 rounded-full border border-indigo-100">
                                        <span x-text="skill"></span>
                                        <button type="button" @click="remove(i)"
                                            class="text-indigo-300 hover:text-red-500 ml-0.5 text-sm leading-none">×</button>
                                    </span>
                                </template>
                                <input type="text" x-model="input" @keydown.enter.prevent="add()"
                                    @keydown.comma.prevent="add()" placeholder="Figma, React, Laravel... + Entrée"
                                    class="flex-1 min-w-[180px] bg-transparent border-none outline-none text-sm text-gray-700 placeholder:text-gray-300 py-1">
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5">Entrée ou virgule pour ajouter · Max 15</p>
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="flex items-center gap-4 p-4 bg-green-50 border border-green-200 rounded-xl cursor-pointer hover:bg-green-100/50 transition-all">
                                <input type="checkbox" name="available_for_work" value="1"
                                    {{ $creatif?->available_for_work ?? true ? 'checked' : '' }}
                                    class="w-5 h-5 rounded text-green-600 focus:ring-green-500">
                                <div>
                                    <p class="text-sm font-bold text-gray-900">✅ Disponible pour des missions</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Badge vert visible sur votre profil public
                                    </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-3 text-sm font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-indigo-200 hover:scale-105">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> --}}


<x-app-layout>
    <div class="min-h-screen bg-slate-50 dark:bg-gray-900 py-12 px-4 sm:px-6">
        <div
            class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700">

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
                                        <img src="{{ $creatif->couverture }}"
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
                                    <div
                                        class="w-24 h-24 rounded-full overflow-hidden border-2 border-gray-100 dark:border-gray-700 shadow-sm">
                                        <img src="{{ $creatif->photo ?: 'https://via.placeholder.com/400x250' }}"
                                            class="w-full h-full object-cover" alt="Current Image">
                                    </div>

                                    <label
                                        class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity border-2 border-transparent">
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

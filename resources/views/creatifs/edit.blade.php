<x-app-layout>
    <div class="min-h-screen bg-gray-50/40 py-10 px-4">
        <div class="max-w-3xl mx-auto">

            {{-- Back --}}
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

                {{-- Identité visuelle --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Identité visuelle</h2>

                    {{-- Couverture --}}
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

                    {{-- Photo --}}
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

                {{-- Informations --}}
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

                        {{-- Skills --}}
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

                        {{-- Disponibilité --}}
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

                {{-- Actions --}}
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
</x-app-layout>

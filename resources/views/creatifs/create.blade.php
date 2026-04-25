<x-app-layout>
    <div class="min-h-screen bg-gray-50/40 py-10 px-4">
        <div class="max-w-2xl mx-auto">

            {{-- Header --}}
            <div class="bg-gradient-to-br from-indigo-600 to-violet-600 rounded-3xl p-8 mb-6 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full"></div>
                <div class="relative z-10">
                    <span
                        class="inline-block bg-white/10 border border-white/20 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">
                        Étape 1 sur 1 — Profil créatif
                    </span>
                    <h1 class="text-3xl font-black text-white">Créez votre profil créatif</h1>
                    <p class="text-indigo-200 text-sm mt-2">Rejoignez la communauté et exposez votre talent au monde
                        africain et international.</p>
                </div>
            </div>

            <form action="{{ route('creatifs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Photos --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Identité visuelle</h2>

                    {{-- Couverture --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-2">Bannière de couverture</label>
                        <div class="relative h-36 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 hover:bg-indigo-50/20 hover:border-indigo-300 transition-all overflow-hidden cursor-pointer"
                            x-data="{ preview: null }">
                            <template x-if="preview">
                                <img :src="preview"
                                    class="absolute inset-0 w-full h-full object-cover opacity-60">
                            </template>
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <p class="text-xs font-semibold text-gray-500">Cliquez pour ajouter une bannière</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">Recommandé : 1200 × 400 px</p>
                            </div>
                            <input type="file" name="couverture" accept="image/*"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>

                    {{-- Photo profil --}}
                    <div class="flex items-center gap-5" x-data="{ preview: null }">
                        <div class="relative flex-shrink-0">
                            <div
                                class="w-20 h-20 rounded-2xl bg-indigo-50 border-2 border-gray-100 overflow-hidden flex items-center justify-center">
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!preview">
                                    <svg class="w-9 h-9 text-indigo-300" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </template>
                            </div>
                            <label
                                class="absolute -bottom-2 -right-2 w-7 h-7 bg-indigo-600 rounded-xl flex items-center justify-center cursor-pointer shadow-md hover:bg-indigo-700 transition-colors">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor"
                                    stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                <input type="file" name="photo" accept="image/*"
                                    @change="preview = URL.createObjectURL($event.target.files[0])" class="hidden">
                            </label>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-700">Photo de profil</p>
                            <p class="text-xs text-gray-400 mt-0.5">JPG ou PNG · Haute qualité</p>
                        </div>
                    </div>
                </div>

                {{-- Infos --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Informations</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Prénom</label>
                            <input type="text" name="prenom" required value="{{ old('prenom') }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('prenom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Nom</label>
                            <input type="text" name="nom" required value="{{ old('nom') }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('nom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Spécialité</label>
                            <input type="text" name="specialite" required value="{{ old('specialite') }}"
                                placeholder="Ex: UI/UX Designer"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('specialite')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Localisation</label>
                            <input type="text" name="localisation" required value="{{ old('localisation') }}"
                                placeholder="Cotonou, Bénin"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('localisation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">Biographie</label>
                        <textarea name="bio" rows="4" required placeholder="Décrivez votre univers créatif en quelques lignes..."
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ old('bio') }}</textarea>
                        @error('bio')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">Lien Portfolio / Site</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm">🌐</span>
                            <input type="url" name="portfolio_url" value="{{ old('portfolio_url') }}"
                                placeholder="https://monportfolio.com"
                                class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        @error('portfolio_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm rounded-2xl transition-all shadow-lg shadow-indigo-200 hover:scale-[1.01] active:scale-95">
                    🚀 Finaliser mon profil
                </button>
                <p class="text-center text-xs text-gray-400">Modifiable à tout moment depuis votre tableau de bord.</p>
            </form>
        </div>
    </div>
</x-app-layout>

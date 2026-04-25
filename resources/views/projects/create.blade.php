<x-app-layout>
    <div class="min-h-screen bg-gray-50/40 py-10 px-4">
        <div class="max-w-2xl mx-auto">

            {{-- Back --}}
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour au tableau de bord
            </a>

            {{-- Header --}}
            <div class="bg-gradient-to-br from-indigo-600 to-violet-600 rounded-3xl p-8 mb-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2">
                </div>
                <div class="relative z-10">
                    <span
                        class="inline-flex items-center gap-1.5 bg-white/10 border border-white/20 text-white text-xs font-bold px-3 py-1 rounded-full mb-4">
                        ✨ Nouveau projet
                    </span>
                    <h1 class="text-3xl font-black text-white leading-tight">Partagez votre<br>réalisation</h1>
                    <p class="text-indigo-200 text-sm mt-2">Montrez ce que vous savez faire à la communauté Mefolio.</p>
                </div>
            </div>

            @if (Session::has('success'))
                <div
                    class="mb-6 flex items-center justify-between p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🚀</span>
                        <span class="font-semibold text-sm">{{ Session::get('success') }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('projets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Titre --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">
                        📌 Titre du projet
                    </label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                        placeholder="Ex: Refonte UI d'une app mobile fintech"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    @error('title')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">
                        📝 Description du projet
                    </label>
                    <textarea name="description" rows="5" required
                        placeholder="Décrivez votre démarche créative, les outils utilisés, les défis relevés..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catégorie + Technologies --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">
                        🎯 Catégorie & Technologies
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <select name="category"
                            class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">-- Catégorie --</option>
                            <option value="Design">🎨 Design / UI-UX</option>
                            <option value="Web">💻 Développement Web</option>
                            <option value="Mobile">📱 Application Mobile</option>
                            <option value="Photo">📸 Photographie</option>
                            <option value="Video">🎥 Vidéo & Montage</option>
                            <option value="Branding">🏷️ Branding</option>
                            <option value="Autre">🔧 Autre</option>
                        </select>
                        <input type="text" name="technologies" value="{{ old('technologies') }}"
                            placeholder="Figma, Laravel, React..."
                            class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                {{-- Liens --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">
                        🔗 Liens (optionnel)
                    </label>
                    <div class="space-y-3">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🌐</span>
                            <input type="url" name="lien_site" value="{{ old('lien_site') }}"
                                placeholder="https://mon-projet.com"
                                class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">⚙️</span>
                            <input type="url" name="lien_github" value="{{ old('lien_github') }}"
                                placeholder="https://github.com/..."
                                class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                {{-- Médias --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm" x-data="{ count: 0, previews: [] }">
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">
                        📁 Médias du projet
                    </label>
                    <div class="relative">
                        <div
                            class="flex flex-col items-center justify-center min-h-[180px] border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50 hover:bg-indigo-50/30 hover:border-indigo-300 transition-all cursor-pointer">
                            <div class="text-center px-6 py-8 pointer-events-none">
                                <div
                                    class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-gray-700"
                                    x-text="count === 0 ? 'Glissez vos fichiers ou cliquez pour sélectionner' : count + ' fichier(s) sélectionné(s)'">
                                </p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, MP4 — Max 10 Mo par fichier</p>
                            </div>
                            <input type="file" name="media[]" multiple @change="count = $event.target.files.length"
                                accept="image/*,video/*" class="absolute inset-0 opacity-0 cursor-pointer" required>
                        </div>
                    </div>
                    @error('media')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm rounded-2xl transition-all shadow-lg shadow-indigo-200 hover:scale-[1.01] active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    Publier le projet
                </button>

                <p class="text-center text-xs text-gray-400">
                    Votre projet sera visible sur votre profil public après publication.
                </p>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="min-h-screen bg-gray-50/40 py-10 px-4">
        <div class="max-w-5xl mx-auto">

            {{-- Back --}}
            <a href="{{ route('projects.show', $project->slug) }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour au projet
            </a>

            <div class="mb-8">
                <h1 class="text-3xl font-black text-gray-900">Modifier le projet <span class="text-indigo-600">.</span>
                </h1>
                <p class="text-gray-400 text-sm mt-1">Mettez à jour vos informations et médias.</p>
            </div>

            <form action="{{ route('projets.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-5 items-start">

                    {{-- Colonne gauche : contenu --}}
                    <div class="space-y-5 min-w-0">

                        {{-- Infos principales --}}
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm space-y-5">
                            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Informations</h2>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1.5">Titre du projet</label>
                                <input type="text" name="title" value="{{ old('title', $project->title) }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1.5">Description</label>
                                <textarea name="description" rows="6"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 mb-1.5">Catégorie</label>
                                    <select name="category"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        @foreach (['Design' => 'Design / UI-UX', 'Web' => 'Développement Web', 'Mobile' => 'App Mobile', 'Photo' => 'Photo', 'Video' => 'Vidéo', 'Branding' => 'Branding', 'Autre' => 'Autre'] as $val => $label)
                                            <option value="{{ $val }}"
                                                {{ ($project->category ?? '') === $val ? 'selected' : '' }}>{{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 mb-1.5">Technologies</label>
                                    <x-tech-tag-input :value="old('technologies', $project->technologies)"
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                            </div>
                        </div>

                        {{-- Liens --}}
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Liens</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="relative">
                                    <input type="url" name="lien_site"
                                        value="{{ old('lien_site', $project->lien_site) }}"
                                        placeholder="https://mon-projet.com"
                                        class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div class="relative">
                                    <input type="url" name="lien_github"
                                        value="{{ old('lien_github', $project->lien_github) }}"
                                        placeholder="https://github.com/..."
                                        class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Colonne droite : visuels --}}
                    <div class="space-y-5 min-w-0">
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-5">Visuels</h2>

                            {{-- Couverture : cliquer pour remplacer, avec aperçu --}}
                            <div x-data="{ preview: null }" class="mb-5">
                                <p class="text-xs font-bold text-gray-400 mb-2">Couverture</p>
                                <div class="relative group w-full h-40 rounded-2xl overflow-hidden border border-gray-100 bg-gray-50">
                                    @if ($project->image)
                                        <img x-show="!preview" src="{{ $project->image }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                    <img x-show="preview" x-cloak :src="preview"
                                        class="w-full h-full object-cover">
                                    <label
                                        class="absolute inset-0 flex flex-col items-center justify-center bg-black/0 group-hover:bg-black/40 cursor-pointer transition-all">
                                        <span
                                            class="opacity-0 group-hover:opacity-100 inline-flex items-center gap-1.5 bg-white/90 text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm transition-opacity">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Changer la couverture
                                        </span>
                                        <input type="file" name="image" accept="image/*" class="hidden"
                                            @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
                                    </label>
                                </div>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Galerie actuelle : retirer un fichier --}}
                            @if ($project->fichiers && count(json_decode($project->fichiers, true) ?? []) > 0)
                                <div x-data="{ removed: [] }" class="mb-5">
                                    <p class="text-xs font-bold text-gray-400 mb-2">Galerie</p>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach (json_decode($project->fichiers, true) as $file)
                                            @php
                                                $ext = strtolower(pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION));
                                                $isVideo = in_array($ext, ['mp4', 'mov', 'webm']);
                                            @endphp
                                            <div x-show="!removed.includes({{ json_encode($file) }})"
                                                class="relative aspect-square rounded-xl overflow-hidden border border-gray-100 group/item">
                                                @if ($isVideo)
                                                    <video src="{{ $file }}" class="w-full h-full object-cover"></video>
                                                @else
                                                    <img src="{{ $file }}" class="w-full h-full object-cover">
                                                @endif
                                                <button type="button" @click="removed.push({{ json_encode($file) }})"
                                                    class="absolute top-1 right-1 w-5 h-5 flex items-center justify-center rounded-full bg-black/60 text-white opacity-0 group-hover/item:opacity-100 hover:bg-red-500 transition-all text-xs leading-none">
                                                    &times;
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <template x-for="url in removed" :key="url">
                                        <input type="hidden" name="remove_fichiers[]" :value="url">
                                    </template>
                                </div>
                            @endif

                            {{-- Upload nouveaux fichiers --}}
                            <div x-data="{ count: 0 }" class="relative">
                                <p class="text-xs font-bold text-gray-400 mb-2">Ajouter des médias</p>
                                <div
                                    class="flex items-center justify-center min-h-[100px] border-2 border-dashed border-gray-200 rounded-xl bg-gray-50 hover:bg-indigo-50/20 hover:border-indigo-300 transition-all cursor-pointer">
                                    <div class="text-center py-5 pointer-events-none">
                                        <p class="text-sm font-semibold text-gray-500"
                                            x-text="count === 0 ? '+ Ajouter des photos ou vidéos' : count + ' fichiers sélectionnés'">
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5">JPG, PNG, MP4</p>
                                    </div>
                                    <input type="file" name="media[]" multiple accept="image/*,video/*"
                                        @change="count = $event.target.files.length"
                                        class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="lg:col-span-2 flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('projects.show', $project->slug) }}"
                            class="px-6 py-3 text-sm font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-indigo-200 hover:scale-105">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="min-h-screen bg-gray-50/40 py-10 px-4">
        <div class="max-w-3xl mx-auto">

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

            <form action="{{ route('projets.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf
                @method('PUT')

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
                                @foreach (['Design' => '🎨 Design / UI-UX', 'Web' => '💻 Développement Web', 'Mobile' => '📱 App Mobile', 'Photo' => '📸 Photo', 'Video' => '🎥 Vidéo', 'Branding' => '🏷️ Branding', 'Autre' => '🔧 Autre'] as $val => $label)
                                    <option value="{{ $val }}"
                                        {{ ($project->category ?? '') === $val ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1.5">Technologies</label>
                            <input type="text" name="technologies"
                                value="{{ old('technologies', $project->technologies) }}"
                                placeholder="Figma, Laravel, React..."
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                {{-- Liens --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Liens</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm">🌐</span>
                            <input type="url" name="lien_site" value="{{ old('lien_site', $project->lien_site) }}"
                                placeholder="https://mon-projet.com"
                                class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm">⚙️</span>
                            <input type="url" name="lien_github"
                                value="{{ old('lien_github', $project->lien_github) }}"
                                placeholder="https://github.com/..."
                                class="w-full pl-9 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                {{-- Visuels --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-5">Visuels</h2>

                    {{-- Image actuelle --}}
                    @if ($project->image)
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 mb-2">Couverture actuelle</p>
                            <div class="relative w-full h-48 rounded-2xl overflow-hidden border border-gray-100">
                                <img src="{{ $project->image }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

                    {{-- Galerie actuelle --}}
                    @if ($project->fichiers && count(json_decode($project->fichiers, true) ?? []) > 0)
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 mb-2">Galerie actuelle</p>
                            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                @foreach (json_decode($project->fichiers, true) as $file)
                                    @php
                                        $ext = strtolower(pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION));
                                        $isVideo = in_array($ext, ['mp4', 'mov', 'webm']);
                                    @endphp
                                    <div class="aspect-square rounded-xl overflow-hidden border border-gray-100">
                                        @if ($isVideo)
                                            <video src="{{ $file }}"
                                                class="w-full h-full object-cover"></video>
                                        @else
                                            <img src="{{ $file }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
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

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('projects.show', $project->slug) }}"
                        class="px-6 py-3 text-sm font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-indigo-200 hover:scale-105">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

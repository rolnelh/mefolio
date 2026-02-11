<x-app-layout>
    <div class="bg-gray-50/50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4">

            <div class="mb-8">
                <a href="{{ route('projects.show', $project->slug) }}"
                    class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Annuler et retourner au projet
                </a>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Modifier le projet <span
                        class="text-indigo-600">.</span></h1>
                <p class="text-gray-500 mt-2">Mettez à jour les détails, les images ou les liens de votre réalisation.
                </p>
            </div>

            <form action="{{ route('projets.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">

                    <div>
                        <label for="title"
                            class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Titre du
                            projet</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}"
                            class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm px-4 py-3"
                            placeholder="Ex: Refonte Dashboard SaaS">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description"
                            class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Description
                            détaillée</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm px-4 py-3"
                            placeholder="Expliquez votre démarche, les défis et les solutions apportées...">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="technologies"
                                class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Technologies
                                (séparées par des virgules)</label>
                            <input type="text" name="technologies" id="technologies" {{-- value="{{ old('technologies', $project->technologies) }}" --}}
                                value="Technologies "
                                class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm px-4 py-3"
                                placeholder="Laravel, Tailwind, React...">
                        </div>

                        <div>
                            <label for="category"
                                class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Catégorie</label>
                            <select name="category" id="category"
                                class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm px-4 py-3">
                                <option value="Web">Développement
                                    Web</option>
                                <option value="Design">Design /
                                    UI-UX</option>
                                <option value="Mobile">
                                    Application Mobile</option>
                                <option value="Autre">Autre
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-8">
                    <h3 class="text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest">Visuels du
                        projet</h3>

                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-1/3">
                            <span class="block text-xs font-bold text-gray-400 mb-2 uppercase">Couverture
                                actuelle</span>
                            <div
                                class="aspect-video rounded-2xl overflow-hidden border border-gray-100 shadow-inner bg-gray-50">
                                <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/400x250' }}"
                                    class="w-full h-full object-cover" alt="Current Image">
                            </div>
                        </div>

                        {{-- <div class="w-full md:w-2/3">
                            <span class="block text-xs font-bold text-gray-400 mb-2 uppercase">Remplacer la
                                couverture</span>
                            <div class="relative group">
                                <input type="file" name="image" id="image"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div
                                    class="border-2 border-dashed border-gray-200 group-hover:border-indigo-400 rounded-2xl p-8 text-center transition-colors">
                                    <svg class="w-8 h-8 mx-auto text-gray-400 group-hover:text-indigo-500 mb-2"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-sm text-gray-500">Cliquez pour <span
                                            class="font-bold text-indigo-600">changer la couverture</span></p>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <hr class="border-gray-100 dark:border-gray-700">

                    <div class="space-y-4">
                        <span class="block text-xs font-bold text-gray-400 uppercase">Galerie photos & vidéos</span>

                        @if ($project->fichiers)
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-4 mb-4">
                                @foreach (json_decode($project->fichiers) as $file)
                                    <div
                                        class="relative aspect-square rounded-xl overflow-hidden border border-gray-200">
                                        @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['mp4', 'mov', 'webm']))
                                            <video src="{{ asset('storage/' . $file) }}"
                                                class="w-full h-full object-cover"></video>
                                        @else
                                            <img src="{{ asset('storage/' . $file) }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="relative group" x-data="{ count: 0 }">
                            <input type="file" name="media[]" multiple accept="image/*,video/*"
                                @change="count = $event.target.files.length"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div
                                class="border-2 border-dashed border-gray-200 group-hover:border-indigo-400 rounded-2xl p-6 text-center transition-colors bg-gray-50/50 dark:bg-gray-900/20">
                                <p class="text-sm text-gray-500 font-medium">
                                    <span
                                        x-text="count === 0 ? '+ Ajouter des photos ou vidéos à la galerie' : count + ' nouveaux fichiers sélectionnés'"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                    <h3 class="text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Liens du projet</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="relative">
                                <i class="fas fa-link absolute left-4 top-4 text-gray-400"></i>
                                <input type="url" name="lien_site"
                                    value="{{ old('lien_site', $project->lien_site) }}"
                                    class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 pl-11 py-3"
                                    placeholder="Lien du site (https://...)">
                            </div>
                        </div>
                        <div>
                            <div class="relative">
                                <i class="fab fa-github absolute left-4 top-4 text-gray-400"></i>
                                <input type="url" name="lien_github"
                                    value="{{ old('lien_github', $project->lien_github) }}"
                                    class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 pl-11 py-3"
                                    placeholder="Lien GitHub (https://...)">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <button type="reset"
                        class="px-8 py-4 text-sm font-bold text-gray-500 hover:text-gray-700 transition">
                        Réinitialiser
                    </button>
                    <button type="submit"
                        class="px-10 py-4 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        Enregistrer les modifications
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

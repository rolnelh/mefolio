@csrf
<div class="space-y-5 max-w-3xl">
    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Titre</label>
        <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Catégorie</label>
            <input type="text" name="category" value="{{ old('category', $post->category ?? '') }}" placeholder="Design, Freelance, Développement..."
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Temps de lecture (min)</label>
            <input type="number" min="1" max="60" name="reading_minutes" value="{{ old('reading_minutes', $post->reading_minutes ?? 4) }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Image de couverture (URL)</label>
        <input type="url" name="cover_image" value="{{ old('cover_image', $post->cover_image ?? '') }}" placeholder="https://..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Extrait</label>
        <textarea name="excerpt" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Contenu</label>
        <textarea name="body" rows="12" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('body', $post->body ?? '') }}</textarea>
    </div>

    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
        <input type="checkbox" name="publish" value="1" @checked(old('publish', ($post->status ?? '') === 'published'))
            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
        Publier immédiatement
    </label>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Enregistrer
        </button>
        <a href="{{ route('admin.posts.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Annuler</a>
    </div>
</div>

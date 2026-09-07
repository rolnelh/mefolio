@csrf
<div class="space-y-5 max-w-3xl">
    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Titre</label>
        <input type="text" name="title" value="{{ old('title', $challenge->title ?? '') }}" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Sponsor</label>
            <input type="text" name="sponsor" value="{{ old('sponsor', $challenge->sponsor ?? '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Récompense</label>
            <input type="text" name="prize" value="{{ old('prize', $challenge->prize ?? '') }}" placeholder="Ex : 100 000 FCFA"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Catégorie</label>
            <input type="text" name="category" value="{{ old('category', $challenge->category ?? '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Date limite</label>
            <input type="date" name="deadline" value="{{ old('deadline', isset($challenge->deadline) ? $challenge->deadline?->format('Y-m-d') : '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Image (URL)</label>
        <input type="url" name="image" value="{{ old('image', $challenge->image ?? '') }}" placeholder="https://..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Description</label>
        <textarea name="description" rows="6" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $challenge->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Statut</label>
        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="open" @selected(old('status', $challenge->status ?? 'open') === 'open')>Ouvert</option>
            <option value="closed" @selected(old('status', $challenge->status ?? '') === 'closed')>Fermé</option>
        </select>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Enregistrer
        </button>
        <a href="{{ route('admin.challenges.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Annuler</a>
    </div>
</div>

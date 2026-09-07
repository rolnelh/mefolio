@csrf
<div class="space-y-5 max-w-3xl">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Nom court</label>
            <input type="text" name="name" value="{{ old('name', $program->name ?? '') }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Nom complet</label>
            <input type="text" name="full_name" value="{{ old('full_name', $program->full_name ?? '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Pays</label>
            <input type="text" name="country" value="{{ old('country', $program->country ?? '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Type</label>
            <input type="text" name="type" value="{{ old('type', $program->type ?? '') }}" placeholder="Incubateur, Accélérateur..."
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Site officiel (URL)</label>
        <input type="url" name="url" value="{{ old('url', $program->url ?? '') }}" placeholder="https://..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Tags (séparés par des virgules)</label>
        <input type="text" name="tags" value="{{ old('tags', isset($program) ? implode(', ', $program->tags ?? []) : '') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Description</label>
        <textarea name="description" rows="5" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $program->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
            <input type="checkbox" name="featured" value="1" @checked(old('featured', $program->featured ?? false))
                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Mettre en avant (programme phare)
        </label>
        <select name="status" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="active" @selected(old('status', $program->status ?? 'active') === 'active')>Actif</option>
            <option value="archived" @selected(old('status', $program->status ?? '') === 'archived')>Archivé</option>
        </select>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Enregistrer
        </button>
        <a href="{{ route('admin.programs.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Annuler</a>
    </div>
</div>

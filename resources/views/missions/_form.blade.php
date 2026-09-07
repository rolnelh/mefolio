@csrf
<div class="space-y-5">
    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Titre de la mission</label>
        <input type="text" name="title" value="{{ old('title', $mission->title ?? '') }}" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Domaine</label>
        <input type="text" name="domaine" value="{{ old('domaine', $mission->domaine ?? '') }}" required placeholder="Design, Développement Web, Photographie..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Description</label>
        <textarea name="description" rows="6" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $mission->description ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Budget min (FCFA)</label>
            <input type="number" min="0" name="budget_min" value="{{ old('budget_min', $mission->budget_min ?? '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Budget max (FCFA)</label>
            <input type="number" min="0" name="budget_max" value="{{ old('budget_max', $mission->budget_max ?? '') }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Durée</label>
            <input type="text" name="duree" value="{{ old('duree', $mission->duree ?? '') }}" placeholder="1 semaine, 2 mois..."
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Niveau recherché</label>
            <select name="niveau" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Tous niveaux</option>
                @foreach (['Junior', 'Intermédiaire', 'Senior'] as $niveau)
                    <option value="{{ $niveau }}" @selected(old('niveau', $mission->niveau ?? '') === $niveau)>{{ $niveau }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Lieu</label>
        <input type="text" name="lieu" value="{{ old('lieu', $mission->lieu ?? '') }}" placeholder="Cotonou, Dakar, Remote..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Compétences (séparées par des virgules)</label>
        <input type="text" name="tags" value="{{ old('tags', isset($mission) ? implode(', ', $mission->tags ?? []) : '') }}" placeholder="Figma, Logo, Branding..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="flex items-center gap-6">
        <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
            <input type="checkbox" name="remote" value="1" @checked(old('remote', $mission->remote ?? true))
                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Mission à distance
        </label>
        <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
            <input type="checkbox" name="urgent" value="1" @checked(old('urgent', $mission->urgent ?? false))
                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Marquer comme urgente
        </label>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Publier la mission
        </button>
        <a href="{{ route('missions.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Annuler</a>
    </div>
</div>

@csrf
<div class="space-y-5 max-w-2xl">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Nom</label>
            <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Rôle / spécialité</label>
            <input type="text" name="role" value="{{ old('role', $testimonial->role ?? '') }}" placeholder="Designer UI/UX, Cotonou"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Photo (URL, optionnel)</label>
        <input type="url" name="photo" value="{{ old('photo', $testimonial->photo ?? '') }}" placeholder="https://..."
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <p class="text-xs text-gray-400 mt-1">Utilisez uniquement la photo de la personne réelle, avec son accord.</p>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Citation</label>
        <textarea name="quote" rows="4" required
            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4 items-end">
        <div>
            <label class="block text-xs font-bold uppercase tracking-wide text-gray-500 mb-1.5">Ordre d'affichage</label>
            <input type="number" min="0" name="position" value="{{ old('position', $testimonial->position ?? 0) }}"
                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <label class="flex items-center gap-2 text-sm font-medium text-gray-700 pb-2.5">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial->is_active ?? true))
                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Visible sur le site
        </label>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
            Enregistrer
        </button>
        <a href="{{ route('admin.testimonials.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Annuler</a>
    </div>
</div>

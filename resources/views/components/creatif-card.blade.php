@props(['creatif'])

<div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-50 via-white to-amber-50 border border-gray-100 hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-300">

    {{-- Halos décoratifs façon verre dépoli --}}
    <div class="absolute -top-8 -right-8 w-32 h-32 bg-indigo-200/40 rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-violet-200/40 rounded-full blur-2xl pointer-events-none"></div>

    <div class="relative p-7 flex flex-col items-center text-center">
        <a href="{{ route('creatifs.show', $creatif->slug) }}" class="block mb-4">
            @if ($creatif->photo)
                <img src="{{ $creatif->photo }}" alt="{{ $creatif->prenom }} {{ $creatif->nom }}"
                    class="w-20 h-20 rounded-full object-cover ring-4 ring-white shadow-md group-hover:scale-105 transition-transform duration-300">
            @else
                <div
                    class="w-20 h-20 rounded-full bg-indigo-600 text-white flex items-center justify-center text-2xl font-black ring-4 ring-white shadow-md group-hover:scale-105 transition-transform duration-300 mx-auto">
                    {{ strtoupper(substr($creatif->prenom ?: '?', 0, 1)) }}
                </div>
            @endif
        </a>

        <a href="{{ route('creatifs.show', $creatif->slug) }}" class="block">
            <h3 class="text-base font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                {{ $creatif->prenom }} {{ $creatif->nom }}
            </h3>
        </a>
        <p class="text-sm text-gray-500 mt-1">{{ $creatif->specialite ?? 'Créatif' }}</p>

        <a href="{{ route('creatifs.show', $creatif->slug) }}"
            class="mt-5 inline-flex items-center gap-1.5 bg-white/80 backdrop-blur border border-white text-gray-900 text-xs font-bold px-5 py-2.5 rounded-full shadow-sm hover:bg-gray-900 hover:text-white transition-all">
            Voir le profil
        </a>
    </div>
</div>

{{--
    Sélecteur de langue desktop (icône globe + code de langue courant, se
    déplie en Français/English). Voir App\Http\Middleware\SetLocale pour le
    mécanisme de bascule — l'interface seule est traduite, pas le contenu
    publié par les utilisateurs. Aucune variable externe requise.
--}}
<div class="relative" x-data="{ openLang: false }">
    <button @click="openLang = !openLang" @click.outside="openLang = false"
        class="p-2 text-gray-500 hover:text-indigo-600 transition-colors flex items-center gap-1 text-xs font-bold uppercase">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21a9 9 0 100-18 9 9 0 000 18zm0 0c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m-9 9h18" />
        </svg>
        {{ app()->getLocale() }}
    </button>
    <div x-show="openLang" @click.outside="openLang = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="absolute right-0 mt-3 w-36 bg-white rounded-2xl shadow-xl p-1.5 border border-gray-100 z-50">
        <a href="{{ route('locale.switch', 'fr') }}"
            class="flex items-center justify-between px-3 py-2 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-colors {{ app()->getLocale() === 'fr' ? 'text-indigo-600' : 'text-gray-700' }}">
            Français
        </a>
        <a href="{{ route('locale.switch', 'en') }}"
            class="flex items-center justify-between px-3 py-2 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-colors {{ app()->getLocale() === 'en' ? 'text-indigo-600' : 'text-gray-700' }}">
            English
        </a>
    </div>
</div>

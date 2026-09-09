{{--
    Menu utilisateur desktop (avatar + x-dropdown). Inclus depuis le bloc
    @auth de navigation.blade.php.

    Variables attendues (calculées par le parent) :
    - $creatif        \App\Models\Creatif|null
    - $profilComplet  bool
--}}
<x-dropdown align="right" width="52">
    <x-slot name="trigger">
        <button class="flex items-center gap-2 pl-1 pr-1 py-1 rounded-full hover:bg-gray-50 transition-all">
            <span class="relative flex-shrink-0">
                @if ($creatif?->photo)
                    <img src="{{ $creatif->photo }}"
                        class="h-8 w-8 rounded-full object-cover">
                @else
                    <div
                        class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>
                @endif
                <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-green-500 border-2 border-white"></span>
            </span>
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="flex items-center gap-3 px-4 py-3 border-b border-gray-100">
            <span class="flex-shrink-0">
                @if ($creatif?->photo)
                    <img src="{{ $creatif->photo }}" class="h-9 w-9 rounded-full object-cover">
                @else
                    <div class="h-9 w-9 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </div>
                @endif
            </span>
            <div class="min-w-0">
                <p class="text-sm font-bold truncate text-gray-800">
                    {{ __('Bonjour, :name', ['name' => $creatif?->prenom ?? Auth::user()->username]) }}
                </p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <x-dropdown-link :href="route('dashboard')">{{ __('Tableau de bord') }}</x-dropdown-link>
        <x-dropdown-link :href="route('profile.edit')">{{ __('Mon Profil') }}</x-dropdown-link>
        @if ($creatif?->slug)
            <x-dropdown-link :href="route('creatifs.show', $creatif->slug)">{{ __('Voir mon profil public') }}</x-dropdown-link>
        @endif
        @if (Auth::user()->isAdmin())
            <x-dropdown-link :href="route('admin.dashboard')">{{ __('Administration') }}</x-dropdown-link>
        @endif
        @if (!$profilComplet)
            <x-dropdown-link :href="route('creatifs.edit')" class="text-amber-600 font-semibold">
                {{ __('Compléter mon profil') }}
            </x-dropdown-link>
        @endif
        <hr class="border-gray-100">
        <x-dropdown-link href="mailto:contact@mefolio.com">{{ __('Aide') }}</x-dropdown-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500">
                {{ __('Déconnexion') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>

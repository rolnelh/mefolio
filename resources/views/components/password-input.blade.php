{{--
    Champ mot de passe avec bouton oeil (afficher/masquer), utilisé par les
    pages de connexion et d'inscription. État local Alpine, pas de script
    global. Les autres attributs (placeholder, autocomplete...) sont
    transmis à l'<input>.
--}}
@props(['name' => 'password', 'inputClass' => ''])

<div x-data="{ visible: false }" class="relative">
    <input :type="visible ? 'text' : 'password'" type="password" id="{{ $name }}" name="{{ $name }}" required
        {{ $attributes->merge(['class' => $inputClass . ' pr-12']) }}>
    <button type="button" @click="visible = !visible" :aria-label="visible ? @js(__('Masquer le mot de passe')) : @js(__('Afficher le mot de passe'))"
        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-700">
        <svg x-show="visible" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <svg x-show="!visible" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
            <path d="M3 3l18 18" />
        </svg>
    </button>
</div>

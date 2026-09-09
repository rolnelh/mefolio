{{--
    Onglet "Paramètres" — visibilité du profil, infos de compte, pause et
    suppression de compte. Variables attendues : $creatif.
--}}
<div class="space-y-4">
    <h2 class="text-lg font-black text-gray-900">Paramètres du compte</h2>

    {{-- Visibilité du profil --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <h3 class="font-bold text-gray-900 mb-1">Visibilité du profil</h3>
        <p class="text-sm text-gray-500 mb-4">
            Votre profil est actuellement
            <span class="font-semibold {{ $creatif?->is_paused ? 'text-amber-600' : 'text-green-600' }}">
                {{ $creatif?->is_paused ? 'en pause (masqué des listes publiques)' : 'public et visible par tous' }}
            </span>.
            Vous pouvez le mettre en pause depuis la section « Mettre en pause » ci-dessous.
        </p>
    </div>

    {{-- Compte --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <h3 class="font-bold text-gray-900 mb-1">Informations du compte</h3>
        <p class="text-sm text-gray-500 mb-4">Gérez votre email et votre mot de passe.</p>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                <div>
                    <p class="text-xs text-gray-400">Email</p>
                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="text-xs text-indigo-600 font-semibold hover:underline">Modifier</a>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                <div>
                    <p class="text-xs text-gray-400">Mot de passe</p>
                    <p class="text-sm font-semibold text-gray-900">••••••••</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="text-xs text-indigo-600 font-semibold hover:underline">Modifier</a>
            </div>
        </div>
    </div>

    {{-- Mettre en pause --}}
    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6">
        <div class="flex items-start gap-4">
            <div class="flex-1">
                @if ($creatif?->is_paused)
                    <h3 class="font-bold text-amber-900 mb-1">Votre profil est en pause</h3>
                    <p class="text-sm text-amber-700 mb-4">Votre profil est actuellement masqué des
                        listes publiques. Réactivez-le à tout moment.</p>
                @else
                    <h3 class="font-bold text-amber-900 mb-1">Mettre mon compte en pause</h3>
                    <p class="text-sm text-amber-700 mb-4">Votre profil sera temporairement masqué
                        des listes publiques. Vous pourrez le réactiver à tout moment.</p>
                @endif
                <form method="POST" action="{{ route('creatifs.pause') }}">
                    @csrf
                    @method('PUT')
                    <button
                        class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl transition-all">
                        {{ $creatif?->is_paused ? 'Réactiver mon profil' : 'Mettre en pause' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Supprimer le compte --}}
    <div class="bg-red-50 border border-red-100 rounded-2xl p-6">
        <div class="flex items-start gap-4">
            <div class="flex-1">
                <h3 class="font-bold text-red-900 mb-1">Supprimer définitivement mon compte</h3>
                <p class="text-sm text-red-700 mb-4">Cette action est irréversible. Toutes vos
                    données, projets et profil seront supprimés définitivement.</p>
                <button type="button" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="px-5 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl transition-all">
                    Supprimer mon compte
                </button>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Êtes-vous sûr(e) de vouloir supprimer votre compte ?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Une fois votre compte supprimé, toutes ses données seront définitivement effacées.
                Saisissez votre mot de passe pour confirmer la suppression définitive de votre compte.
            </p>

            <div class="mt-6">
                <x-input-label for="delete-password" value="Mot de passe" class="sr-only" />
                <x-text-input id="delete-password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="Mot de passe" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuler
                </x-secondary-button>
                <x-danger-button class="ms-3">
                    Supprimer mon compte
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</div>

{{--
    Page d'inscription, sur le modèle d'une maquette fournie : fond gris
    clair, grande carte blanche arrondie au centre ; à gauche un panneau
    gris avec une illustration 3D (public/images/designer.png, fondue dans
    le fond par mix-blend-multiply), à droite le formulaire (lien
    "Se connecter" en haut à droite, bouton Google, séparateur, choix du
    rôle, nom d'utilisateur, email, mot de passe, bouton bleu).

    Variables attendues (RegisteredUserController::create) :
    - $recentCreatifs  Collection  Derniers créatifs (avatars du panneau).
    - $creatifCount    int         Nombre de créatifs (texte du panneau).
--}}
@php
    $champ = 'w-full h-11 px-4 rounded-xl border border-gray-200 bg-white text-sm outline-none placeholder:text-gray-400 focus:border-blue-400 focus:ring-4 focus:ring-blue-500/10 transition';
    $libelle = 'block mb-1.5 text-xs font-medium text-gray-600';
@endphp
<x-guest-layout>
    <div class="min-h-screen bg-[#F1F1EF] flex items-center justify-center px-3 py-6 sm:p-8">
        <div class="w-full max-w-5xl rounded-[28px] bg-white p-3 shadow-[0_30px_80px_-40px_rgba(17,24,39,0.35)] ring-1 ring-gray-900/5 grid grid-cols-1 lg:grid-cols-2 gap-3">

            {{-- Panneau illustration --}}
            <div class="relative hidden lg:flex flex-col items-center justify-center overflow-hidden rounded-[22px] bg-[#EDEDEB] p-10">
                <a href="{{ route('home') }}" class="absolute left-6 top-6 flex items-center gap-2" aria-label="Mefolio">
                    <x-application-logo class="h-7 w-auto text-gray-900" />
                </a>
                <img src="{{ asset('images/designer.png') }}" alt="" class="w-full max-w-sm mix-blend-multiply drop-shadow-[0_30px_30px_rgba(0,0,0,0.12)]">

                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-3 rounded-full bg-white/80 py-1.5 pl-1.5 pr-4 shadow-sm backdrop-blur">
                    <div class="flex -space-x-2">
                        @forelse ($recentCreatifs as $rc)
                            @if ($rc->photo)
                                <img src="{{ $rc->photo }}" alt="{{ $rc->prenom }}" class="h-7 w-7 rounded-full border-2 border-white object-cover">
                            @else
                                <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-white bg-blue-600 text-[10px] font-bold text-white">
                                    {{ strtoupper(substr($rc->prenom ?: '?', 0, 1)) }}
                                </div>
                            @endif
                        @empty
                            @foreach (['bg-blue-400', 'bg-amber-400', 'bg-rose-400'] as $c)
                                <div class="h-7 w-7 rounded-full border-2 border-white {{ $c }}"></div>
                            @endforeach
                        @endforelse
                    </div>
                    <p class="whitespace-nowrap text-xs font-medium text-gray-700">{{ trans_choice(':count créatif nous a rejoint|:count créatifs nous ont rejoint', $creatifCount, ['count' => $creatifCount > 10 ? '10+' : $creatifCount]) }}</p>
                </div>
            </div>

            {{-- Formulaire --}}
            <div class="flex flex-col px-4 py-5 sm:px-10 sm:py-6">
                <div class="flex items-center justify-between gap-4 text-xs text-gray-500">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 lg:invisible">
                        <x-application-logo class="h-7 w-auto text-gray-900" />
                        <span class="text-sm font-bold text-gray-900">Mefolio</span>
                    </a>
                    <p>
                        {{ __('Déjà membre ?') }}
                        <a href="{{ route('login') }}" class="font-semibold text-gray-900 hover:underline">{{ __('Se connecter') }}</a>
                    </p>
                </div>

                <div class="mx-auto my-auto w-full max-w-sm py-8">
                    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">{{ __('Créer votre compte') }}</h1>
                    <p class="mt-1 text-sm text-gray-500">{{ __('Rejoignez la communauté des créatifs africains.') }}</p>

                    @if (session('google_error'))
                        <div class="mt-5 rounded-xl border border-amber-100 bg-amber-50 p-3 text-sm text-amber-700">
                            {{ session('google_error') }}
                        </div>
                    @endif

                    <a href="{{ route('google.redirect') }}"
                        class="mt-6 flex w-full items-center justify-center gap-3 rounded-xl border border-gray-200 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        <x-google-icon />
                        {{ __('Continuer avec Google') }}
                    </a>

                    <div class="my-5 flex items-center gap-3 text-[11px] text-gray-400">
                        <span class="h-px flex-1 bg-gray-100"></span>
                        {{ __('ou avec votre email') }}
                        <span class="h-px flex-1 bg-gray-100"></span>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        {{-- Rôle --}}
                        <div>
                            <div class="grid grid-cols-2 gap-1 rounded-xl bg-gray-100 p-1">
                                @foreach (['creatif' => __('Je suis créatif'), 'client' => __('Je suis client')] as $valeur => $texte)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="role" value="{{ $valeur }}" class="peer hidden"
                                            @checked(old('role', 'creatif') === $valeur)>
                                        <div class="rounded-lg py-2 text-center text-xs font-semibold text-gray-500 transition peer-checked:bg-white peer-checked:text-gray-900 peer-checked:shadow-sm">
                                            {{ $texte }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('role')" />
                        </div>

                        <div>
                            <label for="username" class="{{ $libelle }}">{{ __("Nom d'utilisateur") }}</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username"
                                placeholder="{{ __("Nom d'utilisateur") }}" class="{{ $champ }}">
                            <x-input-error :messages="$errors->get('username')" />
                        </div>

                        <div>
                            <label for="email" class="{{ $libelle }}">{{ __('Adresse Email') }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="votre@email.com" class="{{ $champ }}">
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <label for="password" class="{{ $libelle }}">{{ __('Mot de passe') }}</label>
                            <x-password-input :input-class="$champ" autocomplete="new-password" placeholder="{{ __('Mot de passe') }}" />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>

                        <button type="submit"
                            class="w-full rounded-xl bg-blue-600 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 active:scale-[0.99]">
                            {{ __('Créer mon compte gratuitement') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

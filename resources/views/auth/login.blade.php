{{--
    Page de connexion, sur le modèle d'une maquette fournie : à gauche une
    grande scène arrondie aux teintes vertes avec une illustration
    (public/images/talentoftheweek.png, fondue dans le fond par
    mix-blend-multiply) et l'accroche tirée au sort ; à droite un panneau
    blanc avec le logo, un grand titre, les champs, le bouton vert citron
    "Se connecter", puis "ou continuer avec" et le bouton Google rond.

    "Rester connecté" reste cochée par défaut (voir CLAUDE.md, décision
    "Connexion Rester connecté cochée par défaut").

    Variables attendues (AuthenticatedSessionController::create) :
    - $tagline         array       line1, line2, text (déjà traduites).
    - $recentCreatifs  Collection  Derniers créatifs (avatars).
    - $creatifCount    int         Nombre de créatifs.
--}}
@php
    $champ = 'w-full h-12 px-4 rounded-xl border border-gray-200 bg-white text-sm outline-none placeholder:text-gray-400 focus:border-lime-500 focus:ring-4 focus:ring-lime-400/20 transition';
@endphp
<x-guest-layout>
    <div class="min-h-screen bg-white lg:grid lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] lg:gap-3 lg:p-3">

        {{-- Scène illustrée --}}
        <div class="relative hidden lg:flex min-h-[calc(100vh-1.5rem)] flex-col overflow-hidden rounded-[28px] bg-gradient-to-br from-lime-100 via-[#DDEFC4] to-[#C6E3A6]">
            <div class="absolute -left-20 top-1/3 h-72 w-72 rounded-full bg-white/40 blur-3xl" aria-hidden="true"></div>
            <div class="absolute bottom-0 inset-x-0 h-1/3 bg-gradient-to-t from-[#A9D47F]/60 to-transparent" aria-hidden="true"></div>

            <div class="relative z-10 p-12 xl:p-14">
                <h2 class="max-w-md text-3xl xl:text-4xl font-semibold leading-tight tracking-tight text-gray-900">
                    {{ $tagline['line1'] }}<br>{{ $tagline['line2'] }}
                </h2>
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-gray-700/80">{{ $tagline['text'] }}</p>
            </div>

            <div class="relative z-0 flex flex-1 items-end justify-center px-10">
                <img src="{{ asset('images/talentoftheweek.png') }}" alt="" class="w-full max-w-lg mix-blend-multiply">
            </div>

            <div class="absolute bottom-8 left-12 z-10 flex items-center gap-3 rounded-full bg-white/80 py-1.5 pl-1.5 pr-4 shadow-sm backdrop-blur">
                <div class="flex -space-x-2">
                    @forelse ($recentCreatifs as $rc)
                        @if ($rc->photo)
                            <img src="{{ $rc->photo }}" alt="{{ $rc->prenom }}" class="h-7 w-7 rounded-full border-2 border-white object-cover">
                        @else
                            <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-white bg-gray-900 text-[10px] font-bold text-white">
                                {{ strtoupper(substr($rc->prenom ?: '?', 0, 1)) }}
                            </div>
                        @endif
                    @empty
                        @foreach (['bg-lime-400', 'bg-amber-400', 'bg-emerald-500'] as $c)
                            <div class="h-7 w-7 rounded-full border-2 border-white {{ $c }}"></div>
                        @endforeach
                    @endforelse
                </div>
                <p class="whitespace-nowrap text-xs font-medium text-gray-700">{{ trans_choice(':count créatif nous a rejoint|:count créatifs nous ont rejoint', $creatifCount, ['count' => $creatifCount > 10 ? '10+' : $creatifCount]) }}</p>
            </div>
        </div>

        {{-- Formulaire --}}
        <div class="flex min-h-screen lg:min-h-0 flex-col px-6 py-8 sm:px-12 lg:px-16">
            <a href="{{ route('home') }}" class="flex w-fit items-center gap-2">
                <x-application-logo class="h-7 w-auto text-gray-900" />
                <span class="text-base font-bold text-gray-900">Mefolio</span>
            </a>

            <div class="mx-auto my-auto w-full max-w-sm py-10">
                <h1 class="text-4xl font-semibold tracking-tight text-gray-900">{{ __('Bon retour') }}</h1>
                <p class="mt-2 text-sm text-gray-500">{{ __('Connectez-vous pour retrouver vos projets et missions.') }}</p>

                <x-auth-session-status class="mt-5" :status="session('status')" />

                @if (session('google_error'))
                    <div class="mt-5 rounded-xl border border-amber-100 bg-amber-50 p-3 text-sm text-amber-700">
                        {{ session('google_error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-3">
                    @csrf

                    <div>
                        <label for="email" class="sr-only">{{ __('Adresse Email') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                            placeholder="{{ __('Adresse Email') }}" class="{{ $champ }}">
                        <x-input-error :messages="$errors->get('email')" />
                    </div>

                    <div>
                        <label for="password" class="sr-only">{{ __('Mot de passe') }}</label>
                        <x-password-input :input-class="$champ" autocomplete="current-password" placeholder="{{ __('Mot de passe') }}" />
                        <x-input-error :messages="$errors->get('password')" />
                    </div>

                    <div class="flex items-center justify-between gap-4 pt-1">
                        <label class="flex cursor-pointer items-center gap-2">
                            <input type="checkbox" name="remember" checked
                                class="h-4 w-4 rounded border-gray-300 text-lime-600 focus:ring-lime-500/30">
                            <span class="text-xs text-gray-600">{{ __('Rester connecté') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-medium text-gray-600 hover:text-gray-900 hover:underline">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="!mt-5 w-full rounded-xl bg-lime-400 py-3.5 text-sm font-semibold text-gray-900 shadow-[0_10px_24px_-10px_rgba(132,204,22,0.9)] transition hover:bg-lime-300 active:scale-[0.99]">
                        {{ __('Se connecter') }}
                    </button>
                </form>

                <div class="mt-8 flex items-center gap-3 text-xs text-gray-400">
                    <span class="h-px flex-1 bg-gray-100"></span>
                    {{ __('ou continuer avec') }}
                    <span class="h-px flex-1 bg-gray-100"></span>
                </div>

                <div class="mt-5 flex justify-center">
                    <a href="{{ route('google.redirect') }}" aria-label="{{ __('Continuer avec Google') }}" title="{{ __('Continuer avec Google') }}"
                        class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 hover:bg-gray-50 transition">
                        <x-google-icon />
                    </a>
                </div>

                <p class="mt-10 text-center text-xs text-gray-500">
                    {{ __('Pas encore de compte ?') }}
                    <a href="{{ route('register') }}" class="font-semibold text-gray-900 hover:underline">{{ __("S'inscrire gratuitement") }}</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>

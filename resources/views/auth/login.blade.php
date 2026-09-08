<x-guest-layout>
    <div class="min-h-screen bg-[#F4F3EF] flex flex-col items-center justify-center px-4 py-6">

        <div class="w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl shadow-gray-900/10 overflow-hidden flex flex-col lg:flex-row lg:max-h-[92vh]">

            {{-- Panneau gauche : formulaire --}}
            <div class="w-full lg:w-1/2 p-6 sm:p-10 lg:p-12 flex flex-col justify-center overflow-y-auto">

                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-5 w-fit transition-transform hover:scale-105">
                    <x-application-logo class="h-8 w-auto text-indigo-600" />
                    <span class="font-bold text-lg text-gray-900">Mefolio</span>
                </a>

                <div x-data="{
                        remembered: null,
                        useAnother: {{ old('via') === 'full' ? 'true' : 'false' }},
                        init() {
                            try {
                                const raw = localStorage.getItem('mefolio_last_account');
                                if (raw) this.remembered = JSON.parse(raw);
                            } catch (e) {}
                        },
                        forget() {
                            try { localStorage.removeItem('mefolio_last_account'); } catch (e) {}
                            this.remembered = null;
                            this.useAnother = false;
                        }
                    }" x-cloak>

                    {{-- Compte reconnu : connexion rapide --}}
                    <template x-if="remembered && !useAnother">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">Bon retour !</h1>
                            <p class="text-sm text-gray-500 mb-5">Connectez-vous avec votre dernier compte utilisé.</p>

                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <div class="flex items-center gap-3 p-4 border border-gray-200 rounded-2xl mb-5">
                                <span class="flex-shrink-0">
                                    <img x-show="remembered && remembered.photo" :src="remembered && remembered.photo"
                                        class="w-11 h-11 rounded-full object-cover">
                                    <span x-show="!(remembered && remembered.photo)"
                                        class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-black"
                                        x-text="remembered ? remembered.name.charAt(0).toUpperCase() : ''"></span>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-bold text-gray-900 truncate" x-text="remembered ? remembered.name : ''"></p>
                                    <p class="text-xs text-gray-400 truncate" x-text="remembered ? remembered.email : ''"></p>
                                </div>
                                <button type="button" @click="forget()"
                                    class="flex-shrink-0 text-gray-300 hover:text-gray-500 transition-colors" title="Oublier ce compte">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                                @csrf
                                <input type="hidden" name="email" :value="remembered ? remembered.email : ''">
                                <input type="hidden" name="via" value="quick">
                                <x-input-error :messages="$errors->get('email')" />

                                <div class="space-y-1">
                                    <div class="flex items-center justify-between ml-1">
                                        <label class="text-sm font-bold text-gray-700">Mot de passe</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-xs text-indigo-600 font-bold hover:underline">Oublié ?</a>
                                        @endif
                                    </div>
                                    <div class="relative">
                                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                        </svg>
                                        <input type="password" id="password-quick" name="password" required
                                            autofocus placeholder="••••••••"
                                            class="w-full h-12 pl-11 pr-12 rounded-xl border border-gray-200 text-sm outline-none
                       focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition" />
                                        <button type="button"
                                            onclick="togglePwd('password-quick','eye-open-quick','eye-close-quick')"
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-indigo-600">
                                            <svg id="eye-open-quick" class="w-5 h-5 hidden" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg id="eye-close-quick" class="w-5 h-5" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </button>
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" />
                                </div>

                                <div class="flex items-center">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="checkbox" name="remember"
                                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span
                                            class="text-xs text-gray-500 font-medium group-hover:text-gray-700 transition-colors">Rester
                                            connecté</span>
                                    </label>
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                                    Continuer →
                                </button>
                            </form>

                            <button type="button" @click="useAnother = true"
                                class="w-full text-center text-sm text-gray-500 font-semibold hover:text-indigo-600 transition-colors mt-4">
                                Se connecter avec un autre compte
                            </button>

                            <p class="text-center text-sm text-gray-500 mt-4">
                                Pas encore de compte ?
                                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">S'inscrire
                                    gratuitement</a>
                            </p>
                        </div>
                    </template>

                    {{-- Formulaire complet --}}
                    <template x-if="!remembered || useAnother">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">Bienvenue sur Mefolio</h1>
                            <p class="text-sm text-gray-500 mb-5">
                                Pas encore de compte ?
                                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">S'inscrire
                                    gratuitement</a>
                            </p>

                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            @if (session('google_error'))
                                <div class="mb-6 p-3 bg-amber-50 border border-amber-100 rounded-xl text-sm text-amber-700">
                                    {{ session('google_error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                                @csrf
                                <input type="hidden" name="via" value="full">

                                {{-- Email --}}
                                <div class="space-y-1">
                                    <label class="block text-sm font-bold text-gray-700 ml-1">Adresse Email</label>
                                    <div class="relative">
                                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                        <input type="email" name="email" value="{{ old('email') }}" required
                                            placeholder="votre@email.com"
                                            class="w-full h-12 pl-11 pr-4 rounded-xl border border-gray-200 text-sm outline-none
                           focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition">
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" />
                                </div>

                                <div class="space-y-1">
                                    <div class="flex items-center justify-between ml-1">
                                        <label class="text-sm font-bold text-gray-700">Mot de passe</label>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-xs text-indigo-600 font-bold hover:underline">
                                                Oublié ?
                                            </a>
                                        @endif
                                    </div>

                                    <div class="relative">
                                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                        </svg>
                                        <input type="password" id="password" name="password" required placeholder="••••••••"
                                            class="w-full h-12 pl-11 pr-12 rounded-xl border border-gray-200 text-sm outline-none
                       focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition" />

                                        <!-- Bouton oeil -->
                                        <button type="button" onclick="togglePwd('password','eye-open','eye-close')"
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-indigo-600">

                                            <!-- Œil ouvert -->
                                            <svg id="eye-open" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                            <!-- Œil fermé -->
                                            <svg id="eye-close" class="w-5 h-5" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
                                                <path d="M3 3l18 18" />
                                            </svg>

                                        </button>
                                    </div>

                                    <x-input-error :messages="$errors->get('password')" />
                                </div>

                                <div class="flex items-center">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="checkbox" name="remember"
                                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                                        <span
                                            class="text-xs text-gray-500 font-medium group-hover:text-gray-700 transition-colors">Rester
                                            connecté</span>
                                    </label>
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                                    Se connecter →
                                </button>
                            </form>

                            <div class="relative my-4">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-100"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="px-4 bg-white text-[10px] text-gray-800 font-bold uppercase">ou</span>
                                </div>
                            </div>

                            <a href="{{ route('google.redirect') }}"
                                class="w-full flex items-center justify-center gap-3 border border-gray-200 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all">
                                <svg class="w-5 h-5" viewBox="0 0 48 48">
                                    <path fill="#FFC107"
                                        d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                                    <path fill="#FF3D00"
                                        d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                                    <path fill="#4CAF50"
                                        d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                                    <path fill="#1976D2"
                                        d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                                </svg>
                                Continuer avec Google
                            </a>

                            <template x-if="remembered && useAnother">
                                <button type="button" @click="useAnother = false"
                                    class="w-full text-center text-sm text-gray-500 font-semibold hover:text-indigo-600 transition-colors mt-5">
                                    ← Revenir à mon compte
                                </button>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Panneau droit : identité de marque --}}
            <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-10 bg-gradient-to-br from-indigo-50 via-white to-amber-50 overflow-hidden">
                <div aria-hidden="true" class="absolute inset-0">
                    <div class="absolute -top-8 -right-8 w-72 h-72 bg-indigo-200/40 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-8 -left-8 w-80 h-80 bg-violet-200/40 rounded-full blur-3xl"></div>
                    <svg class="absolute top-20 right-14 w-20 h-20 text-indigo-900/5" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 100 100">
                        <path d="M10 60 C 30 20, 60 90, 90 40" stroke-linecap="round" />
                    </svg>
                    <div class="absolute bottom-32 right-24 w-10 h-10 border border-indigo-900/10 rounded-lg rotate-12"></div>
                </div>

                <span class="relative z-10"></span>

                <div class="relative z-10">
                    <h2 class="text-4xl font-black text-gray-900 leading-tight mb-4">
                        Votre portfolio<br>vous attend.
                    </h2>
                    <p class="text-gray-500 text-base leading-relaxed max-w-sm mb-10">
                        Vos projets, vos opportunités, votre communauté — tout est là où vous
                        l'avez laissé.
                    </p>

                    <div class="bg-white/80 border border-white shadow-sm backdrop-blur-sm rounded-2xl p-6 max-w-md">
                        <p class="text-gray-700 text-sm italic leading-relaxed">
                            "Mefolio m'a permis de décrocher mon premier contrat freelance en 2 semaines. La plateforme
                            parle vraiment à notre réalité africaine."
                        </p>
                        <div class="flex items-center gap-3 mt-5">
                            <div
                                class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-violet-500 flex items-center justify-center text-white text-xs font-black shadow-lg">
                                K
                            </div>
                            <div>
                                <p class="text-gray-900 text-sm font-bold">Kofi A.</p>
                                <p class="text-gray-400 text-xs">Designer · Accra, Ghana</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 flex items-center gap-3 bg-white/80 border border-white shadow-sm backdrop-blur-sm rounded-full pl-2 pr-4 py-2 w-fit">
                    <div class="flex -space-x-2">
                        @foreach (['bg-indigo-400', 'bg-violet-400', 'bg-pink-400'] as $c)
                            <div class="w-7 h-7 rounded-full {{ $c }} border-2 border-white"></div>
                        @endforeach
                    </div>
                    <p class="text-gray-700 text-xs font-semibold">{{ number_format($creatifCount) }} créatif{{ $creatifCount > 1 ? 's' : '' }} nous ont rejoint</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePwd(inputId, openId, closeId) {
            const input = document.getElementById(inputId);
            const openIcon = document.getElementById(openId);
            const closeIcon = document.getElementById(closeId);

            if (input.type === "password") {
                input.type = "text";
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            } else {
                input.type = "password";
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>

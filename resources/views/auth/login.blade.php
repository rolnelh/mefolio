<x-guest-layout>
    <div class="min-h-screen flex">

        {{-- Panneau gauche : identité de marque --}}
        <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-10 bg-[#050810] overflow-hidden">
            <div aria-hidden="true" class="absolute inset-0">
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-indigo-600/30 rounded-full blur-3xl"></div>
                <div class="absolute top-1/3 -right-20 w-80 h-80 bg-violet-600/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-pink-500/10 rounded-full blur-3xl"></div>
                <div class="absolute inset-0 opacity-[0.15]"
                    style="background-image: radial-gradient(rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 26px 26px;">
                </div>
                <svg class="absolute top-20 right-14 w-20 h-20 text-white/10" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 100 100">
                    <path d="M10 60 C 30 20, 60 90, 90 40" stroke-linecap="round" />
                </svg>
                <div class="absolute bottom-32 right-24 w-10 h-10 border border-white/10 rounded-lg rotate-12"></div>
            </div>

            <a href="{{ route('home') }}" class="relative z-10 inline-flex items-center gap-2 w-fit transition-transform hover:scale-105">
                <x-application-logo class="h-8 w-auto text-white" />
                <span class="font-bold text-lg text-white">Mefolio</span>
            </a>

            <div class="relative z-10 py-16">
                <h2 class="text-5xl font-black text-white leading-tight mb-4">
                    Bon retour parmi <br> nous.
                </h2>

                <p class="text-gray-400 text-base leading-relaxed max-w-sm mb-10">
                    Votre portfolio vous attend. Vos projets, vos opportunités, votre communauté.
                </p>

                <div class="bg-white/5 border border-white/10 backdrop-blur-sm rounded-2xl p-6 max-w-md">
                    <p class="text-gray-300 text-sm italic leading-relaxed">
                        "Mefolio m'a permis de décrocher mon premier contrat freelance en 2 semaines. La plateforme
                        parle vraiment à notre réalité africaine."
                    </p>
                    <div class="flex items-center gap-3 mt-5">
                        <div
                            class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-black shadow-lg">
                            K
                        </div>
                        <div>
                            <p class="text-white text-sm font-bold">Kofi A.</p>
                            <p class="text-gray-500 text-xs text-indigo-400/80">Designer · Accra, Ghana </p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-gray-600 text-xs">© {{ now()->year }} Mefolio</p>
        </div>

        {{-- Panneau droit : formulaire --}}
        <div class="flex-1 lg:w-1/2 flex flex-col justify-center px-6 py-4 sm:px-12 lg:px-20 xl:px-32 bg-white">
            <div class="w-full max-w-md mx-auto">

                <a href="{{ route('home') }}" class="lg:hidden inline-flex items-center gap-2 mb-8 transition-transform hover:scale-105">
                    <x-application-logo class="h-9 w-auto text-indigo-600" />
                    <span class="font-bold text-xl text-gray-900">Mefolio</span>
                </a>

                <h1 class="text-3xl font-black text-gray-900 mb-2">Se connecter</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">S'inscrire
                        gratuitement</a>
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Adresse Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="votre@email.com"
                            class="w-full h-12 px-4 pr-12 rounded-xl border border-gray-200 text-sm outline-none
                   focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition">
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
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full h-12 px-4 pr-12 rounded-xl border border-gray-200 text-sm outline-none
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
                        class="w-full bg-[#050810] hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                        Se connecter →
                    </button>
                </form>

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

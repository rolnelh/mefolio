<x-guest-layout>
    <div class="min-h-screen flex bg-white">

        {{-- Panneau gauche : identité de marque --}}
        <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-10 bg-[#050810] overflow-hidden">
            <div aria-hidden="true" class="absolute inset-0">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-indigo-600/30 rounded-full blur-3xl"></div>
                <div class="absolute top-1/3 -left-20 w-80 h-80 bg-violet-600/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-pink-500/10 rounded-full blur-3xl"></div>
                <div class="absolute inset-0 opacity-[0.15]"
                    style="background-image: radial-gradient(rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 26px 26px;">
                </div>
                <svg class="absolute bottom-24 left-14 w-20 h-20 text-white/10" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 100 100">
                    <path d="M10 40 C 40 10, 60 80, 90 55" stroke-linecap="round" />
                </svg>
                <div class="absolute top-32 left-24 w-10 h-10 border border-white/10 rounded-lg -rotate-12"></div>
            </div>

            <a href="{{ route('home') }}" class="relative z-10 inline-flex items-center gap-2 w-fit transition-transform hover:scale-105">
                <x-application-logo class="h-8 w-auto text-white" />
                <span class="font-bold text-lg text-white">Mefolio</span>
            </a>

            <div class="relative z-10 py-16">
                <div
                    class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold px-3 py-1.5 rounded-full mb-8 w-fit">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m-15.432 0A8.959 8.959 0 013 12c0-.778.099-1.533.284-2.253" />
                    </svg>
                    La première plateforme africaine des talents
                </div>

                <h2 class="text-4xl font-black text-white leading-tight mb-5">
                    Valorisons les talents africains<br>
                    <span class="text-indigo-400">à l'échelle mondiale.</span>
                </h2>

                <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                    Mefolio connecte les talents africains aux recruteurs, aux opportunités
                    et aux missions réelles — sans barrières techniques, sans blocages de
                    paiement, pensé pour nos réalités.
                </p>

                <div class="flex items-center gap-3 mt-10">
                    <div class="flex -space-x-2">
                        @foreach (['bg-indigo-500', 'bg-violet-500', 'bg-pink-500', 'bg-blue-500'] as $c)
                            <div class="w-8 h-8 rounded-full {{ $c }} border-2 border-[#050810]"></div>
                        @endforeach
                    </div>
                    <p class="text-gray-400 text-xs">+2 000 créatifs nous ont rejoint</p>
                </div>
            </div>

            <p class="relative z-10 text-gray-600 text-xs">© {{ now()->year }} Mefolio</p>
        </div>

        {{-- Panneau droit : formulaire --}}
        <div class="flex-1 lg:w-1/2 flex items-center justify-center px-8 py-3 sm:px-12 lg:px-16">
            <div class="w-full max-w-md">

                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-10 transition-transform hover:scale-105">
                    <x-application-logo class="h-9 w-auto text-indigo-600" />
                    <span class="font-bold text-xl text-gray-900">Mefolio</span>
                </a>

                <h1 class="text-3xl font-black text-gray-900 mb-2">Créer votre compte</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Déjà membre ?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Se
                        connecter</a>
                </p>

                @if (session('google_error'))
                    <div class="mb-6 p-3 bg-amber-50 border border-amber-100 rounded-xl text-sm text-amber-700">
                        {{ session('google_error') }}
                    </div>
                @endif

                <a href="{{ route('google.redirect') }}"
                    class="w-full flex items-center justify-center gap-3 border border-gray-200 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all mb-6">
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

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-100"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 bg-white text-[10px] text-gray-800 font-bold uppercase">ou avec votre
                            email</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- RÔLE --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Je m'inscris en tant que</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="creatif" class="peer hidden"
                                    @checked(old('role', 'creatif') === 'creatif')>
                                <div
                                    class="p-3 border rounded-xl text-center border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition hover:border-gray-300">
                                    <svg class="w-5 h-5 mx-auto mb-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                                    </svg>
                                    <span class="text-sm font-semibold">Créatif</span>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="role" value="client" class="peer hidden"
                                    @checked(old('role') === 'client')>
                                <div
                                    class="p-3 border rounded-xl text-center border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition hover:border-gray-300">
                                    <svg class="w-5 h-5 mx-auto mb-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    <span class="text-sm font-semibold">Client</span>
                                </div>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" />
                    </div>

                    {{-- USERNAME --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Nom d'utilisateur</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            placeholder="Nom d'utilisateur"
                            class="w-full h-12 px-4 rounded-xl border border-gray-200 text-sm outline-none
                   focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <x-input-error :messages="$errors->get('username')" />
                    </div>

                    {{-- EMAIL --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="votre@email.com"
                            class="w-full h-12 px-4 rounded-xl border border-gray-200 text-sm outline-none
                   focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <x-input-error :messages="$errors->get('email')" />
                    </div>

                    {{-- PASSWORD --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Mot de passe</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full h-12 px-4 pr-12 rounded-xl border border-gray-200 text-sm outline-none
                   focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition">
                            <button type="button" onclick="togglePwd('password', 'eye-open-1', 'eye-close-1')"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-indigo-600">
                                <svg id="eye-open-1" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eye-close-1" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
                                    <path d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" />
                    </div>

                    {{-- CONFIRM --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Confirmer le mot de passe</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder="••••••••"
                                class="w-full h-12 px-4 pr-12 rounded-xl border border-gray-200 text-sm outline-none
                   focus:border-gray-300 focus:ring-2 focus:ring-indigo-500/20 transition">
                            <button type="button" onclick="togglePwd('password_confirmation', 'eye-open-2', 'eye-close-2')"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-indigo-600">
                                <svg id="eye-open-2" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eye-close-2" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029" />
                                    <path d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" />
                    </div>

                    <button type="submit"
                        class="w-full bg-[#050810] hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                        Créer mon compte gratuitement →
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

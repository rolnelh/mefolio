<x-guest-layout>
    <div class="min-h-screen flex bg-white">

        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-[#050810]">
            <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=1200&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-t from-[#050810] via-[#050810]/80 to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-center px-10 py-20 text-white">
                <div
                    class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold px-3 py-1.5 rounded-full mb-8 w-fit">
                    <img src="/images/globe.png" class="w-4 h-4">
                    La première plateforme africaine des talents
                </div>

                <h2 class="text-4xl font-black leading-tight mb-5">
                    Valorisons les talents africains<br>
                    <span class="text-indigo-400">à l’échelle mondiale.</span>
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
        </div>


        {{-- RIGHT PANEL (Maintenant 50% exact) --}}
        <div class="flex-1 lg:w-1/2 flex items-center justify-center px-8 py-3 sm:px-12 lg:px-16">
            <div class="w-full max-w-md">

                <a href="{{ route('home') }}" class="inline-block mb-10 transition-transform hover:scale-105">
                    <x-application-logo class="h-9 text-indigo-600" />
                </a>

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Créer votre compte</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Déjà membre ?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Se
                        connecter</a>
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- ROLE --}}
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="creatif" class="peer hidden" checked>
                            <div
                                class="p-3 border rounded-xl text-center border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition hover:border-gray-300">
                                <img src="/images/design.png" class="w-5 h-5 mx-auto mb-1">
                                <span class="text-sm font-semibold">Créatif</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="client" class="peer hidden">
                            <div
                                class="p-3 border rounded-xl text-center border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition hover:border-gray-300">
                                <img src="/images/search.png" class="w-5 h-5 mx-auto mb-1">
                                <span class="text-sm font-semibold">Client</span>
                            </div>
                        </label>
                    </div>

                    {{-- USERNAME --}}
                    <input type="text" name="username" placeholder="Nom d'utilisateur" class="input-style">

                    {{-- EMAIL --}}
                    <input type="email" name="email" placeholder="Email" class="input-style">

                    {{-- PASSWORD --}}
                    <div class="relative group">
                        <input type="password" id="password" name="password" placeholder="Mot de passe"
                            class="input-style pr-11">
                        <button type="button" onclick="togglePwd('password', 'eye-open-1', 'eye-close-1')"
                            class="eye-btn">
                            <svg id="eye-open-1" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="eye-close-1" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>

                    {{-- CONFIRM --}}
                    <div class="relative group">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirmer le mot de passe" class="input-style pr-11">
                        <button type="button" onclick="togglePwd('password_confirmation', 'eye-open-2', 'eye-close-2')"
                            class="eye-btn">
                            <svg id="eye-open-2" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="eye-close-2" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#050810] hover:bg-indigo-700 text-white font-semibold py-4 rounded-xl transition hover:scale-[1.01] active:scale-95 shadow-lg shadow-indigo-100">
                        Créer mon compte gratuitement →
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .input-style {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        .input-style:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, .1);
        }

        .eye-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            transition: color .2s;
        }

        .eye-btn:hover {
            color: #6366f1;
        }
    </style>

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

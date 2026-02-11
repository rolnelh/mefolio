<x-guest-layout>
    <div class="flex min-h-screen bg-white dark:bg-gray-900">

        <div class="hidden lg:block lg:w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                class="absolute inset-0 w-full h-full object-cover" alt="Creative Workspace">
            <div class="absolute inset-0 bg-indigo-900/30 backdrop-blur-[1px]"></div>

            <div class="absolute bottom-16 left-16 text-white z-10 max-w-md">
                <h1 class="text-5xl font-black leading-tight tracking-tighter">
                    Votre talent mérite <span class="text-indigo-300">le meilleur.</span>
                </h1>
                <p class="mt-6 text-xl opacity-90 font-medium">
                    Rejoignez le réseau numéro 1 des créatifs indépendants.
                </p>
            </div>
        </div>

        <div class="flex flex-col justify-center items-center w-full lg:w-1/2 p-8 sm:p-12 md:p-20">
            <div class="w-full max-w-md">

                <div class="mb-10 text-center lg:text-left">
                    <a href="{{ route('home') }}" class="inline-block mb-6 transition-transform hover:scale-110">
                        <x-application-logo class="w-14 h-14 fill-current text-indigo-600" />
                    </a>
                    <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight">Créer un compte</h2>
                    <p class="mt-3 text-gray-500 dark:text-gray-400 font-medium">
                        Déjà membre ?
                        <a href="{{ route('login') }}"
                            class="text-indigo-600 hover:underline font-bold">Connectez-vous</a>
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label :value="__('Vous êtes plutôt...')" class="font-bold text-gray-700 dark:text-gray-300 mb-3 ml-1" />
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="creatif" class="peer hidden" checked>
                                <div
                                    class="p-4 border-2 border-gray-100 dark:border-gray-800 rounded-2xl transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 dark:peer-checked:bg-indigo-900/20 group-hover:border-gray-200 text-center">
                                    <span class="text-3xl block mb-2">🎨</span>
                                    <span class="block font-bold text-gray-800 dark:text-white text-sm">Créatif</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="client" class="peer hidden">
                                <div
                                    class="p-4 border-2 border-gray-100 dark:border-gray-800 rounded-2xl transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 dark:peer-checked:bg-indigo-900/20 group-hover:border-gray-200 text-center">
                                    <span class="text-3xl block mb-2">🔍</span>
                                    <span class="block font-bold text-gray-800 dark:text-white text-sm">Client</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="username" :value="__('Nom d’utilisateur')" class="font-bold ml-1" />
                            <x-text-input id="username" class="block mt-1 w-full !rounded-xl border-gray-200"
                                type="text" name="username" :value="old('username')" required autofocus
                                placeholder="Ex: Studio_Vinci" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="font-bold ml-1" />
                            <x-text-input id="email" class="block mt-1 w-full !rounded-xl border-gray-200"
                                type="email" name="email" :value="old('email')" required
                                placeholder="nom@exemple.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="password" :value="__('Mot de passe')" class="font-bold ml-1" />
                                <div class="relative mt-1">
                                    <x-text-input id="password" class="block w-full pr-10 !rounded-xl border-gray-200"
                                        type="password" name="password" required />
                                    <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')"
                                        class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                        <svg id="togglePasswordIcon" class="w-5 h-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirmation')" class="font-bold ml-1" />
                                <x-text-input id="password_confirmation"
                                    class="block mt-1 w-full !rounded-xl border-gray-200" type="password"
                                    name="password_confirmation" required />
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 px-6 rounded-xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all transform active:scale-[0.98] tracking-widest uppercase text-sm">
                            Commencer l'aventure
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3l18 18M9.88 9.88a3 3 0 104.24 4.24M15.12 15.12C13.5 16.5 12 17 12 17c-4.477 0-8.268-2.943-9.542-7a11.97 11.97 0 012.76-4.04l1.7 1.7" />`;
            } else {
                input.type = "password";
                icon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /><circle cx="12" cy="12" r="3" />`;
            }
        }
    </script>
</x-guest-layout>

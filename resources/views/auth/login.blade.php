<x-guest-layout>
    <div class="flex min-h-screen bg-white dark:bg-gray-900">

        <div class="hidden lg:block lg:w-1/2 relative">
            <img src="https://i.pinimg.com/736x/82/7a/dc/827adc7f7265d3f9a296bfdc6e3f9b83.jpg"
                class="absolute inset-0 w-full h-full object-cover" alt="Background">
            {{-- <div class="absolute inset-0 bg-indigo-900/20 backdrop-blur-[2px]"></div> --}}
        </div>

        <div class="flex flex-col justify-center items-center w-full lg:w-1/2 p-8 sm:p-12 md:p-16">
            <div class="w-full max-w-md">

                <div class="mb-10 text-center">
                    <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-110">
                        <x-application-logo class="w-16 h-16 fill-current text-indigo-600" />
                    </a>
                    <h2 class="mt-6 text-3xl font-black text-gray-900 dark:text-white tracking-tight">Ravi de vous
                        revoir !</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Accédez à votre espace créatif en un clic.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mb-6">
                    <button type="button"
                        class="w-full flex items-center justify-center gap-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 px-4 py-3 rounded-xl shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        <svg class="w-5 h-5" viewBox="0 0 48 48">
                            <path fill="#FFC107"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                            <path fill="#FF3D00"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                            </path>
                            <path fill="#4CAF50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                            </path>
                            <path fill="#1976D2"
                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>
                        <span
                            class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-tighter">Continuer
                            avec Google</span>
                    </button>
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm"><span
                            class="px-2 bg-white dark:bg-gray-900 text-gray-400 uppercase text-xs font-bold">ou via
                            email</span></div>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="font-bold ml-1" />
                        <x-text-input id="email" class="block mt-1 w-full !rounded-xl" type="email" name="email"
                            :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center ml-1">
                            <x-input-label for="password" :value="__('Mot de passe')" class="font-bold" />
                            @if (Route::has('password.request'))
                                <a class="text-xs text-indigo-600 hover:underline"
                                    href="{{ route('password.request') }}">Oublié ?</a>
                            @endif
                        </div>
                        <div class="relative mt-1">
                            <x-text-input id="password" class="block w-full pr-10 !rounded-xl" type="password"
                                name="password" required autocomplete="current-password" />
                            <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-indigo-600 transition">
                                <svg id="togglePasswordIcon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded-lg border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-500">{{ __('Rester connecté') }}</span>
                        </label>
                    </div>

                    <x-primary-button
                        class="w-full justify-center py-3 !rounded-xl !bg-indigo-600 hover:!bg-indigo-700 text-base font-black uppercase tracking-widest transition transform active:scale-95 shadow-lg shadow-indigo-200 dark:shadow-none">
                        {{ __('Se connecter') }}
                    </x-primary-button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400 font-medium">
                    Nouveau ici ?
                    <a href="{{ route('register') }}"
                        class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 font-bold decoration-2 underline-offset-4 hover:underline">
                        Créer un compte créatif
                    </a>
                </p>
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
                    `<path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M9.88 9.88a3 3 0 104.24 4.24M15.12 15.12C13.5 16.5 12 17 12 17c-4.477 0-8.268-2.943-9.542-7a11.97 11.97 0 012.76-4.04l1.7 1.7" />`;
            } else {
                input.type = "password";
                icon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /><circle cx="12" cy="12" r="3" />`;
            }
        }
    </script>
</x-guest-layout>

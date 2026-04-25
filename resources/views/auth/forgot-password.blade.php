<x-guest-layout>
    <div class="min-h-screen flex">

        {{-- GAUCHE --}}
        <div
            class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-[#050810] flex-col justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute top-0 right-0 w-[60%] h-[60%] rounded-full bg-indigo-600/10 blur-[120px]"></div>
                <div class="absolute bottom-0 left-0 w-[40%] h-[40%] rounded-full bg-violet-600/10 blur-[100px]"></div>
            </div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center mb-8">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-white leading-tight mb-4">
                    Retrouvez<br>votre accès.
                </h2>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    Entrez votre email et nous vous enverrons un lien sécurisé pour réinitialiser votre mot de passe.
                </p>
                <div class="mt-10 bg-white/5 border border-white/10 rounded-2xl p-5">
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Le lien de réinitialisation est valable <span class="text-white font-semibold">60
                            minutes</span>. Si vous ne trouvez pas l'email, vérifiez vos spams.
                    </p>
                </div>
            </div>
        </div>

        {{-- DROITE --}}
        <div class="flex-1 flex flex-col justify-center px-6 py-10 sm:px-10 lg:px-16 xl:px-20 bg-white">
            <div class="w-full max-w-md mx-auto">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="inline-block mb-8">
                    <x-application-logo class="h-9 w-auto fill-current text-indigo-600" />
                </a>

                <h1 class="text-2xl font-black text-gray-900 mb-1">Mot de passe oublié ?</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Pas de panique — ça arrive à tout le monde.
                </p>

                {{-- Status --}}
                @if (session('status'))
                    <div
                        class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-semibold">
                        ✅ {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Adresse email</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="votre@email.com"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
                    </div>

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-indigo-200 hover:scale-[1.01] active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Envoyer le lien de réinitialisation
                    </button>
                </form>

                <div class="text-center mt-8">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à la connexion
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>

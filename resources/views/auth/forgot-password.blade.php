<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Mot de passe oublié ?</h2>
            <p class="text-sm text-gray-500 mt-2 leading-relaxed px-4">
                {{ __('Entrez votre email ci-dessous pour recevoir un lien de réinitialisation sécurisé.') }}
            </p>
        </div>

        <x-auth-session-status
            class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 text-sm font-medium"
            :status="session('status')" />

        <div class="bg-white p-8 rounded-3xl border border-gray-100">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-black text-gray-700 uppercase tracking-widest mb-2">
                        Adresse Email
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                        <input id="email"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm transition-all"
                            type="email" name="email" :value="old('email')" placeholder="nom@exemple.com" required
                            autofocus />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-medium text-red-500" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center items-center px-6 py-4 bg-indigo-600 text-white rounded-2xl font-black hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all shadow-lg shadow-indigo-100">
                        {{ __('Envoyer le lien') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('login') }}"
                class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour à la connexion
            </a>
        </div>
    </div>
</x-guest-layout>

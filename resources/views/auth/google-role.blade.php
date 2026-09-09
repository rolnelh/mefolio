<x-guest-layout>
    <div class="min-h-screen flex">

        <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-between p-10 bg-[#050810] overflow-hidden">
            <div aria-hidden="true" class="absolute inset-0">
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-indigo-600/30 rounded-full blur-3xl"></div>
                <div class="absolute top-1/3 -right-20 w-80 h-80 bg-violet-600/20 rounded-full blur-3xl"></div>
                <div class="absolute inset-0 opacity-[0.15]"
                    style="background-image: radial-gradient(rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 26px 26px;">
                </div>
            </div>

            <a href="{{ route('home') }}" class="relative z-10 inline-flex items-center gap-2 w-fit transition-transform hover:scale-105">
                <x-application-logo class="h-8 w-auto text-white" />
                <span class="font-bold text-lg text-white">Mefolio</span>
            </a>

            <div class="relative z-10 py-16">
                <h2 class="text-4xl font-black text-white leading-tight mb-4">
                    {{ __('Presque prêt, :firstname.', ['firstname' => $pending['name'] ? explode(' ', $pending['name'])[0] : '']) }}
                </h2>
                <p class="text-gray-400 text-base leading-relaxed max-w-sm">
                    {{ __('Une dernière précision et votre compte Mefolio est prêt.') }}
                </p>
            </div>

            <p class="relative z-10 text-gray-600 text-xs">© {{ now()->year }} Mefolio</p>
        </div>

        <div class="flex-1 lg:w-1/2 flex flex-col justify-center px-6 py-4 sm:px-12 lg:px-20 xl:px-32 bg-white">
            <div class="w-full max-w-md mx-auto">

                <a href="{{ route('home') }}" class="lg:hidden inline-flex items-center gap-2 mb-8 transition-transform hover:scale-105">
                    <x-application-logo class="h-9 w-auto text-indigo-600" />
                    <span class="font-bold text-xl text-gray-900">Mefolio</span>
                </a>

                <div class="flex items-center gap-3 mb-6 p-3 bg-gray-50 rounded-xl">
                    <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-black flex-shrink-0">
                        {{ strtoupper(substr($pending['name'] ?: $pending['email'], 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-gray-900 truncate">{{ $pending['name'] ?: $pending['email'] }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $pending['email'] }}</p>
                    </div>
                </div>

                <h1 class="text-2xl font-black text-gray-900 mb-2">{{ __('Finalisez votre inscription') }}</h1>
                <p class="text-sm text-gray-500 mb-8">
                    {{ __('Comment souhaitez-vous utiliser Mefolio ?') }}
                </p>

                <form method="POST" action="{{ route('google.role.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="creatif" class="peer hidden" checked>
                            <div
                                class="p-4 border rounded-xl text-center border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition hover:border-gray-300">
                                <svg class="w-5 h-5 mx-auto mb-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                                </svg>
                                <span class="text-sm font-semibold">{{ __('Créatif') }}</span>
                                <span class="block text-[11px] text-gray-400 mt-0.5">{{ __('Portfolio, missions') }}</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="client" class="peer hidden">
                            <div
                                class="p-4 border rounded-xl text-center border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition hover:border-gray-300">
                                <svg class="w-5 h-5 mx-auto mb-1 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                <span class="text-sm font-semibold">{{ __('Client') }}</span>
                                <span class="block text-[11px] text-gray-400 mt-0.5">{{ __('Trouver des talents') }}</span>
                            </div>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('role')" />

                    <button type="submit"
                        class="w-full bg-[#050810] hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-all hover:scale-[1.01] active:scale-95 shadow-xl shadow-indigo-100 text-sm">
                        {{ __('Créer mon compte') }} →
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>

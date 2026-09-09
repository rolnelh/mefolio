{{--
    Section témoignages — carrousel Alpine.js (une citation visible à la
    fois, navigation précédent/suivant). Ne s'affiche pas s'il n'y a aucun
    témoignage publié. Variables attendues : $testimonials (Collection).
--}}
@if ($testimonials->count())
    <section class="py-24 px-6 max-w-6xl mx-auto">
        <div x-data="{ i: 0, total: {{ $testimonials->count() }} }" class="bg-[#FAFAF8] rounded-[2rem] overflow-hidden grid grid-cols-1 md:grid-cols-2">

            {{-- Colonne gauche --}}
            <div class="p-10 md:p-14 flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight leading-snug">
                        Des histoires de créatifs qui ont trouvé leur visibilité, avancé plus vite et
                        travaillé avec plus de sérénité.
                    </h2>
                </div>

                @if ($testimonials->count() > 1)
                    <div class="flex items-center gap-3 mt-10">
                        <button @click="i = (i - 1 + total) % total"
                            class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-gray-900 hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button @click="i = (i + 1) % total"
                            class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-gray-900 hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            {{-- Colonne droite : citation active --}}
            <div class="bg-white p-10 md:p-14 flex flex-col justify-between border-t md:border-t-0 md:border-l border-gray-100">
                @foreach ($testimonials as $index => $testimonial)
                    <div x-show="i === {{ $index }}" x-cloak x-transition.opacity>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-4">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} / {{ str_pad($testimonials->count(), 2, '0', STR_PAD_LEFT) }}
                        </p>
                        <p class="text-2xl md:text-[28px] font-bold text-slate-900 leading-tight mb-8">
                            {{ $testimonial->quote }}
                        </p>
                        <div class="flex items-center gap-3">
                            @if ($testimonial->photo)
                                <img src="{{ $testimonial->photo }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $testimonial->name }}">
                            @else
                                <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $testimonial->name }}</p>
                                @if ($testimonial->role)
                                    <p class="text-xs text-gray-400">{{ $testimonial->role }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

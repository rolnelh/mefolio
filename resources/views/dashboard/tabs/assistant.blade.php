{{--
    Onglet "Assistant IA" — chat Alpine.js branché sur AIAssistantController
    (route `assistant.chat`, throttle 15/min). Aucune variable de vue requise.
--}}
<div x-data="mefolioAssistant()" x-init="init()" class="flex flex-col"
    style="height: calc(100vh - 220px); min-height: 480px;">

    <div class="mb-4">
        <h2 class="text-lg font-black text-gray-900">{{ __('Assistant IA') }}</h2>
        <p class="text-xs text-gray-400 mt-0.5">{{ __('Un coup de main pour peaufiner votre profil créatif : bio, spécialité, présentation de votre portfolio.') }}</p>
    </div>

    <div class="flex-1 min-h-0 bg-white border border-gray-100 rounded-2xl flex flex-col overflow-hidden">

        <div x-ref="thread" class="flex-1 overflow-y-auto p-5 space-y-4">
            <template x-if="messages.length === 0">
                <div class="h-full flex flex-col items-center justify-center text-center px-6">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 mb-1">{{ __('Comment puis-je vous aider ?') }}</h3>
                    <p class="text-xs text-gray-400 max-w-xs mb-5">{{ __('Posez une question ou choisissez une suggestion pour commencer.') }}</p>
                    <div class="flex flex-wrap justify-center gap-2 max-w-md">
                        <template x-for="suggestion in suggestions" :key="suggestion">
                            <button type="button" @click="send(suggestion)"
                                class="text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-2 rounded-xl transition-all"
                                x-text="suggestion"></button>
                        </template>
                    </div>
                </div>
            </template>

            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                    <div class="max-w-[80%] rounded-2xl px-4 py-2.5 text-sm leading-relaxed whitespace-pre-line"
                        :class="msg.role === 'user'
                            ? 'bg-indigo-600 text-white rounded-br-sm'
                            : (msg.isError ? 'bg-amber-50 text-amber-800 rounded-bl-sm' : 'bg-gray-100 text-gray-800 rounded-bl-sm')"
                        x-text="msg.content"></div>
                </div>
            </template>

            <div class="flex justify-start" x-show="loading" x-cloak>
                <div class="bg-gray-100 text-gray-400 rounded-2xl rounded-bl-sm px-4 py-2.5 text-sm">
                    <span class="inline-flex gap-1">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0ms"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:150ms"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:300ms"></span>
                    </span>
                </div>
            </div>
        </div>

        <form @submit.prevent="send(input); input = ''"
            class="flex items-center gap-2 p-3 border-t border-gray-100">
            <input type="text" x-model="input" :disabled="loading"
                placeholder="{{ __('Ex : aide-moi à écrire ma bio...') }}"
                class="flex-1 border-gray-200 rounded-xl text-sm focus:border-indigo-500 focus:ring-indigo-500 disabled:opacity-50">
            <button type="submit" :disabled="loading || !input.trim()"
                class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-40 disabled:cursor-not-allowed text-white text-sm font-bold rounded-xl transition-all">
                {{ __('Envoyer') }}
            </button>
        </form>
    </div>
</div>

<script>
    // Petit composant Alpine autonome : historique en mémoire (non persisté),
    // envoyé à chaque requête pour donner du contexte à l'assistant.
    function mefolioAssistant() {
        return {
            messages: [],
            input: '',
            loading: false,
            suggestions: [
                @json(__('Aide-moi à écrire ma bio')),
                @json(__('Quels champs compléter en priorité ?')),
                @json(__('Comment formuler ma spécialité ?')),
            ],
            init() {},
            async send(text) {
                text = (text || '').trim();
                if (!text || this.loading) return;

                this.messages.push({ role: 'user', content: text });
                this.loading = true;
                this.scrollDown();

                const history = this.messages
                    .filter(m => !m.isError)
                    .slice(0, -1)
                    .map(m => ({ role: m.role, content: m.content }));

                try {
                    const res = await fetch('{{ route('assistant.chat') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ message: text, history }),
                    });
                    const data = await res.json();

                    if (res.ok) {
                        this.messages.push({ role: 'assistant', content: data.reply });
                    } else {
                        this.messages.push({ role: 'assistant', content: data.message || @json(__('Une erreur est survenue.')), isError: true });
                    }
                } catch (e) {
                    this.messages.push({ role: 'assistant', content: @json(__('Connexion impossible. Vérifiez votre connexion et réessayez.')), isError: true });
                } finally {
                    this.loading = false;
                    this.scrollDown();
                }
            },
            scrollDown() {
                this.$nextTick(() => {
                    const el = this.$refs.thread;
                    if (el) el.scrollTop = el.scrollHeight;
                });
            },
        };
    }
</script>

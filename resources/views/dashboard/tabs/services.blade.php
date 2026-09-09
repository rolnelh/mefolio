{{-- Onglet "Services" — la marketplace de services est encore à venir. --}}
<div
    class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('Services bientôt disponibles') }}</h3>
    <p class="text-sm text-gray-400 text-center max-w-xs mb-6">{{ __('Vous pourrez bientôt proposer vos services et être payé via Mobile Money.') }}</p>
    <a href="{{ route('services.index') }}"
        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-full transition-all">
        {{ __("En savoir plus") }} →
    </a>
</div>

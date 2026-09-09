{{--
    Onglet "Paiements" — moyens de paiement Mobile Money Afrique +
    internationaux + virement bancaire. Aucune variable requise (utilise
    Auth::user() directement).
--}}
@php $mesMoyens = Auth::user()->payment_methods ?? []; @endphp
<form method="POST" action="{{ route('profile.payment-methods.update') }}" class="space-y-6">
    @csrf
    @method('PUT')
    <div>
        <h2 class="text-lg font-black text-gray-900">Moyens de paiement</h2>
        <p class="text-sm text-gray-400 mt-1">Choisissez comment vous souhaitez être payé pour vos
            missions.</p>
    </div>

    {{-- Mobile Money Afrique --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <div class="flex items-center gap-3 mb-5">
            <div>
                <h3 class="font-bold text-gray-900 text-sm">Mobile Money Afrique</h3>
                <p class="text-xs text-gray-400">Paiements locaux recommandés</p>
            </div>
            <span
                class="ml-auto text-[10px] bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-full">Recommandé</span>
        </div>

        <div class="space-y-3">
            @foreach ([['id' => 'mtn', 'nom' => 'MTN Mobile Money', 'pays' => 'Bénin, Ghana, Côte d\'Ivoire...', 'color' => 'bg-yellow-400', 'logo' => 'MTN'], ['id' => 'moov', 'nom' => 'Moov Money', 'pays' => 'Bénin, Togo, Niger...', 'color' => 'bg-blue-500', 'logo' => 'MOOV'], ['id' => 'wave', 'nom' => 'Wave', 'pays' => 'Sénégal, Côte d\'Ivoire...', 'color' => 'bg-sky-400', 'logo' => 'WAVE'], ['id' => 'orange', 'nom' => 'Orange Money', 'pays' => 'Afrique francophone', 'color' => 'bg-orange-500', 'logo' => 'OM'], ['id' => 'kkiapay', 'nom' => 'Kkiapay', 'pays' => 'Bénin & Afrique de l\'Ouest', 'color' => 'bg-indigo-600', 'logo' => 'KK'], ['id' => 'fedapay', 'nom' => 'FedaPay', 'pays' => 'Bénin, Togo, Sénégal...', 'color' => 'bg-violet-600', 'logo' => 'FEDA']] as $pm)
                <label
                    class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-indigo-200 hover:bg-indigo-50/20 transition-all group">
                    <input type="checkbox" name="paiements[]" value="{{ $pm['id'] }}" @checked(in_array($pm['id'], $mesMoyens))
                        class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500">
                    <div
                        class="w-10 h-10 {{ $pm['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                        <span
                            class="text-white text-[9px] font-black tracking-tight">{{ $pm['logo'] }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ $pm['nom'] }}</p>
                        <p class="text-xs text-gray-400">{{ $pm['pays'] }}</p>
                    </div>
                    <div
                        class="w-2 h-2 rounded-full bg-green-400 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </label>
            @endforeach
        </div>

        {{-- Numéro Mobile Money --}}
        <div class="mt-4 pt-4 border-t border-gray-50">
            <label class="block text-xs font-bold text-gray-700 mb-1.5">Numéro Mobile Money</label>
            <div class="flex gap-2">
                <select name="payment_phone_prefix"
                    class="px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                    @foreach (['+229', '+221', '+225', '+233', '+223', '+234'] as $prefix)
                        <option value="{{ $prefix }}" @selected(Auth::user()->payment_phone_prefix === $prefix)>{{ $prefix }}</option>
                    @endforeach
                </select>
                <input type="tel" name="payment_phone" value="{{ Auth::user()->payment_phone }}" placeholder="Ex: 97000000"
                    class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>
    </div>

    {{-- Paiements internationaux --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <div class="flex items-center gap-3 mb-5">
            <div>
                <h3 class="font-bold text-gray-900 text-sm">Paiements Internationaux</h3>
                <p class="text-xs text-gray-400">Pour les clients hors Afrique</p>
            </div>
        </div>

        <div class="space-y-3">
            {{-- PayPal --}}
            <label
                class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-blue-200 hover:bg-blue-50/20 transition-all">
                <input type="checkbox" name="paiements[]" value="paypal" @checked(in_array('paypal', $mesMoyens))
                    class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                <div
                    class="w-10 h-10 bg-[#003087] rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-4" viewBox="0 0 124 33" fill="none">
                        <path
                            d="M46.2 8.1H35.6c-.7 0-1.3.5-1.4 1.2L30 30.1c-.1.5.3 1 .8 1h5.3c.7 0 1.3-.5 1.4-1.2l1-6.5c.1-.7.7-1.2 1.4-1.2h3.3c6.9 0 10.9-3.3 11.9-9.9.5-2.9 0-5.1-1.3-6.7-1.5-1.7-4.1-2.5-7.6-2.5z"
                            fill="#009cde" />
                        <path
                            d="M46.2 8.1H35.6c-.7 0-1.3.5-1.4 1.2L30 30.1c-.1.5.3 1 .8 1h5.3c.7 0 1.3-.5 1.4-1.2l1-6.5c.1-.7.7-1.2 1.4-1.2h3.3c6.9 0 10.9-3.3 11.9-9.9.5-2.9 0-5.1-1.3-6.7-1.5-1.7-4.1-2.5-7.6-2.5z"
                            fill="#012169" opacity=".5" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">PayPal</p>
                    <p class="text-xs text-gray-400">Paiements en USD/EUR</p>
                </div>
                <span
                    class="text-[10px] bg-blue-50 text-blue-600 font-semibold px-2 py-0.5 rounded-full">International</span>
            </label>

            {{-- Stripe --}}
            <label
                class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-violet-200 hover:bg-violet-50/20 transition-all">
                <input type="checkbox" name="paiements[]" value="stripe" @checked(in_array('stripe', $mesMoyens))
                    class="w-4 h-4 rounded text-violet-600 focus:ring-violet-500">
                <div
                    class="w-10 h-10 bg-[#635bff] rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 60 25" fill="white">
                        <path
                            d="M59.6 10.8c0-3.6-1.8-6.4-5.2-6.4-3.4 0-5.5 2.8-5.5 6.4 0 4.2 2.4 6.3 5.8 6.3 1.7 0 3-.4 3.9-1v-2.8c-.9.5-2 .8-3.4.8-1.3 0-2.5-.5-2.7-2.2h6.8c.2-.3.3-.9.3-1.1zm-6.9-1.4c0-1.7 1-2.4 2-2.4 1 0 1.9.7 1.9 2.4h-3.9zM41.6 4.4c-1.4 0-2.3.6-2.8 1.1l-.2-.9h-3.1v16.9l3.5-.7.1-4.1c.5.4 1.3.9 2.5.9 2.5 0 4.8-2 4.8-6.4-.1-4.1-2.4-6.8-4.8-6.8zm-.8 10.4c-.8 0-1.3-.3-1.7-.7l-.1-5.4c.4-.4.9-.7 1.8-.7 1.4 0 2.3 1.5 2.3 3.4 0 2-.9 3.4-2.3 3.4zM33 3.3l-3.5.7v2.8l3.5-.7V3.3zM29.5 6.4h3.5v10.3h-3.5V6.4zM25.7 7.4l-.2-1H22.4v10h3.5v-6.8c.8-1.1 2.2-.9 2.6-.7V6.4c-.5-.2-2.2-.5-2.8 1zM18.9 4.4c-1.2 0-2 .6-2.5 1l-.1-.9h-3.1v10.3h3.5V8.6c.4-.5 1-.8 1.7-.8.7 0 1.2.3 1.2 1.4v7.6h3.5V9c0-3.1-1.7-4.6-4.2-4.6zM7.5 8.8L7.1 7H4.3L4.2 21l3.5-.7.1-4.4c.5.3 1.1.5 2 .5 2.6 0 4.9-2 4.9-6.4 0-4.1-2.4-6.8-4.9-6.8-1 0-2 .5-2.3.6zm.5 9.4c-.8 0-1.3-.3-1.7-.7l-.1-5.4c.4-.5.9-.7 1.8-.7 1.4 0 2.3 1.5 2.3 3.4 0 2-.9 3.4-2.3 3.4z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Stripe</p>
                    <p class="text-xs text-gray-400">Cartes bancaires internationales</p>
                </div>
                <span
                    class="text-[10px] bg-violet-50 text-violet-600 font-semibold px-2 py-0.5 rounded-full">International</span>
            </label>

            {{-- Wise --}}
            <label
                class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-green-200 hover:bg-green-50/20 transition-all">
                <input type="checkbox" name="paiements[]" value="wise" @checked(in_array('wise', $mesMoyens))
                    class="w-4 h-4 rounded text-green-600 focus:ring-green-500">
                <div
                    class="w-10 h-10 bg-[#9fe870] rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-[#163300] font-black text-xs">WISE</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Wise (TransferWise)</p>
                    <p class="text-xs text-gray-400">Virements internationaux</p>
                </div>
                <span
                    class="text-[10px] bg-green-50 text-green-600 font-semibold px-2 py-0.5 rounded-full">International</span>
            </label>
        </div>
    </div>

    {{-- Virement bancaire --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
        <div class="flex items-center gap-3 mb-4">
            <div>
                <h3 class="font-bold text-gray-900 text-sm">Virement Bancaire</h3>
                <p class="text-xs text-gray-400">Pour les grandes transactions</p>
            </div>
        </div>
        <label
            class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl cursor-pointer hover:border-gray-300 transition-all">
            <input type="checkbox" name="paiements[]" value="virement" @checked(in_array('virement', $mesMoyens))
                class="w-4 h-4 rounded text-gray-600">
            <div
                class="w-10 h-10 bg-gray-800 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="text-white text-[9px] font-black">BANK</span>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-900">Virement bancaire (IBAN)</p>
                <p class="text-xs text-gray-400">Délai 2-5 jours ouvrés</p>
            </div>
        </label>
    </div>

    {{-- Bouton sauvegarder --}}
    <div class="flex justify-end">
        <button type="submit"
            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200">
            Sauvegarder mes moyens de paiement
        </button>
    </div>
</form>

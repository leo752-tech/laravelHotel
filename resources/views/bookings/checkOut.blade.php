<x-layout>
    <div class="py-12 bg-base-200">
        <div class="max-w-4xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="order-2 md:order-1">
                    <h2 class="text-xl font-bold mb-4">Riepilogo Prenotazione</h2>
                    <div class="card bg-white shadow-lg p-6">
                        <p class="font-bold text-lg text-primary">{{ $room->name }}</p>
                        <div class="divider my-2"></div>
                        <div class="flex justify-between"><span>Check-in:</span> <span>{{ $checkIn }}</span></div>
                        <div class="flex justify-between"><span>Check-out:</span> <span>{{ $checkOut }}</span></div>
                        <div class="flex justify-between font-bold mt-4 text-xl">
                            <span>Totale da pagare:</span>
                            <span class="text-success">€{{ number_format($totalPrice, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 md:order-2">
                    <h2 class="text-xl font-bold mb-4">Pagamento Sicuro</h2>
                    <div class="card bg-white shadow-xl p-6 border-t-4 border-primary">
                        <form action="{{ route('processPayment') }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="amount" value="{{ $totalPrice }}">
                            @foreach($selectedExtrasIds as $serviceId)
                            <input type="hidden" name="extras[]" value="{{ $serviceId }}">
                            @endforeach

                            <div class="form-control mb-4">
                                <label class="label"><span class="label-text">Intestatario Carta</span></label>
                                <input type="text" placeholder="Nome sulla carta" name="cardHolderName" class="input input-bordered" required />
                            </div>

                            <div class="form-control mb-4">
                                <label class="label"><span class="label-text">Numero Carta</span></label>
                                <div class="relative">
                                    <input type="text" placeholder="**** **** **** ****" name="lastFourDigits" class="input input-bordered w-full" maxlength="16" required />
                                    <div class="absolute right-3 top-3 opacity-50">💳</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Scadenza</span></label>
                                    <input type="text" placeholder="MM/YY" class="input input-bordered" maxlength="5" required />
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">CVV</span></label>
                                    <input type="password" placeholder="***" class="input input-bordered" maxlength="3" required />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-8" id="pay-button">
                                <span id="btn-text">Paga Ora €{{ number_format($totalPrice, 2) }}</span>
                            </button>
                        </form>
                    </div>
                    <p class="text-center text-xs opacity-50 mt-4">🔒 Transazione protetta da crittografia SSL</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment-form').onsubmit = function() {
            const btn = document.getElementById('pay-button');
            btn.classList.add('loading');
            btn.innerText = "Elaborazione transazione...";
        };
    </script>
</x-layout>
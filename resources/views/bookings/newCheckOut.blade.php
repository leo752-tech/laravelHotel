<x-layoutBooking title="Conferma Prenotazione - SuiteDirect">

    {{-- Sfondo globale morbido --}}
    <div class="bg-[#F4F1EE] min-h-screen py-8 pb-32">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 1. CORREZIONE STICKY: Rimosso items-start e aggiunto relative --}}
            <div class="flex flex-col lg:flex-row gap-6 relative">

                {{-- ======================================================== --}}
                {{-- COLONNA SINISTRA: RIEPILOGO (Sticky)                     --}}
                {{-- ======================================================== --}}
                <aside class="w-full lg:w-1/4 xl:w-[22%] shrink-0">
                    <div class="sticky top-24 space-y-4">

                        {{-- Box Ricerca --}}
                        <div class="bg-white rounded shadow-sm border border-gray-200 p-5">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-sm font-bold text-[#003366]">La tua ricerca</h2>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 border border-gray-200 p-2 rounded text-sm text-gray-700">
                                    <i class="fa-regular fa-calendar text-[#D3C1B3]"></i>
                                    {{ $checkIn }} - {{ $checkOut }}
                                </div>
                                <div class="flex items-center gap-3 border border-gray-200 p-2 rounded text-sm text-gray-700">
                                    <i class="fa-regular fa-user text-[#D3C1B3]"></i>
                                    {{-- 2. CORREZIONE BLADE: Doppie graffe --}}
                                    {{ $guests }} Adulti
                                </div>
                            </div>
                        </div>

                        {{-- Box Prenotazione --}}
                        <div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-5">
                                <h2 class="text-sm font-bold text-[#003366] mb-4">La tua prenotazione</h2>

                                {{-- Camera --}}
                                <div class="flex justify-between items-start border-b border-gray-100 pb-3 mb-3">
                                    <div class="flex gap-2">
                                        <i class="fa-solid fa-bed text-gray-400 mt-1"></i>
                                        <div>
                                            {{-- 2. CORREZIONE BLADE: Doppie graffe --}}
                                            <p class="text-sm font-bold text-[#003366]">{{ $room->name }}</p>
                                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">Tariffa flessibile - cancellazione gratuita - Camera e Colazione, {{ $guests }} Adulti, Spa</p>
                                        </div>
                                    </div>
                                    {{-- Formattiamo anche bene il prezzo --}}
                                    <span class="text-sm font-bold text-[#003366]">€ {{ number_format($totalPrice, 2, ',', '.') }}</span>
                                </div>

                                {{-- Extra --}}
                                <div class="flex justify-between items-start pb-3">
                                    <div class="flex gap-2">
                                        <i class="fa-regular fa-gem text-gray-400 mt-1"></i>
                                        <div>
                                            <p class="text-sm text-[#003366]">Private Spa</p>
                                            <p class="text-xs text-gray-500">{{ $checkIn }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-[#003366]">Incl.</span>
                                </div>
                            </div>

                            {{-- Totale --}}
                            <div class="bg-[#E6F4EA] p-4 flex justify-between items-center border-t border-green-200">
                                <span class="text-sm font-bold text-green-900">Totale <span class="font-normal text-xs">(IVA inclusa)</span></span>
                                <span class="text-lg font-bold text-green-700">€ {{ number_format($totalPrice, 2, ',', '.') }}</span>
                            </div>

                            {{-- Nota: Nelle colonne laterali non serve il bottone "submit" verde se è già in basso e al centro, ma se vuoi tenerlo, lascialo! --}}
                        </div>
                    </div>
                </aside>

                {{-- ... Qui continua il tuo form centrale ... --}}

                {{-- ======================================================== --}}
                {{-- COLONNA CENTRALE: FORM DATI (Scorrevole)                 --}}
                {{-- ======================================================== --}}
                <div class="w-full lg:w-2/4 xl:w-[56%] space-y-8">

                    <form action="#" method="POST" class="space-y-8">
                        @csrf

                        {{-- Login Rapido --}}
                        <div class="bg-[#F0F4F8] p-4 rounded border border-blue-100 flex justify-between items-center">
                            <span class="text-sm text-[#003366]">Accedi velocemente con il tuo account</span>
                            <div class="flex gap-3">
                                <a href="#" class="text-gray-600 hover:text-blue-600"><i class="fa-brands fa-facebook text-xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-red-500"><i class="fa-brands fa-google text-xl"></i></a>
                            </div>
                        </div>

                        {{-- Dati Personali --}}
                        <div>
                            <h3 class="text-lg font-bold text-[#003366] mb-4 border-b pb-2">Dati personali cliente</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-6 rounded shadow-sm border border-gray-200">
                                <div>
                                    <input type="text" name="nome" placeholder="Nome *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div>
                                    <input type="text" name="cognome" placeholder="Cognome *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div>
                                    <input type="email" name="email" placeholder="Email *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div>
                                    <input type="email" name="conferma_email" placeholder="Conferma Email *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div class="flex gap-2">
                                    <select class="w-1/3 border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3]">
                                        <option>+39</option>
                                    </select>
                                    <input type="tel" name="telefono" placeholder="Telefono *" class="w-2/3 border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3]">
                                </div>
                                <div class="flex gap-2">
                                    <select class="w-1/3 border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3]">
                                        <option>+39</option>
                                    </select>
                                    <input type="tel" name="cellulare" placeholder="Cellulare *" class="w-2/3 border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3]">
                                </div>
                                <div class="md:col-span-2 flex items-center gap-2 mt-2">
                                    <input type="checkbox" id="create_account" class="rounded border-gray-300 text-[#006BB3] focus:ring-[#006BB3]">
                                    <label for="create_account" class="text-sm text-gray-700">Crea un account con l'e-mail specificata</label>
                                </div>
                            </div>
                        </div>

                        {{-- Carta di Credito --}}
                        <div>
                            <div id="payment-element">
                            </div>
                            <div id="payment-message" class="hidden text-red-500 text-sm mt-2"></div>
                        </div>

                        {{-- Termini e Condizioni --}}
                        <div>
                            <h3 class="text-lg font-bold text-[#003366] mb-4 border-b pb-2">Conferma la prenotazione</h3>
                            <div class="space-y-3">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" class="mt-1 rounded border-gray-300 text-[#00A651] focus:ring-[#00A651]">
                                    <span class="text-sm text-gray-700">Accetto di ricevere promozioni e materiale informativo via e-mail</span>
                                </label>
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" required class="mt-1 rounded border-gray-300 text-[#00A651] focus:ring-[#00A651]">
                                    <span class="text-sm text-gray-700">Sì, ho letto e accetto l'informativa sulla privacy (<a href="#" class="underline">Leggi l'informativa</a>)</span>
                                </label>
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" required class="mt-1 rounded border-gray-300 text-[#00A651] focus:ring-[#00A651]">
                                    <span class="text-sm text-gray-700">Sì, ho letto e accetto i termini e le condizioni (<a href="#" class="underline">Leggi i termini e le condizioni</a>)</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-[#00A651] hover:bg-green-700 text-white font-bold py-4 mt-6 rounded text-sm transition">
                                CONFERMA LA PRENOTAZIONE
                            </button>
                        </div>

                    </form>
                </div>

                {{-- ======================================================== --}}
                {{-- COLONNA DESTRA: VANTAGGI (Sticky)                        --}}
                {{-- ======================================================== --}}
                <aside class="hidden xl:block xl:w-[22%] shrink-0">
                    <div class="sticky top-24 space-y-4">

                        {{-- Vantaggi Box --}}
                        <div class="bg-white rounded shadow-sm border border-gray-200 p-5">
                            <h2 class="text-[#D3C1B3] font-bold text-lg mb-4 leading-tight">prenota dal nostro sito...<br>conviene</h2>

                            <ul class="space-y-4 text-sm text-gray-700">
                                <li class="flex gap-3 items-center border-b border-gray-100 pb-3">
                                    <i class="fa-solid fa-check text-gray-400"></i> Miglior prezzo garantito!
                                </li>
                                <li class="flex gap-3 items-center border-b border-gray-100 pb-3">
                                    <i class="fa-solid fa-check text-gray-400"></i> Miglior policy di cancellazione.
                                </li>
                                <li class="flex gap-3 items-center border-b border-gray-100 pb-3">
                                    <i class="fa-solid fa-check text-gray-400"></i> Pacchetti ed offerte esclusive.
                                </li>
                                <li class="flex gap-3 items-center border-b border-gray-100 pb-3">
                                    <i class="fa-solid fa-check text-gray-400"></i> Parcheggio gratuito.
                                </li>
                                <li class="flex gap-3 items-center">
                                    <i class="fa-solid fa-check text-gray-400"></i> Accesso alla palestra gratuito.
                                </li>
                            </ul>
                        </div>

                        {{-- SSL Box --}}
                        <div class="bg-[#E6F4EA] border border-green-200 rounded p-4 flex items-center justify-between gap-3">
                            <i class="fa-solid fa-lock text-green-700 text-xl"></i>
                            <p class="text-xs text-green-800 leading-tight flex-1">I tuoi dati sono protetti da cifratura con tecnologia SSL a 2048 bit</p>
                            <i class="fa-solid fa-shield-halved text-yellow-500 text-2xl"></i>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </div>

    {{-- ======================================================== --}}
    {{-- BARRA FISSA IN BASSO (Visibile su mobile e desktop)      --}}
    {{-- ======================================================== --}}
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-50 py-3 px-4 sm:px-8">
        <div class="max-w-[1400px] mx-auto flex items-center justify-between">

            <a href="javascript:history.back()" class="border border-gray-300 text-gray-700 hover:bg-gray-50 py-2 px-4 rounded text-sm font-bold flex items-center gap-2">
                <i class="fa-solid fa-chevron-left text-xs"></i> INDIETRO
            </a>

            <div class="text-xl sm:text-2xl font-bold text-green-600 hidden md:block">
                € 508
            </div>

            <button type="button" onclick="document.querySelector('form').submit()" class="bg-[#00A651] hover:bg-green-700 text-white font-bold py-3 px-6 rounded text-sm transition flex items-center gap-2">
                CONFERMA LA PRENOTAZIONE <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const elements = stripe.elements({
            clientSecret: '{{ $clientSecret }}'
        });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        const form = document.querySelector('form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Conferma il pagamento su Stripe restando sulla tua pagina
            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Dove mandare l'utente se il pagamento va a buon fine
                    return_url: '/booking/success',
                }
            });

            if (error) {
                document.getElementById('payment-message').innerText = error.message;
                document.getElementById('payment-message').classList.remove('hidden');
            }
        });
    </script>

</x-layoutBooking>
<x-layoutBooking title="Conferma Prenotazione - SuiteDirect">

    <div class="bg-[#F4F1EE] min-h-screen py-8 pb-32" x-data="{
        showSocialPopup: false,
        showPassword: false,
        formData: {
            nome: '',
            cognome: '',
            email: ''
        },
        fillFakeData() {
            this.formData.nome = 'Mario';
            this.formData.cognome = 'Rossi';
            this.formData.email = 'mario.rossi@demo.com';
            this.showSocialPopup = false;
        }
    }">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row gap-6 relative">

                {{-- ======================================================== --}}
                {{-- COLONNA SINISTRA: RIEPILOGO (Sticky)                     --}}
                {{-- ======================================================== --}}
                <aside class="w-full lg:w-1/4 xl:w-[22%] shrink-0">
                    <div class="sticky top-24 space-y-4">
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
                                    {{ $guests }} Adulti
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-5">
                                <h2 class="text-sm font-bold text-[#003366] mb-4">La tua prenotazione</h2>
                                <div class="flex justify-between items-start border-b border-gray-100 pb-3 mb-3">
                                    <div class="flex gap-2">
                                        <i class="fa-solid fa-bed text-gray-400 mt-1"></i>
                                        <div>
                                            <p class="text-sm font-bold text-[#003366]">{{ $room->name }}</p>
                                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">Tariffa flessibile - cancellazione gratuita - Camera e Colazione, {{ $guests }} Adulti</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-[#003366]">€ {{ number_format($totalPrice, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="bg-[#E6F4EA] p-4 flex justify-between items-center border-t border-green-200">
                                <span class="text-sm font-bold text-green-900">Totale</span>
                                <span class="text-lg font-bold text-green-700">€ {{ number_format($totalPrice, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- ======================================================== --}}
                {{-- COLONNA CENTRALE: FORM DATI (Scorrevole)                 --}}
                {{-- ======================================================== --}}
                <div class="w-full lg:w-2/4 xl:w-[56%] space-y-8">

                    <form action="{{ route('checkoutDemo')}}" method="POST" class="space-y-8" @submit.prevent>
                        @csrf

                        {{-- Login Rapido --}}
                        <div class="bg-[#F0F4F8] p-4 rounded border border-blue-100 flex justify-between items-center">
                            <span class="text-sm text-[#003366]">Accedi velocemente con il tuo account</span>
                            <div class="flex gap-3">
                                <button type="button" @click="showSocialPopup = true" class="text-gray-600 hover:text-blue-600"><i class="fa-brands fa-facebook text-xl"></i></button>
                                <button type="button" @click="showSocialPopup = true" class="text-gray-600 hover:text-red-500"><i class="fa-brands fa-google text-xl"></i></button>
                            </div>
                        </div>

                        {{-- Dati Personali --}}
                        <div>
                            <h3 class="text-lg font-bold text-[#003366] mb-4 border-b pb-2">Dati personali cliente</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white p-6 rounded shadow-sm border border-gray-200">
                                <div>
                                    <input type="text" name="nome" x-model="formData.nome" placeholder="Nome *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div>
                                    <input type="text" name="cognome" x-model="formData.cognome" placeholder="Cognome *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div>
                                    <input type="email" name="email" x-model="formData.email" placeholder="Email *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                </div>
                                <div>
                                    <input type="email" name="conferma_email" x-model="formData.email" placeholder="Conferma Email *" class="w-full border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
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
                                <div class="md:col-span-2 flex flex-col gap-2 mt-2">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" id="create_account" x-model="showPassword" class="rounded border-gray-300 text-[#006BB3] focus:ring-[#006BB3]">
                                        <label for="create_account" class="text-sm text-gray-700">Crea un account con l'e-mail specificata</label>
                                    </div>
                                    <div x-show="showPassword" x-transition class="mt-2" style="display: none;">
                                        <input type="password" name="password" placeholder="Inserisci una password" class="w-full md:w-1/2 border-gray-300 rounded text-sm p-3 focus:ring-[#006BB3] focus:border-[#006BB3]">
                                        <p class="text-xs text-gray-500 mt-1">La password ti servirà per gestire le tue future prenotazioni.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Carta di Credito con Copia Rapida per Demo --}}
                        <div>
                            <h3 class="text-sm font-bold text-[#003366] mb-2 flex items-center justify-between">
                                <span>Dati di Pagamento (Simulazione)</span>
                                <span class="text-[11px] bg-amber-100 text-amber-800 px-2 py-0.5 rounded border border-amber-200">Modalità Test Active</span>
                            </h3>

                            <div class="bg-white p-5 rounded shadow-sm border border-gray-200 space-y-4">

                                {{-- Badge per il copia-incolla rapido --}}
                                <div class="bg-blue-50 border border-blue-200 p-3 rounded text-xs text-blue-800 space-y-2">
                                    <div>
                                        <i class="fa-solid fa-circle-info mr-1"></i>
                                        <strong>Suggerimento Demo:</strong> Clicca sul numero qui sotto per copiarlo, poi incollalo nel campo "Numero carta".
                                    </div>
                                    <div class="flex flex-wrap gap-2 pt-1">
                                        <button type="button" id="copy-visa-btn" data-card="4242424242424242" class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-2.5 py-1 rounded font-mono font-bold text-[11px] flex items-center gap-1.5 transition active:scale-95">
                                            <i class="fa-brands fa-cc-visa text-blue-600 text-sm"></i> <span>4242 4242 4242 4242</span> <i class="fa-regular fa-copy text-gray-400 ml-1"></i>
                                        </button>
                                        <button type="button" id="copy-master-btn" data-card="5555555555554444" class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 px-2.5 py-1 rounded font-mono font-bold text-[11px] flex items-center gap-1.5 transition active:scale-95">
                                            <i class="fa-brands fa-cc-mastercard text-red-500 text-sm"></i> <span>5555 5555 5555 4444</span> <i class="fa-regular fa-copy text-gray-400 ml-1"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- L'Iframe di Stripe --}}
                                <div id="payment-element"></div>
                                <div id="payment-message" class="hidden text-red-500 text-sm mt-2"></div>
                            </div>
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

                            
                        </div>
                    </form>
                </div>

                {{-- ======================================================== --}}
                {{-- COLONNA DESTRA: VANTAGGI (Sticky)                        --}}
                {{-- ======================================================== --}}
                <aside class="hidden xl:block xl:w-[22%] shrink-0">
                    <div class="sticky top-24 space-y-4">
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
                                    <i class="fa-solid fa-check text-gray-400"></i> Parcheggio gratuito.
                                </li>
                            </ul>
                        </div>
                        <div class="bg-[#E6F4EA] border border-green-200 rounded p-4 flex items-center justify-between gap-3">
                            <i class="fa-solid fa-lock text-green-700 text-xl"></i>
                            <p class="text-xs text-green-800 leading-tight flex-1">I tuoi dati sono protetti da cifratura con tecnologia SSL a 2048 bit</p>
                            <i class="fa-solid fa-shield-halved text-yellow-500 text-2xl"></i>
                        </div>
                    </div>
                </aside>

            </div>
        </div>

        {{-- Modale Social Demo --}}
        <template x-teleport="body">
            <div x-show="showSocialPopup" style="display: none;" @keydown.escape.window="showSocialPopup = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4" x-transition>
                <div @click.away="showSocialPopup = false" class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 relative">
                    <button @click="showSocialPopup = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                    <div class="text-center">
                        <i class="fa-solid fa-flask text-4xl text-[#006BB3] mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Modalità Demo</h3>
                        <p class="text-gray-600 text-sm mb-6">Nella versione finale, questa funzione compilerà automaticamente i dati del cliente estraendoli dal suo account social.<br><br>Vuoi popolare il form con dati fittizi per continuare il test?</p>
                        <div class="flex justify-center gap-3">
                            <button @click="showSocialPopup = false" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded">Annulla</button>
                            <button @click="fillFakeData" class="px-4 py-2 text-sm font-medium text-white bg-[#006BB3] hover:bg-blue-700 rounded">Inserisci Dati Demo</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- BARRA FISSA IN BASSO (Visibile su mobile e desktop) --}}
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-40 py-3 px-4 sm:px-8">
        <div class="max-w-[1400px] mx-auto flex items-center justify-between">
            <a href="javascript:history.back()" class="border border-gray-300 text-gray-700 hover:bg-gray-50 py-2 px-4 rounded text-sm font-bold flex items-center gap-2">
                <i class="fa-solid fa-chevron-left text-xs"></i> INDIETRO
            </a>
            <div class="text-xl sm:text-2xl font-bold text-green-600 hidden md:block">
                € {{ number_format($totalPrice, 2, ',', '.') }}
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

        // LOGICA DI COPIA RAPIDA NEGLI APPUNTI
        function setupCardCopy(buttonId) {
            const btn = document.getElementById(buttonId);
            if (!btn) return;

            btn.addEventListener('click', function() {
                const cardNumber = this.getAttribute('data-card');

                // Sfrutta le API moderne del browser per copiare il testo
                navigator.clipboard.writeText(cardNumber).then(() => {
                    // Feedback visivo di successo sul badge
                    const originalContent = btn.innerHTML;
                    btn.innerHTML = '<i class="fa-solid fa-check text-green-600"></i> <span class="text-green-700">Copiatato! Fai Incolla</span>';
                    btn.classList.add('bg-green-50', 'border-green-300');

                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.classList.remove('bg-green-50', 'border-green-300');
                    }, 2000);
                }).catch(err => {
                    console.error('Errore nel copia negli appunti: ', err);
                });
            });
        }

        // Attiviamo il copia rapida per entrambe le carte demo
        setupCardCopy('copy-visa-btn');
        setupCardCopy('copy-master-btn');

        // Gestione del Submit del Form
        const form = document.querySelector('form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Per la demo saltiamo i controlli reali e andiamo dritti al successo
            window.location.href = '/booking/success';
        });
    </script>

</x-layoutBooking>
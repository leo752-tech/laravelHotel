<x-layoutAdmin>
    <div class="max-w-4xl mx-auto my-8 p-6 bg-white rounded-xl shadow-md border border-gray-100">

        <!-- Intestazione -->
        <div class="border-b border-gray-100 pb-4 mb-6">
            <h2 class="text-xl font-black text-gray-900 tracking-tight uppercase">Inserimento Manuale Prenotazione</h2>
            <p class="text-sm text-gray-500">Registra un nuovo soggiorno direttamente dal pannello amministrativo.</p>
        </div>


        <!-- Form -->
        <form action="{{ route('admin.bookings.store') }}" method="POST" class="space-y-6"
            x-data="{
        // Passiamo un oggetto JSON da Laravel ad Alpine: { '1': 50.00, '2': 75.00, ... }
        roomPrices: {{ json_encode($rooms->pluck('price', 'id')) }},
        
        // Inizializziamo le variabili con i valori old() o i valori passati dalla rotta
        checkIn: '{{ old('checkInDate', $selectedCheckIn ?? '') }}',
        checkOut: '{{ old('checkOutDate') }}',
        roomId: '{{ old('roomId', $selectedRoomId ?? '') }}',
        totalPrice: '{{ old('totalPrice') }}',
        
        // La funzione magica che calcola il prezzo
        calculatePrice() {
            if (this.checkIn && this.checkOut && this.roomId) {
                let start = new Date(this.checkIn);
                let end = new Date(this.checkOut);
                
                // Calcola la differenza in millisecondi, poi converti in giorni
                let diffTime = end.getTime() - start.getTime();
                let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                // Se le date sono valide (almeno 1 notte) e la camera ha un prezzo
                if (days > 0 && this.roomPrices[this.roomId]) {
                    this.totalPrice = (days * this.roomPrices[this.roomId]).toFixed(2);
                }
            }
        }
    }"
            x-init="calculatePrice()" {{-- Calcola il prezzo subito al caricamento se i dati ci sono già --}}>
            @csrf

            <!-- SEZIONE 1: OSPITE E DATE -->
            <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">1. Anagrafica Ospite Principale</h3>

                <!-- Riga 1: Nome e Cognome -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-xs font-bold uppercase text-gray-700 mb-1">Nome</label>
                        <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required placeholder="Es. Mario"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                    <div>
                        <label for="lastName" class="block text-xs font-bold uppercase text-gray-700 mb-1">Cognome</label>
                        <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required placeholder="Es. Rossi"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                </div>

                <!-- Riga 2: Data di Nascita e Residenza -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="birthDate" class="block text-xs font-bold uppercase text-gray-700 mb-1">Data di Nascita</label>
                        <input type="date" id="birthDate" name="birthDate" value="{{ old('birthDate') }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label for="residence" class="block text-xs font-bold uppercase text-gray-700 mb-1">Residenza (Indirizzo, Città, Prov)</label>
                        <input type="text" id="residence" name="residence" value="{{ old('residence') }}" required placeholder="Es. Via Roma 15, Milano (MI)"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    </div>
                </div>
            </div>

            <!-- Check-In -->
            <div>
                <label for="checkInDate" class="block text-xs font-bold uppercase text-gray-700 mb-1">Data Check-In</label>
                <p>{{$checkInDate}}</p>
            </div>

            <!-- Check-Out -->
            <div>
                <label for="checkOutDate" class="block text-xs font-bold uppercase text-gray-700 mb-1">Data Check-Out</label>
                <<input type="date" id="checkOutDate" name="checkOutDate" required
                    x-model="checkOut"
                    @change="calculatePrice()"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
            </div>
    </div>
    </div>

    <!-- SEZIONE 2: CAMERA E STATO -->
    <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-100 space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">2. Alloggio e Stato</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Selezione Camera -->
            <div>
                <label for="roomId" class="block text-xs font-bold uppercase text-gray-700 mb-1">Camera Assegnata</label>
                <p>{{$room->name}}</p>
            </div>

            <!-- Stato Prenotazione -->
            <div>
                <label for="status" class="block text-xs font-bold uppercase text-gray-700 mb-1">Stato Iniziale</label>
                <select id="status" name="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>In Attesa</option>
                    <option value="confirmed" {{ old('status', 'confirmed') == 'confirmed' ? 'selected' : '' }}>Confermata</option>
                    <option value="confirmed" {{ old('status', 'checkedIn') == 'checkedIn' ? 'selected' : '' }}>In camera</option>
                    <option value="confirmed" {{ old('status', 'checkedOut') == 'checkedOut' ? 'selected' : '' }}>In uscita</option>
                </select>
            </div>
        </div>
    </div>

    <!-- SEZIONE 3: CONTABILITÀ -->
    <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100/50 space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-700 mb-2">3. Tariffe e Offerte</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Prezzo Totale -->
            <div>
                <label for="totalPrice" class="block text-xs font-bold uppercase text-gray-700 mb-1">Prezzo Totale (€)</label>
                <div class="relative mt-1 rounded-lg shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-gray-500 sm:text-sm">€</span>
                    </div>
                    <!-- Gestione centesimi: se usi i centesimi nel DB, l'utente scrive 150 e tu nel controller moltiplichi x100 -->
                    <input type="number" min="0" step="0.01" id="totalPrice" name="totalPrice" required
                        x-model="totalPrice"
                        class="block w-full rounded-lg border-gray-300 pl-8 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        placeholder="0,00">
                </div>
                <p class="text-[11px] text-gray-400 mt-1">Inserisci la tariffa totale lorda per l'intero soggiorno.</p>
            </div>

            <!-- Offerta Speciale -->
            <div>
                <label for="specialOfferId" class="block text-xs font-bold uppercase text-gray-700 mb-1">Offerta Speciale (Opzionale)</label>
                <select id="specialOfferId" name="specialOfferId" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="">Nessuna offerta applicata</option>
                    @foreach($specialOffers as $offer)
                    <option value="{{ $offer->id }}" {{ old('specialOfferId') == $offer->id ? 'selected' : '' }}>
                        {{ $offer->title ?? 'Offerta #' . $offer->id }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Pulsanti di Azione -->
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
        <a href="{{ url()->previous() }}" class="rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-all">
            Annulla
        </a>
        <button type="submit" class="rounded-lg bg-gray-950 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
            Salva Prenotazione
        </button>
    </div>
    </form>
    </div>
</x-layoutAdmin>
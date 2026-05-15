<x-layoutBooking title="Verifica Disponibilità - SuiteDirect">

    {{-- Sfondo che richiama il colore caldo/sabbia dell'immagine --}}
    <div class="bg-[#D3C1B3] min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row gap-6">

                {{-- COLONNA SINISTRA: Modulo di Ricerca (Stile Immagine) --}}
                {{-- COLONNA SINISTRA: Modulo di Ricerca --}}
                <aside class="w-full lg:w-1/3 xl:w-1/4">

                    {{-- Form di ricerca aggiornato --}}
                    <form action="{{ route('search') ?? '#' }}" method="POST" class="bg-[#F8EFE8] rounded-md shadow-lg overflow-hidden">
                        @csrf
                        {{-- Intestazione Date --}}
                        <div class="grid grid-cols-3 gap-2 text-center p-4 bg-[#F8EFE8] border-b border-gray-300">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-gray-500 text-xs flex items-center gap-1"><i class="fa-regular fa-calendar text-blue-600"></i> Check-in</span>
                                <span id="display-checkin" class="font-medium text-gray-800 text-sm mt-1">Seleziona</span>
                            </div>
                            <div class="flex flex-col items-center justify-center border-l border-gray-300">
                                <span class="text-gray-500 text-xs flex items-center gap-1"><i class="fa-regular fa-calendar text-blue-600"></i> Check-out</span>
                                <span id="display-checkout" class="font-medium text-gray-800 text-sm mt-1">Seleziona</span>
                            </div>
                            <div class="flex flex-col items-center justify-center border-l border-gray-300">
                                <span class="text-gray-500 text-xs">Notti</span>
                                <span id="display-nights" class="font-medium text-gray-800 text-sm mt-1">0</span>
                            </div>
                        </div>

                        {{-- Calendario Inline --}}
                        <div class="bg-white p-2">
                            {{-- INVIA IL CAMPO ESATTO RICHIESTO DAL CONTROLLER: date_range --}}
                            <input type="hidden" name="date_range" id="date-range-input">
                            <div id="inline-calendar-container" class="w-full flex justify-center"></div>
                        </div>

                        {{-- Sezione Opzioni (Inizializzo lo stato Alpine per calcolare i letti) --}}
                        <div class="p-4 bg-[#F8EFE8]" x-data="{ rooms: 1, adults: 2, children: 0 }">

                            {{-- INVIA IL CAMPO ESATTO RICHIESTO DAL CONTROLLER: beds_required (Adulti + Bambini) --}}
                            <input type="hidden" name="beds_required" :value="Number(adults) + Number(children)">

                            <div class="flex justify-between items-center mb-4">
                                <span class="font-medium text-sm text-gray-800">Camere: <span x-text="rooms"></span></span>
                                <div class="flex items-center gap-4 text-gray-600">
                                    <button type="button" @click="if(rooms > 1) rooms--" class="hover:text-blue-600 transition"><i class="fa-solid fa-minus"></i></button>
                                    <button type="button" @click="rooms++" class="hover:text-blue-600 transition"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>

                            {{-- Select Adulti e Bambini (legati alle variabili Alpine x-model) --}}
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div>
                                    <label class="text-[10px] text-gray-500 block mb-1 uppercase tracking-wider">Adulti</label>
                                    <div class="relative">
                                        <select x-model="adults" class="w-full border-0 rounded text-sm p-2.5 bg-white shadow-sm appearance-none focus:ring-2 focus:ring-blue-600">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-xs text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] text-gray-500 block mb-1 uppercase tracking-wider">Bambini</label>
                                    <div class="relative">
                                        <select x-model="children" class="w-full border-0 rounded text-sm p-2.5 bg-white shadow-sm appearance-none focus:ring-2 focus:ring-blue-600">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-xs text-gray-400 pointer-events-none"></i>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-[#006BB3] text-white font-medium text-sm py-3 px-4 rounded shadow hover:bg-blue-800 transition flex items-center justify-center gap-2 mt-4">
                                VERIFICA DISPONIBILITÀ <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </aside>


                {{-- COLONNA DESTRA: Lista Camere (Invariata rispetto a prima, la accorcio per comodità visiva) --}}
                <div class="w-full lg:w-2/3 xl:w-3/4 space-y-6">
                    @if(isset($rooms))
                    @forelse($rooms as $room)
                    {{-- x-data="roomCard" inizializza lo stato per la tendina di questa specifica card --}}
                    <div x-data="{ openRates: false }" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

                        {{-- Parte Superiore della Card (Info Camera) --}}
                        <div class="flex flex-col md:flex-row">

                            {{-- Galleria Immagini (Alpine.js) --}}
                            {{-- Galleria Immagini Dinamica (Alpine.js + Blade) --}}
                            <div class="w-full md:w-1/3 relative bg-gray-200 h-64 md:h-auto"
                                x-data="{ 
                                        activeSlide: 0, 
                                        slides: [
                                            {{-- Cicliamo le vere immagini caricate dal database --}}
                                            @forelse($room->images as $image)
                                                '{{ asset('storage/' . $image->pathImage) }}', {{-- ATTENZIONE: cambia 'path' con il vero nome della tua colonna nel db delle immagini --}}
                                            @empty
                                                {{-- Se la camera non ha immagini, mostriamo un segnaposto grigio --}}
                                                'https://via.placeholder.com/600x400/eeeeee/999999?text=Nessuna+Foto'
                                            @endforelse
                                        ] 
                                    }">

                                {{-- Immagine attiva --}}
                                <img :src="slides[activeSlide]" alt="{{ $room->name }}" class="absolute inset-0 w-full h-full object-cover" />

                                {{-- Mostriamo le frecce SOLO se ci sono più di 1 immagine --}}
                                <template x-if="slides.length > 1">
                                    <div>
                                        <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black/70 transition">
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </button>
                                        <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black/70 transition">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </template>

                                {{-- Badge Dimensione --}}
                                <div class="absolute top-2 left-2 bg-white/90 px-2 py-1 text-xs font-medium text-gray-700 rounded shadow-sm flex items-center gap-1">
                                    <i class="fa-solid fa-maximize text-yellow-500"></i> Circa {{ $room->size ?? '25' }} m²
                                </div>
                            </div>

                            {{-- Dettagli Camera --}}
                            <div class="w-full md:w-2/3 flex flex-col">
                                <div class="p-5 flex-grow">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $room->name }}</h3>
                                        <span class="text-sm font-bold text-gray-800">Servizi</span>
                                    </div>

                                    <div class="flex flex-col md:flex-row gap-6">
                                        {{-- Descrizione --}}
                                        <div class="w-full md:w-1/2">
                                            <p class="text-sm text-gray-600 line-clamp-3">
                                                {{ $room->description }}
                                            </p>
                                            <a href="#" class="text-yellow-600 text-sm font-medium hover:underline mt-1 inline-block">continua</a>
                                        </div>

                                        {{-- Griglia Servizi --}}
                                        <div class="w-full md:w-1/2 grid grid-cols-2 gap-y-2 text-sm text-gray-600">
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Wi-Fi gratis</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Aria cond.</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Bagno privato</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> TV Piatta</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Barra inferiore prezzo e bottone --}}
                                <div class="bg-gray-50 border-t border-gray-100 p-4 flex items-center justify-end gap-4">
                                    <div class="text-right">
                                        <span class="text-xs text-gray-500 block">prezzo di partenza</span>
                                        <span class="text-2xl font-bold text-gray-800">da <span class="text-yellow-600">€{{ number_format($room->price, 0, ',', '.') }}</span></span>
                                    </div>
                                    {{-- Bottone che attiva la tendina --}}
                                    <button @click="openRates = !openRates" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded transition flex items-center gap-2">
                                        INFO E PRENOTA
                                        <i class="fa-solid" :class="openRates ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Parte Inferiore Espandibile (Tendina Tariffe) --}}
                        <div x-show="openRates" x-collapse class="bg-white border-t-2 border-gray-200">

                            {{-- Intestazione Tabella Tariffe (nascosta su mobile) --}}
                            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-100 p-3 text-xs font-bold text-gray-600 uppercase">
                                <div class="col-span-4">Tariffa</div>
                                <div class="col-span-5">Trattamento</div>
                                <div class="col-span-3">Prezzo</div>
                            </div>

                            {{-- Lista Tariffe (Ciclo) --}}
                            {{-- Qui dovresti avere un array di tariffe collegate alla camera: $room->rates --}}
                            @foreach($room->rates ?? [
                            (object)['id' => 1, 'name' => 'Camera e colazione', 'desc' => 'La scelta semplice e flessibile', 'price' => $room->base_price, 'is_best' => true],
                            (object)['id' => 2, 'name' => 'Mezza pensione', 'desc' => 'Cena inclusa nel nostro ristorante', 'price' => $room->base_price + 120, 'is_best' => false]
                            ] as $rate)

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 border-b border-gray-100 items-center {{ $rate->is_best ? 'bg-green-50/50' : 'hover:bg-gray-50' }}">

                                <div class="md:col-span-4">
                                    <p class="font-medium text-gray-800">{{ $rate->desc }}</p>
                                </div>

                                <div class="md:col-span-5">
                                    <p class="font-bold text-gray-800">{{ $rate->name }}</p>
                                    <p class="text-xs text-gray-500 mb-1">Prezzo per le date selezionate - {{ request('ospiti', 2) }} adulti</p>
                                    <a href="#" class="text-xs text-blue-600 hover:underline"><i class="fa-solid fa-circle-info"></i> Condizioni tariffarie</a>
                                </div>

                                <div class="md:col-span-3 flex justify-between items-center md:flex-col md:items-end gap-2 border-t md:border-t-0 pt-3 md:pt-0 mt-3 md:mt-0">
                                    <div class="text-left md:text-right">
                                        <span class="text-xl font-bold text-gray-800 block">€{{ number_format($rate->price, 0, ',', '.') }}</span>
                                        @if($rate->is_best)
                                        <span class="text-xs text-green-600 font-bold flex items-center gap-1 justify-end"><i class="fa-regular fa-thumbs-up"></i> Miglior prezzo</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('detailRoom', $room->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded shadow-sm transition">
                                        CONTINUA
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div> {{-- Fine Tendina Espandibile --}}
                    </div> {{-- Fine Card Camera --}}
                    @empty
                    <div class="bg-white p-8 rounded shadow text-center text-gray-500">
                        Nessuna camera disponibile.
                    </div>
                    @endforelse
                    @else
                    <div class="bg-white p-8 rounded shadow text-center text-gray-500">
                        Cerca una camera.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT PER IL CALENDARIO INLINE --}}
    {{-- SCRIPT PER IL CALENDARIO INLINE --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#inline-calendar-container", {
                inline: true,
                mode: "range",
                minDate: "today",
                showMonths: 1,
                locale: "it",
                dateFormat: "d-m-Y", // FORMATO ESATTO PER CARBON (dd-mm-yyyy)
                onChange: function(selectedDates, dateStr, instance) {

                    // Salviamo la stringa generata (es. "20-06-2026 to 23-06-2026")
                    document.getElementById('date-range-input').value = dateStr;

                    const options = {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    };

                    if (selectedDates.length > 0) {
                        document.getElementById('display-checkin').innerText = selectedDates[0].toLocaleDateString('it-IT', options);
                    } else {
                        document.getElementById('display-checkin').innerText = "Seleziona";
                    }

                    if (selectedDates.length > 1) {
                        document.getElementById('display-checkout').innerText = selectedDates[1].toLocaleDateString('it-IT', options);

                        const diffTime = Math.abs(selectedDates[1] - selectedDates[0]);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        document.getElementById('display-nights').innerText = diffDays;
                    } else {
                        document.getElementById('display-checkout').innerText = "Seleziona";
                        document.getElementById('display-nights').innerText = "0";
                    }
                }
            });
        });
    </script>

    {{-- Custom CSS per sovrascrivere i colori base di Flatpickr e renderlo simile alla foto --}}
    {{-- Custom CSS per sovrascrivere i colori base di Flatpickr e renderlo simile alla foto --}}
    <style>
        .flatpickr-calendar.inline {
            box-shadow: none !important;
            border: none !important;
            width: 100% !important;
            padding: 10px;
            /* Aggiunto per evitare che il padding allarghi il contenitore oltre il 100% */
            box-sizing: border-box !important;
        }

        /* RIPOSIZIONAMENTO FRECCE MESE */
        .flatpickr-months .flatpickr-prev-month,
        .flatpickr-months .flatpickr-next-month {
            /* Allontana le frecce dai bordi estremi */
            margin-right: 10px !important;
            margin-left: 10px !important;
            /* Aggiusta l'allineamento verticale se necessario */
            top: 5px !important;
        }

        /* COLORI DEI GIORNI SELEZIONATI */
        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected.inRange,
        .flatpickr-day.startRange.inRange,
        .flatpickr-day.endRange.inRange,
        .flatpickr-day.selected:focus,
        .flatpickr-day.startRange:focus,
        .flatpickr-day.endRange:focus,
        .flatpickr-day.selected:hover,
        .flatpickr-day.startRange:hover,
        .flatpickr-day.endRange:hover,
        .flatpickr-day.selected.prevMonthDay,
        .flatpickr-day.startRange.prevMonthDay,
        .flatpickr-day.endRange.prevMonthDay,
        .flatpickr-day.selected.nextMonthDay,
        .flatpickr-day.startRange.nextMonthDay,
        .flatpickr-day.endRange.nextMonthDay {
            background: #006BB3 !important;
            border-color: #006BB3 !important;
        }
    </style>
</x-layoutBooking>
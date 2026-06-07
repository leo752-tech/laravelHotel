<x-layoutBooking title="Verifica Disponibilità - SuiteDirect">
    <style>
        /* 1. RESET PRINCIPALE DEL CALENDARIO */
        .flatpickr-calendar.inline {
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            /* Rimuove il padding che causava il restringimento */
            margin: 0 !important;
            background: transparent !important;
        }

        /* 2. FORZA LA LARGHEZZA FLUIDA E RIMUOVE I BORDINI DEL TEMA MATERIAL */
        .flatpickr-innerContainer,
        .flatpickr-rContainer,
        .flatpickr-days,
        .dayContainer {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
            border: none !important;
            /* Fondamentale: rimuove i bordi laterali disallineati */
            box-sizing: border-box !important;
        }

        /* 3. SETTIMANE E GIORNI ALLINEATI PERFETTAMENTE ALLA GRIGLIA */
        .flatpickr-weekdays,
        .flatpickr-weekdaycontainer {
            width: 100% !important;
            max-width: 100% !important;
            display: flex !important;
        }

        span.flatpickr-weekday {
            flex: 1 1 14.2857% !important;
            max-width: 14.2857% !important;
        }

        .flatpickr-day {
            max-width: 14.2857% !important;
            flex-basis: 14.2857% !important;
            height: 38px !important;
            line-height: 38px !important;
            margin: 2px 0 !important;
            box-sizing: border-box !important;
            border-radius: 8px !important;
            /* Arrotondamento più elegante per i giorni */
        }

        /* 4. INTESTAZIONE MESE E FRECCE (Header Blu) */
        .flatpickr-months {
            padding: 0 !important;
            width: 100% !important;
            position: relative !important;
            background: #a88a64;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            appearance: menulist;
            background: #a88a64 !important;
            border: none;
            border-radius: 0;
            box-sizing: border-box;
            color: #ffffff !important;
            cursor: pointer;
            font-size: inherit;
            font-family: inherit;
            font-weight: 300;
            height: auto;
            line-height: inherit;
            margin: -1px 0 0 0;
            outline: none;
            padding: 0 0 0 0.5ch;
            position: relative;
            vertical-align: initial;
            -webkit-box-sizing: border-box;
            -webkit-appearance: menulist;
            -moz-appearance: menulist;
            width: auto;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month:hover,
        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month:focus,
        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month:checked,
        .flatpickr-current-month .flatpickr-monthDropdown-months:focus {
            background-color: #8c7251 !important;
            /* Un marrone leggermente più scuro per far capire dove ci si trova */
            color: #ffffff !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month {
            background-color: #a88a64;
            outline: none;
            padding: 0;
        }

        .flatpickr-months .flatpickr-prev-month,
        .flatpickr-months .flatpickr-next-month {
            top: 0px !important;
            height: 50px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            /* Centra le frecce verticalmente nell'header blu */
            padding: 0 15px !important;
            z-index: 10 !important;
        }

        /* 5. COLORI PERSONALIZZATI (Check-in, Check-out e range) */
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
            background: #354F42 !important;
            /* Cerchio verde sui giorni */
            border-color: #354F42 !important;
            color: #fff !important;
        }

        .flatpickr-day.inRange {
            background: #E8ECEA !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        /* 6. RENDE L'ANNO COMPLETAMENTE STATICO */

        /* Nasconde le freccette su/giù vicino all'anno */
        .flatpickr-current-month .numInputWrapper span.arrowUp,
        .flatpickr-current-month .numInputWrapper span.arrowDown {
            display: none !important;
        }

        /* Rimuove lo stile da "campo di testo" e disabilita il click/scrittura */
        .flatpickr-current-month input.cur-year {
            pointer-events: none !important;
            /* Disabilita qualsiasi interazione */
            background: transparent !important;
            /* Toglie sfondi o hover del browser */
            -webkit-appearance: none !important;
            -moz-appearance: textfield !important;
            border: none !important;
            box-shadow: none !important;
            font-weight: bold !important;
            /* Opzionale: lo rende spesso come il mese */
        }

        /* Disabilita il contenitore dell'anno per sicurezza */
        .flatpickr-current-month .numInputWrapper {
            pointer-events: none !important;
        }
    </style>
    {{-- Sfondo che richiama il colore caldo/sabbia dell'immagine --}}
    <div class="bg-[#D3C1B3] min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row gap-6">

                {{-- COLONNA SINISTRA: Modulo di Ricerca (Stile Immagine) --}}
                {{-- COLONNA SINISTRA: Modulo di Ricerca --}}
                <aside class="w-full lg:w-1/3 xl:w-1/4 sticky top-6 h-fit z-10">

                    <form action="{{ route('search') ?? '#' }}" method="POST" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        @csrf

                        {{-- Intestazione Form --}}
                        <div class="bg-[#f8f9fa] p-5 border-b border-gray-100 text-center">
                            <h2 class="text-lg font-semibold text-gray-800">Cerca disponibilità</h2>
                        </div>

                        {{-- Riepilogo Date e Notti (Design pulito e arioso) --}}
                        <div class="grid grid-cols-3 gap-0 text-center px-4 py-6">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-1">Check-in</span>
                                <span id="display-checkin" class="font-medium text-[#2c3e50] text-sm bg-gray-50 px-2 py-1 rounded w-full border border-transparent">Seleziona</span>
                            </div>

                            <div class="flex flex-col items-center justify-center px-2">
                                <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-1">Notti</span>
                                <span class="bg-[#e9ecef] text-[#495057] text-xs font-bold px-3 py-1 rounded-full">
                                    <span id="display-nights">0</span>
                                </span>
                            </div>

                            <div class="flex flex-col items-center justify-center">
                                <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-1">Check-out</span>
                                <span id="display-checkout" class="font-medium text-[#2c3e50] text-sm bg-gray-50 px-2 py-1 rounded w-full border border-transparent">Seleziona</span>
                            </div>
                        </div>

                        {{-- Calendario Inline --}}
                        <div class="px-2 pb-4 border-b border-gray-100">
                            <input type="hidden" name="date_range" id="date-range-input">
                            {{-- Rimosso flex e justify-center perché ora il calendario è forzato al 100% del suo elemento padre --}}
                            <div id="inline-calendar-container" class="w-full"></div>
                        </div>

                        {{-- Sezione Opzioni Ospiti (Utilizzo di Alpine.js) --}}
                        <div class="p-6 bg-white" x-data="{ rooms: 1, adults: 2, children: 0 }">

                            <input type="hidden" name="beds_required" :value="Number(adults) + Number(children)">

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dettagli Camera <span x-text="rooms" class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full ml-1"></span>
                                </h3>
                            </div>

                            {{-- Select Adulti e Bambini (Stile minimal) --}}
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="relative">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Adulti</label>
                                    <div class="relative">
                                        <select x-model="adults" class="block w-full pl-3 pr-10 py-2.5 text-sm border-gray-200 focus:outline-none focus:ring-0 focus:border-[#3b82f6] sm:text-sm rounded-lg bg-gray-50 text-gray-700 appearance-none">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Bambini</label>
                                    <div class="relative">
                                        <select x-model="children" class="block w-full pl-3 pr-10 py-2.5 text-sm border-gray-200 focus:outline-none focus:ring-0 focus:border-[#3b82f6] sm:text-sm rounded-lg bg-gray-50 text-gray-700 appearance-none">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pulsante Submit --}}
                            <button type="submit" class="w-full bg-[#354F42] text-white font-medium text-sm py-3.5 px-4 rounded-lg shadow-sm hover:bg-[#263C32] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#354F42]"> CERCA DISPONIBILITÀ
                            </button>

                            <p class="text-center text-xs text-gray-400 mt-3">
                                <i class="fa-solid fa-lock mr-1"></i> Prenotazione sicura
                            </p>
                        </div>
                    </form>
                </aside>


                {{-- COLONNA DESTRA: Lista Camere (Invariata rispetto a prima, la accorcio per comodità visiva) --}}

                <div class="w-full lg:w-2/3 xl:w-3/4 space-y-6">

                    {{-- 1. HEADER DINAMICO: Vetrina Iniziale VS Risultati di Ricerca --}}
                    @if(isset($checkIn) && isset($checkOut))
                    {{-- L'utente HA cercato delle date --}}
                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center bg-white p-4 rounded shadow-sm border-l-4 border-[#354F42]">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                Risultati per il tuo soggiorno
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-medium text-gray-700">{{ $checkIn }}</span> - <span class="font-medium text-gray-700">{{ $checkOut }}</span>
                                &bull; Notti {{$nights ?? 0}} &bull; Ospiti {{$guests ?? 2}}
                            </p>
                        </div>
                        <div class="mt-3 sm:mt-0">
                            <span class="text-xs bg-[#E8ECEA] text-[#354F42] px-3 py-1 rounded-full font-medium">
                                {{$rooms->count()}} camere disponibili
                            </span>
                        </div>
                    </div>
                    @else
                    {{-- L'utente NON HA cercato (Vetrina Iniziale) --}}
                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center bg-white p-5 rounded shadow-sm border-l-4 border-[#D3C1B3]">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                Esplora le nostre sistemazioni
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Seleziona le date nel calendario a sinistra per visualizzare disponibilità e tariffe esatte.
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- 2. LISTA CAMERE (Gira sempre, sia come vetrina che come risultati) --}}
                    @forelse($rooms as $room)
                    <div x-data="{ 
                                openRates: false,
                                isModalOpen: false,
                                activeSlide: 0,
                                slides: [
                                    @forelse($room->images ?? [] as $image)
                                        '{{ asset('storage/' . $image->pathImage) }}', 
                                    @empty
                                        'https://via.placeholder.com/600x400/eeeeee/999999?text=Nessuna+Foto'
                                    @endforelse
                                ] 
                            }" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        {{-- Parte Superiore della Card --}}
                        <div class="flex flex-col md:flex-row">

                            {{-- Galleria Immagini (Invariata) --}}
                            <div class="w-full md:w-1/3 relative bg-gray-200 h-64 md:h-auto">

                                <img :src="slides[activeSlide]" alt="{{ $room->name }}" @click="isModalOpen = true" class="absolute inset-0 w-full h-full object-cover cursor-pointer hover:opacity-95 transition-opacity" />

                                <template x-if="slides.length > 1">
                                    <div>
                                        <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black/70 transition">
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </button>
                                        <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black/70 transition">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </template>

                                

                                {{-- Modale Pop-up (Invariata) --}}
                                <template x-teleport="body">
                                    <div x-show="isModalOpen" style="display: none;" @keydown.escape.window="isModalOpen = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                        <div @click.away="isModalOpen = false" class="bg-white rounded-xl shadow-2xl w-full max-w-6xl h-auto max-h-[90vh] flex flex-col md:flex-row overflow-hidden relative" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
                                            <button @click="isModalOpen = false" class="absolute top-4 right-4 z-20 bg-white/80 hover:bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center transition shadow-md">
                                                <i class="fa-solid fa-xmark text-lg"></i>
                                            </button>
                                            <div class="w-full md:w-7/12 relative min-h-[40vh] md:min-h-[600px] bg-gray-100">
                                                <img :src="slides[activeSlide]" alt="{{ $room->name }}" class="absolute inset-0 w-full h-full object-cover" />
                                                <template x-if="slides.length > 1">
                                                    <div>
                                                        <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 w-12 h-12 rounded-full flex items-center justify-center hover:bg-white transition shadow-lg"><i class="fa-solid fa-chevron-left"></i></button>
                                                        <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 w-12 h-12 rounded-full flex items-center justify-center hover:bg-white transition shadow-lg"><i class="fa-solid fa-chevron-right"></i></button>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="w-full md:w-5/12 p-8 overflow-y-auto bg-white flex flex-col">
                                                <h3 class="text-2xl font-bold text-slate-800 mb-4">{{ $room->name ?? 'Matrimoniale con balcone' }}</h3>
                                                <p class="text-gray-500 text-sm leading-relaxed mb-8 font-light">{{ $room->description ?? '...' }}</p>
                                                <h4 class="text-sm font-semibold text-slate-800 mb-4">Servizi inclusi</h4>
                                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-4 text-sm text-slate-600">
                                                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Wi-Fi gratis</li>
                                                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Aria condizionata</li>
                                                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Bagno privato</li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Dettagli Camera --}}
                            <div class="w-full md:w-2/3 flex flex-col">
                                <div class="p-5 flex-grow">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $room->name }}</h3>
                                        <span class="text-sm font-bold text-gray-800">Servizi</span>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-6">
                                        <div class="w-full md:w-1/2">
                                            <p class="text-sm text-gray-600 line-clamp-3">{{ $room->description }}</p>
                                            <a href="#" @click.prevent="isModalOpen = true" class="text-yellow-600 text-sm font-medium hover:underline mt-1 inline-block">
                                                continua
                                            </a>
                                        </div>
                                        <div class="w-full md:w-1/2 grid grid-cols-2 gap-y-2 text-sm text-gray-600">
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Wi-Fi gratis</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Aria cond.</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Bagno privato</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> TV Piatta</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Barra inferiore prezzo e bottone (DINAMICA) --}}
                                <div class="bg-gray-50 border-t border-gray-100 p-4 flex items-center justify-end gap-4">
                                    <div class="text-right">
                                        <span class="text-xs text-gray-500 block">prezzo di partenza</span>
                                        <span class="text-2xl font-bold text-gray-800">
                                            da <span class="text-yellow-600">€{{ number_format($room->price * 100 ?? 0, 0, ',', '.') }}</span>
                                            @if(!isset($checkIn)) <span class="text-sm text-gray-500 font-normal">/notte</span> @endif
                                        </span>
                                    </div>

                                    @if(isset($checkIn) && isset($checkOut))
                                    {{-- Bottone Info e Prenota (Solo se ci sono le date) --}}
                                    <button @click="openRates = !openRates" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded transition flex items-center gap-2">
                                        INFO E PRENOTA
                                        <i class="fa-solid" :class="openRates ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                    </button>
                                    @else
                                    {{-- Bottone Inserisci Date (Vetrina iniziale, scrolla al calendario) --}}
                                    <button type="button" onclick="..." class="bg-[#354F42] hover:bg-[#263C32] text-white font-bold py-3 px-6 rounded shadow-sm transition flex items-center gap-2">
                                        INSERISCI DATE
                                        <i class="fa-regular fa-calendar-days"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Tendina Tariffe: Visibile SOLO se l'utente ha inserito le date --}}
                        @if(isset($checkIn) && isset($checkOut))
                        <div x-show="openRates" x-collapse class="bg-white border-t-2 border-gray-200">
                            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-100 p-3 text-xs font-bold text-gray-600 uppercase">
                                <div class="col-span-4">Tariffa</div>
                                <div class="col-span-5">Trattamento</div>
                                <div class="col-span-3">Prezzo</div>
                            </div>

                            @foreach($room->rates ?? [
                            (object)['id' => 1, 'name' => 'Camera e colazione', 'desc' => 'La scelta semplice e flessibile', 'price' => $room->price, 'is_best' => true],
                            (object)['id' => 2, 'name' => 'Mezza pensione', 'desc' => 'Cena inclusa nel ristorante', 'price' => $room->price + 120, 'is_best' => false]
                            ] as $rate)
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 border-b border-gray-100 items-center {{ $rate->is_best ? 'bg-green-50/50' : 'hover:bg-gray-50' }}">
                                <div class="md:col-span-4">
                                    <p class="font-medium text-gray-800">{{ $rate->desc }}</p>
                                </div>
                                <div class="md:col-span-5">
                                    <p class="font-bold text-gray-800">{{ $rate->name }}</p>
                                    <p class="text-xs text-gray-500 mb-1">Prezzo per le date selezionate - {{ request('adults', 2) }} adulti</p>
                                    <a href="#" class="text-xs text-blue-600 hover:underline"><i class="fa-solid fa-circle-info"></i> Condizioni</a>
                                </div>
                                <div class="md:col-span-3 flex justify-between items-center md:flex-col md:items-end gap-2 border-t md:border-t-0 pt-3 md:pt-0 mt-3 md:mt-0">
                                    <div class="text-left md:text-right">
                                        <span class="text-xl font-bold text-gray-800 block">€{{ number_format($rate->price * 100, 0, ',', '.') }}</span>
                                        @if($rate->is_best)
                                        <span class="text-xs text-green-600 font-bold flex items-center gap-1 justify-end"><i class="fa-regular fa-thumbs-up"></i> Miglior prezzo</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('summary', $room->id ?? 1) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded shadow-sm transition">
                                        CONTINUA
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                    </div>
                    @empty
                    <div class="bg-white p-12 rounded shadow flex flex-col items-center justify-center text-center">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Nessuna camera trovata</h3>
                        <p class="text-gray-500 mb-8 max-w-md">Prova a modificare le date o il numero di ospiti per trovare altre soluzioni.</p>
                    </div>
                    @endforelse
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
                            dateFormat: "d-m-Y",
                            monthSelectorType: "static", // FORMATO ESATTO PER CARBON (dd-mm-yyyy)
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
</x-layoutBooking>
<x-layoutBooking title="Verifica Disponibilità - SuiteDirect">
    <style>
        /* 1. RESET PRINCIPALE DEL CALENDARIO */
        .flatpickr-calendar.inline {
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
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
            padding: 0 15px !important;
            z-index: 10 !important;
        }

        /* 5. COLORI PERSONALIZZATI */
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
            border-color: #354F42 !important;
            color: #fff !important;
        }

        .flatpickr-day.inRange {
            background: #E8ECEA !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        /* 6. RENDE L'ANNO COMPLETAMENTE STATICO */
        .flatpickr-current-month .numInputWrapper span.arrowUp,
        .flatpickr-current-month .numInputWrapper span.arrowDown {
            display: none !important;
        }

        .flatpickr-current-month input.cur-year {
            pointer-events: none !important;
            background: transparent !important;
            -webkit-appearance: none !important;
            -moz-appearance: textfield !important;
            border: none !important;
            box-shadow: none !important;
            font-weight: bold !important;
        }

        .flatpickr-current-month .numInputWrapper {
            pointer-events: none !important;
        }
    </style>

    <div class="bg-[#D3C1B3] min-h-screen py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">

                {{-- COLONNA SINISTRA: Modulo di Ricerca --}}
                {{-- FIX MOBILE: Rimosso 'sticky top-6' generico, aggiunto 'static lg:sticky lg:top-6' --}}
                <aside class="w-full lg:w-1/3 xl:w-1/4 static lg:sticky lg:top-6 h-fit z-10 mb-4 lg:mb-0">
                    <form action="{{ route('search') ?? '#' }}" method="POST" onsubmit="if(!document.getElementById('date-range-input').value) { event.preventDefault(); alert('Per favore, seleziona le date del soggiorno prima di cercare.'); return false; }"
                        class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        @csrf

                        <div class="bg-[#f8f9fa] p-4 sm:p-5 border-b border-gray-100 text-center">
                            <h2 class="text-lg font-semibold text-gray-800">Cerca disponibilità</h2>
                        </div>

                        <div class="grid grid-cols-3 gap-0 text-center px-2 sm:px-4 py-4 sm:py-6">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-1">Check-in</span>
                                <span id="display-checkin" class="font-medium text-[#2c3e50] text-xs sm:text-sm bg-gray-50 px-1 sm:px-2 py-1 rounded w-full border border-transparent truncate">Seleziona</span>
                            </div>

                            <div class="flex flex-col items-center justify-center px-1 sm:px-2">
                                <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-1">Notti</span>
                                <span class="bg-[#e9ecef] text-[#495057] text-xs font-bold px-2 sm:px-3 py-1 rounded-full">
                                    <span id="display-nights">0</span>
                                </span>
                            </div>

                            <div class="flex flex-col items-center justify-center">
                                <span class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-1">Check-out</span>
                                <span id="display-checkout" class="font-medium text-[#2c3e50] text-xs sm:text-sm bg-gray-50 px-1 sm:px-2 py-1 rounded w-full border border-transparent truncate">Seleziona</span>
                            </div>
                        </div>

                        <div class="px-2 pb-4 border-b border-gray-100">
                            <input type="hidden" name="date_range" id="date-range-input" required>
                            <div id="inline-calendar-container" class="w-full"></div>
                        </div>

                        <div class="p-4 sm:p-6 bg-white" x-data="{ rooms: 1, adults: 2, children: 0 }">
                            <input type="hidden" name="beds_required" :value="Number(adults) + Number(children)">

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dettagli Camera <span x-text="rooms" class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full ml-1"></span>
                                </h3>
                            </div>

                            <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-6">
                                <div class="relative">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Adulti</label>
                                    <div class="relative">
                                        <select x-model="adults" class="block w-full pl-3 pr-8 py-2.5 text-sm border-gray-200 focus:outline-none focus:ring-0 focus:border-[#3b82f6] rounded-lg bg-gray-50 text-gray-700 appearance-none">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Bambini</label>
                                    <div class="relative">
                                        <select x-model="children" class="block w-full pl-3 pr-8 py-2.5 text-sm border-gray-200 focus:outline-none focus:ring-0 focus:border-[#3b82f6] rounded-lg bg-gray-50 text-gray-700 appearance-none">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-[#354F42] text-white font-medium text-sm py-3.5 px-4 rounded-lg shadow-sm hover:bg-[#263C32] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#354F42]">
                                CERCA DISPONIBILITÀ
                            </button>

                            <p class="text-center text-xs text-gray-400 mt-3">
                                <i class="fa-solid fa-lock mr-1"></i> Prenotazione sicura
                            </p>
                        </div>
                    </form>
                </aside>

                {{-- COLONNA DESTRA: Lista Camere --}}
                <div class="w-full lg:w-2/3 xl:w-3/4 space-y-6">

                    @if(isset($checkIn) && isset($checkOut))
                    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white p-4 rounded shadow-sm border-l-4 border-[#354F42] gap-3 sm:gap-0">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Risultati per il tuo soggiorno</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="font-medium text-gray-700">{{ $checkIn }}</span> - <span class="font-medium text-gray-700">{{ $checkOut }}</span>
                                <span class="block sm:inline sm:ml-1">&bull; Notti {{$nights ?? 0}} &bull; Ospiti {{$guests ?? 2}}</span>
                            </p>
                        </div>
                        <div>
                            <span class="text-xs bg-[#E8ECEA] text-[#354F42] px-3 py-1.5 rounded-full font-medium inline-block">
                                {{$rooms->count()}} camere disponibili
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row justify-between items-center bg-white p-4 sm:p-5 rounded shadow-sm border-l-4 border-[#D3C1B3]">
                        <div>
                            <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Esplora le nostre sistemazioni</h2>
                            <p class="text-sm text-gray-500 mt-1">Seleziona le date nel calendario per visualizzare disponibilità e tariffe esatte.</p>
                        </div>
                    </div>
                    @endif

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

                        <div class="flex flex-col md:flex-row">
                            {{-- Galleria Immagini --}}
                            <div class="w-full md:w-1/3 relative bg-gray-200 h-56 sm:h-64 md:h-auto">
                                <img :src="slides[activeSlide]" alt="{{ $room->name }}" @click="isModalOpen = true" class="absolute inset-0 w-full h-full object-cover cursor-pointer hover:opacity-95 transition-opacity" />

                                <template x-if="slides.length > 1">
                                    <div>
                                        <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black/70 transition"><i class="fa-solid fa-chevron-left"></i></button>
                                        <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-black/70 transition"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                </template>

                                {{-- FIX MOBILE: Altezza ridotta su mobile (min-h-[30vh]) per mostrare il contenuto testuale sottostante senza sforzo --}}
                                {{-- Modale Pop-up --}}
                                <template x-teleport="body">
                                    <div x-show="isModalOpen" style="display: none;" @keydown.escape.window="isModalOpen = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-0 sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                                        {{-- FIX MOBILE: Altezza fissa al 95% dello schermo (h-[95vh]), così l'immagine e il testo si spartiscono lo spazio in modo esatto --}}
                                        <div @click.away="isModalOpen = false" class="bg-white rounded-none sm:rounded-xl shadow-2xl w-full max-w-6xl h-[100vh] sm:h-auto sm:max-h-[90vh] flex flex-col md:flex-row overflow-hidden relative" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">

                                            {{-- Pulsante Chiudi --}}
                                            <button @click="isModalOpen = false" class="absolute top-3 right-3 sm:top-4 sm:right-4 z-20 bg-white/90 hover:bg-white text-gray-800 rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center transition shadow-lg">
                                                <i class="fa-solid fa-xmark text-lg"></i>
                                            </button>

                                            {{-- 1. CONTENITORE IMMAGINE: Ora occupa molta più altezza (55vh) su mobile --}}
                                            <div class="w-full md:w-7/12 relative h-[55vh] md:h-auto md:min-h-[600px] bg-gray-200 shrink-0">
                                                {{-- FIX: object-cover per far riempire tutto lo spazio alla foto senza schiacciarla --}}
                                                <img :src="slides[activeSlide]" alt="{{ $room->name }}" class="absolute inset-0 w-full h-full object-cover" />

                                                <template x-if="slides.length > 1">
                                                    <div>
                                                        <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center hover:bg-white transition shadow-lg"><i class="fa-solid fa-chevron-left"></i></button>
                                                        <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center hover:bg-white transition shadow-lg"><i class="fa-solid fa-chevron-right"></i></button>
                                                    </div>
                                                </template>
                                            </div>

                                            {{-- 2. CONTENITORE TESTO: flex-1 per occupare il resto, e overflow-y-auto per renderlo scorrevole --}}
                                            <div class="w-full md:w-5/12 flex-1 p-6 sm:p-8 overflow-y-auto bg-white flex flex-col min-h-0">

                                                {{-- Contenuto Superiore --}}
                                                <div class="flex-grow">
                                                    <h3 class="text-2xl font-bold text-slate-800 mb-3 sm:mb-4">{{ $room->name ?? 'Matrimoniale con balcone' }}</h3>
                                                    <p class="text-gray-500 text-sm leading-relaxed mb-6 sm:mb-8 font-light">{{ $room->description ?? '...' }}</p>

                                                    <h4 class="text-sm font-semibold text-slate-800 mb-3 sm:mb-4">Servizi inclusi</h4>
                                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-4 text-sm text-slate-600 mb-6">
                                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Wi-Fi gratis</li>
                                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Aria condizionata</li>
                                                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Bagno privato</li>
                                                    </ul>
                                                </div>

                                                {{-- Elemento Ancorato in Basso --}}
                                                {{-- mt-auto spinge la sezione sul fondo, pt-4 mette sicurezza dal testo sopra, border-t dà un tocco pulito da hotel --}}
                                                <div class="mt-auto pt-4 border-t border-gray-100 flex items-center gap-2 text-slate-700 font-medium text-sm">
                                                    <i class="fa-solid fa-user-group text-slate-400 text-base"></i>
                                                    <span>Capacità: <strong class="text-slate-900">{{ $room->beds ?? '2' }} ospiti</strong></span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Dettagli Camera --}}
                            <div class="w-full md:w-2/3 flex flex-col">
                                <div class="p-4 sm:p-5 flex-grow">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-800">{{ $room->name }}</h3>
                                        <span class="hidden sm:block text-sm font-bold text-gray-800">Servizi</span>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                                        <div class="w-full sm:w-1/2">
                                            <p class="text-sm text-gray-600 line-clamp-3">{{ $room->description }}</p>
                                            <a href="#" @click.prevent="isModalOpen = true" class="text-yellow-600 text-sm font-medium hover:underline mt-1 inline-block">continua</a>
                                        </div>
                                        <div class="w-full sm:w-1/2 grid grid-cols-2 gap-y-2 text-xs sm:text-sm text-gray-600 bg-gray-50 sm:bg-transparent p-3 sm:p-0 rounded-lg sm:rounded-none">
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Wi-Fi gratis</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Aria cond.</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Bagno privato</div>
                                            <div class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> TV Piatta</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FIX MOBILE: Barra inferiore disposta su colonna per smartphone, riga per schermi grandi --}}
                                <div class="bg-gray-50 border-t border-gray-100 p-4 flex flex-col sm:flex-row items-stretch sm:items-center justify-between sm:justify-end gap-3 sm:gap-4">
                                    <div class="text-left sm:text-right flex flex-row sm:flex-col justify-between items-center sm:items-end">
                                        <span class="text-xs text-gray-500 block">prezzo di partenza</span>
                                        <span class="text-xl sm:text-2xl font-bold text-gray-800">
                                            da <span class="text-yellow-600">€{{ number_format($room->price / 100 ?? 0, 2, ',', '.') }}</span>
                                            @if(!isset($checkIn)) <span class="text-sm text-gray-500 font-normal">/notte</span> @endif
                                        </span>
                                    </div>

                                    @if(isset($checkIn) && isset($checkOut))
                                    <button @click="openRates = !openRates" class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded transition flex items-center justify-center gap-2 text-sm sm:text-base">
                                        INFO E PRENOTA
                                        <i class="fa-solid" :class="openRates ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                    </button>
                                    @else
                                    <button type="button" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-full sm:w-auto bg-[#354F42] hover:bg-[#263C32] text-white font-bold py-3 px-6 rounded shadow-sm transition flex items-center justify-center gap-2 text-sm sm:text-base">
                                        INSERISCI DATE
                                        <i class="fa-regular fa-calendar-days"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Tendina Tariffe --}}
                        @if(isset($checkIn) && isset($checkOut))
                        <div x-show="openRates" x-collapse class="bg-white border-t-2 border-gray-200">
                            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-100 p-3 text-xs font-bold text-gray-600 uppercase">
                                <div class="col-span-4">Tariffa</div>
                                <div class="col-span-5">Trattamento</div>
                                <div class="col-span-3">Prezzo</div>
                            </div>

                            @foreach($room->rates ?? [
                            (object)['id' => 1, 'name' => 'Camera e colazione', 'desc' => 'La scelta semplice e flessibile', 'price' => $room->price, 'is_best' => true],
                            (object)['id' => 2, 'name' => 'Mezza pensione', 'desc' => 'Cena inclusa nel ristorante', 'price' => $room->price + 2000, 'is_best' => false]
                            ] as $rate)
                            <div class="flex flex-col md:grid md:grid-cols-12 gap-2 md:gap-4 p-4 border-b border-gray-100 md:items-center {{ $rate->is_best ? 'bg-green-50/50' : 'hover:bg-gray-50' }}">
                                <div class="md:col-span-4">
                                    <p class="font-medium text-gray-800">{{ $rate->desc }}</p>
                                </div>
                                <div class="md:col-span-5">
                                    <p class="font-bold text-gray-800 text-sm md:text-base">{{ $rate->name }}</p>
                                    <p class="text-xs text-gray-500 mb-1">Prezzo per {{ request('adults', 2) }} adulti</p>
                                </div>
                                {{-- FIX MOBILE: Spaziatura e larghezza bottone tariffe per renderlo tappabile col dito --}}
                                <div class="md:col-span-3 flex flex-col md:items-end gap-3 border-t md:border-t-0 pt-3 md:pt-0 mt-2 md:mt-0 items-stretch">
                                    <div class="flex justify-between md:flex-col md:text-right items-center md:items-end">
                                        <span class="text-xl md:text-2xl font-bold text-gray-800 block">€{{ number_format($rate->price / 100, 0, ',', '.') }}</span>
                                        @if($rate->is_best)
                                        <span class="text-xs text-green-600 font-bold flex items-center gap-1 justify-end"><i class="fa-regular fa-thumbs-up"></i> Miglior prezzo</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('summary', $room->id ?? 1) }}" class="text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 md:py-2 px-6 rounded shadow-sm transition w-full md:w-auto">
                                        CONTINUA
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                    </div>
                    @empty
                    <div class="bg-white p-8 sm:p-12 rounded-lg shadow-sm flex flex-col items-center justify-center text-center">
                        <i class="fa-regular fa-face-frown-open text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2">Nessuna camera trovata</h3>
                        <p class="text-gray-500 max-w-md text-sm sm:text-base">Prova a modificare le date o il numero di ospiti per trovare altre soluzioni.</p>
                    </div>
                    @endforelse
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        flatpickr("#inline-calendar-container", {
                            inline: true,
                            mode: "range",
                            minDate: "today",
                            showMonths: 1,
                            minRangeDays: 1,
                            locale: "it",
                            dateFormat: "d-m-Y",
                            monthSelectorType: "static",
                            onChange: function(selectedDates, dateStr, instance) {
                                // 1. INTERCETTAZIONE INTERATTIVA: Se l'utente seleziona due date identiche (0 notti)
                                if (selectedDates.length === 2) {
                                    const checkInTime = selectedDates[0].getTime();
                                    const checkOutTime = selectedDates[1].getTime();

                                    if (checkInTime === checkOutTime) {
                                        // Forza Flatpickr a dimenticare il secondo click, mantenendo solo il check-in
                                        instance.setDate([selectedDates[0]], false);

                                        // Aggiorna l'interfaccia avvisando visivamente l'utente
                                        document.getElementById('display-checkout').innerText = "Scegli un giorno successivo";
                                        document.getElementById('display-checkout').classList.add('text-red-500', 'animate-pulse');
                                        document.getElementById('display-nights').innerText = "0";
                                        document.getElementById('date-range-input').value = "";
                                        return; // Interrompe l'esecuzione così non aggiorna i dati con date errate
                                    }
                                }

                                // Rimozione di eventuali classi di errore se la selezione è valida
                                document.getElementById('display-checkout').classList.remove('text-red-500', 'animate-pulse');

                                // 2. LOGICA STANDARD DI AGGIORNAMENTO
                                document.getElementById('date-range-input').value = dateStr;

                                const options = {
                                    day: 'numeric',
                                    month: 'short',
                                    year: 'numeric'
                                };

                                // Gestione Check-in
                                if (selectedDates.length > 0) {
                                    document.getElementById('display-checkin').innerText = selectedDates[0].toLocaleDateString('it-IT', options);
                                } else {
                                    document.getElementById('display-checkin').innerText = "Seleziona";
                                }

                                // Gestione Check-out e Notti
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
            </div>
        </div>
    </div>
</x-layoutBooking>
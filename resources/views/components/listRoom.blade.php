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
                                        isModalOpen: false, {{-- 1. Aggiunto stato per la modale --}}
                                        slides: [
                                            {{-- Cicliamo le vere immagini caricate dal database --}}
                                            @forelse($room->images as $image)
                                                '{{ asset('storage/' . $image->pathImage) }}', 
                                            @empty
                                                {{-- Se la camera non ha immagini, mostriamo un segnaposto --}}
                                                'https://via.placeholder.com/600x400/eeeeee/999999?text=Nessuna+Foto'
                                            @endforelse
                                        ] 
                                    }">

            {{-- Immagine attiva nella Card --}}
            {{-- 2. Aggiunto @click e classi cursor-pointer/hover per interazione --}}
            <img :src="slides[activeSlide]" alt="{{ $room->name }}"
                @click="isModalOpen = true"
                class="absolute inset-0 w-full h-full object-cover cursor-pointer hover:opacity-95 transition-opacity" />

            {{-- Frecce della card (mostrate SOLO se ci sono più di 1 immagine) --}}
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

            {{-- Badge Dimensione --}}
            <div class="absolute top-2 left-2 bg-white/90 px-2 py-1 text-xs font-medium text-gray-700 rounded shadow-sm flex items-center gap-1 pointer-events-none">
                <i class="fa-solid fa-maximize text-yellow-500"></i> Circa {{ $room->size ?? '25' }} m²
            </div>

            {{-- 3. LA MODALE POP-UP --}}
            {{-- x-teleport sposta questo codice alla fine del tag <body> per evitare problemi di CSS nesting --}}
            <template x-teleport="body">
                <div x-show="isModalOpen"
                    style="display: none;"
                    @keydown.escape.window="isModalOpen = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 sm:p-6"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    {{-- Contenitore Bianco Modale --}}
                    <div @click.away="isModalOpen = false"
                        class="bg-white rounded-xl shadow-2xl w-full max-w-6xl h-auto max-h-[90vh] flex flex-col md:flex-row overflow-hidden relative"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">

                        {{-- Bottone di chiusura in alto a destra --}}
                        <button @click="isModalOpen = false"
                            class="absolute top-4 right-4 z-20 bg-white/80 hover:bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center transition shadow-md">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>

                        {{-- Lato Sinistro: Immagine Grande (stile prima immagine) --}}
                        <div class="w-full md:w-7/12 relative min-h-[40vh] md:min-h-[600px] bg-gray-100">
                            <img :src="slides[activeSlide]" alt="{{ $room->name }}" class="absolute inset-0 w-full h-full object-cover" />

                            {{-- Frecce grandi per la modale --}}
                            <template x-if="slides.length > 1">
                                <div>
                                    <button @click.stop="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 w-12 h-12 rounded-full flex items-center justify-center hover:bg-white transition shadow-lg">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button @click.stop="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 w-12 h-12 rounded-full flex items-center justify-center hover:bg-white transition shadow-lg">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </template>
                        </div>

                        {{-- Lato Destro: Descrizione e Servizi (stile pulito seconda immagine) --}}
                        <div class="w-full md:w-5/12 p-8 overflow-y-auto bg-white flex flex-col">

                            <h3 class="text-2xl font-bold text-slate-800 mb-4">{{ $room->name ?? 'Matrimoniale con balcone' }}</h3>

                            <p class="text-gray-500 text-sm leading-relaxed mb-8 font-light">
                                {{ $room->description ?? 'Entra in un\'atmosfera autentica e rilassante all\'interno della nostra camera di albergo. Goditi momenti di pace e tranquillità in questa confortevole stanza dotata di tutti i comfort necessari per un soggiorno piacevole.' }}
                            </p>

                            <h4 class="text-sm font-semibold text-slate-800 mb-4">Servizi inclusi</h4>

                            {{-- Griglia servizi stile "SuiteDirect" (spunte gialle e testo grigio scuro) --}}
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-4 text-sm text-slate-600">
                                {{-- Puoi ciclare questi da database se hai una relazione $room->amenities --}}
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Balcone panoramico</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Wi-Fi gratis</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Aria condizionata</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Bagno privato</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> TV a schermo piatto</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-yellow-500"></i> Cassaforte</li>
                            </ul>

                            {{-- Bottone opzionale in fondo per prenotare direttamente dalla modale --}}
                            <div class="mt-auto pt-8">
                                <button @click="isModalOpen = false" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold py-3 rounded-lg transition">
                                    Chiudi e torna ai risultati
                                </button>
                            </div>

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
                <a href="{{ route('summary', $room->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded shadow-sm transition">
                    CONTINUA
                </a>
            </div>
        </div>
        @endforeach

    </div> {{-- Fine Tendina Espandibile --}}
</div> {{-- Fine Card Camera --}}
<x-layout>
    {{-- HERO SEZIONE (Invariata, già perfetta) --}}
    <div class="hero h-screen min-h-screen relative overflow-hidden bg-black"
        x-data="{ 
        activeSlide: 0, 
        slides: [
            '{{ asset('hero/hero1.webp') }}', 
            '{{ asset('hero/hero2.webp') }}', 
            '{{ asset('hero/hero3.webp') }}'
        ] 
     }"
        x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 6000)">

        <template x-for="(slide, index) in slides" :key="index">
            <div class="absolute inset-0 w-full h-full overflow-hidden"
                x-show="activeSlide === index"
                x-transition:enter="transition-opacity duration-1000 ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-1000 ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">

                <img :src="slide"
                    alt="Luxury Hotel Scene"
                    class="absolute inset-0 w-full h-full object-cover animate-kenburns" />
                <div class="hero-overlay bg-black/60 absolute inset-0"></div>
            </div>
        </template>

        <div class="hero-content text-center text-neutral-content z-10 relative">
            <div class="max-w-md">
                <h1 class="mb-6 text-5xl md:text-6xl font-bold uppercase tracking-widest text-white">Ospitalità Autentica</h1>
                <p class="mb-8 text-lg italic text-white/90">Il punto di partenza ideale per il tuo viaggio. Scopri le nostre strutture e prenota la tua esperienza in pochi istanti.</p>

                <a href="{{ route('calendar') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary bg-emerald-600 px-10 rounded-full border-none shadow-lg hover:scale-105 transition-transform duration-300">
                    Prenota Ora
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-3 z-20">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index"
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="activeSlide === index ? 'bg-white w-7' : 'bg-white/50 hover:bg-white/80'"></button>
            </template>
        </div>
    </div>

    {{-- 1. SEZIONE TERRITORIO --}}
    <section id="territorio" class="py-24 bg-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Testo: Entra da sinistra --}}
            <div class="space-y-6 transition-all duration-1000 ease-out"
                x-data="{ shown: false }"
                x-intersect:enter="shown = true"
                x-intersect:leave="shown = false"
                :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Esplora i dintorni</h2>
                <h3 class="text-4xl font-light text-slate-900">Un rifugio tra natura e cultura</h3>
                <p class="text-slate-500 leading-relaxed">Immersi nel cuore di paesaggi mozzafiato, offriamo un punto di partenza ideale per scoprire le meraviglie locali. Goditi passeggiate rilassanti, sapori autentici e tradizioni secolari.</p>
                <a href="{{ route('territory') }}" class="inline-block px-8 py-3 mt-4 text-sm font-medium tracking-wider uppercase border border-slate-800 text-slate-800 rounded-full hover:bg-slate-800 hover:text-white transition-all duration-300">
                    Scopri di più
                </a>
            </div>

            {{-- Immagini Sovrapposte: Entrano da destra --}}
            <div class=" relative transition-all duration-1000 delay-200 ease-out"
                x-data="{ shown: false }"
                x-intersect:enter="shown = true"
                x-intersect:leave="shown = false"
                :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'">
                <img src="{{asset('territorio/terri1.webp')}}" alt="Paesaggio" class="w-4/5 h-[500px] object-cover rounded-lg shadow-xl ml-auto" />
                <img src="{{asset('territorio/terri2.webp')}}" alt="Dettaglio" class="absolute bottom-10 left-0 w-1/2 h-[250px] object-cover rounded-lg shadow-2xl border-4 border-white" />
            </div>
        </div>
    </section>

    {{-- 2. SEZIONE CAMERE --}}
    <section id="camere" class="py-24 bg-slate-50 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="text-center mb-16 transition-all duration-1000 ease-out"
            x-data="{ shown: false }"
            x-intersect:enter="shown = true"
            x-intersect:leave="shown = false"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <h2 class="text-3xl font-light text-slate-900">I Nostri Alloggi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($rooms as $room)
            <div class="group transition-all duration-700 ease-out"
                style="transition-delay: {{ $loop->index * 150 }}ms;"
                x-data="{ 
                shown: false,
                mainImage: '{{ $room->images->first() ? asset('storage/' . $room->images->first()->pathImage) : 'https://via.placeholder.com/600x400/eeeeee/999999?text=Nessuna+Foto' }}'
             }"
                x-intersect:enter="shown = true"
                x-intersect:leave="shown = false"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-16'">

                {{-- CARD VISIBILE SULLA HOME --}}
                <div class="relative w-full h-80 overflow-hidden rounded-xl mb-4 bg-gray-200">
                    <img :src="mainImage"
                        alt="{{ $room->name }}"
                        class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-105" />
                </div>

                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-xl font-medium text-slate-800 transition-colors group-hover:text-emerald-600">
                            {{ $room->name }}
                        </h4>
                        @if($room->description)
                        <p class="text-slate-400 text-xs mt-1 font-light line-clamp-1">{{ $room->description }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-slate-900 font-semibold text-lg">Da €{{ $room->price }}</p>
                        <p class="text-slate-400 text-xs font-light">/ notte</p>
                    </div>
                </div>

            </div>
            @endforeach

        </div>
        <div class="text-center mt-12">
            <a href="{{ route('allRooms') }}" class="inline-block px-8 py-3 text-sm font-medium tracking-wider uppercase border border-slate-800 text-slate-800 rounded-full hover:bg-slate-800 hover:text-white transition-all duration-300">
                Scopri di più
            </a>
        </div>
    </section>

    {{-- SEZIONE SERVIZI --}}
    <section id="servizi" class="py-24 bg-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">

        <div class="mb-16 md:w-2/3 transition-all duration-1000 ease-out"
            x-data="{ shown: false }"
            x-intersect:enter="shown = true"
            x-intersect:leave="shown = false"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <h2 class="text-3xl font-light text-slate-900">Esperienze e Servizi</h2>
            <p class="mt-4 text-slate-500 font-light leading-relaxed">Arricchisci il tuo soggiorno con i nostri servizi esclusivi. Dal noleggio attrezzatura ai momenti di puro relax, pensiamo a tutto noi.</p>
        </div>

        <div class="space-y-20">
            @foreach($services as $service)
            {{-- Logica alternata non solo per il flex, ma anche per la direzione dell'animazione (-translate-x-12 o translate-x-12) --}}
            <div class="flex flex-col md:flex-row {{ $loop->iteration % 2 == 0 ? 'md:flex-row-reverse' : '' }} gap-8 lg:gap-16 items-center group transition-all duration-1000 ease-out"
                x-data="{ shown: false }"
                x-intersect:enter="shown = true"
                x-intersect:leave="shown = false"
                :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 {{ $loop->iteration % 2 == 0 ? 'translate-x-16' : '-translate-x-16' }}'">

                <div class="w-full md:w-1/2 relative overflow-hidden rounded-2xl shadow-lg h-[350px]">
                    <img src="{{ asset('storage/' . $service->pathImage) }}"
                        alt="{{ $service->name }}"
                        class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />


                </div>

                <div class="w-full md:w-1/2">
                    <h3 class="text-3xl font-medium text-slate-800 mb-4">{{ $service->name }}</h3>
                    <div class="w-12 h-1 bg-slate-300 mb-6"></div>
                    <p class="text-slate-500 font-light leading-relaxed mb-8">
                        {{ $service->description }}
                    </p>

                    <button class="text-slate-800 font-medium hover:text-slate-500 transition-colors flex items-center gap-2 group/btn">
                        Richiedi servizio
                        <i class="fa-solid fa-arrow-right text-sm transform transition-transform group-hover/btn:translate-x-1"></i>
                    </button>
                </div>

            </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('allServices') }}" class="inline-block px-8 py-3 text-sm font-medium tracking-wider uppercase border border-slate-800 text-slate-800 rounded-full hover:bg-slate-800 hover:text-white transition-all duration-300">
                Scopri di più
            </a>
        </div>
    </section>

    {{-- SEZIONE RECENSIONI --}}
    <section id="recensioni" class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-10 left-10 text-slate-800/50 text-9xl font-serif select-none pointer-events-none">
            "
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 transition-all duration-1000 ease-out"
            x-data="{ shown: false, activeSlide: 0, totalSlides: {{ $reviews->count() }} }"
            x-intersect:enter="shown = true"
            x-intersect:leave="shown = false"
            :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">

            <div class="text-center mb-16">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-2">Dicono di Noi</h2>
                <h3 class="text-3xl font-light">Le esperienze dei nostri ospiti</h3>
            </div>

            <div class="overflow-hidden relative w-full">
                <div class="flex transition-transform duration-700 ease-in-out"
                    :style="`transform: translateX(-${activeSlide * 100}%)`">

                    @foreach($reviews as $review)
                    <div class="w-full shrink-0 px-4 flex flex-col items-center text-center">

                        <div class="flex justify-center gap-1 mb-6 text-yellow-500 text-sm">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <=$review->rating)
                                <i class="fa-solid fa-star"></i>
                                @else
                                <i class="fa-regular fa-star"></i>
                                @endif
                                @endfor
                        </div>

                        <h4 class="text-2xl md:text-3xl font-medium mb-6">"{{ $review->title }}"</h4>
                        <p class="text-slate-300 font-light text-lg italic mb-10 max-w-2xl mx-auto leading-relaxed">
                            {{ $review->description }}
                        </p>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-sm font-bold">
                                {{ substr($review->user->firstName ?? 'O', 0, 1) }}
                            </div>
                            <span class="text-sm font-bold uppercase tracking-widest text-slate-400">
                                {{ $review->user->lastName ?? 'Ospite' }}
                            </span>
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            @if($reviews->count() > 1)
            <div class="flex justify-center gap-4 mt-12">
                <button @click="activeSlide = activeSlide === 0 ? totalSlides - 1 : activeSlide - 1"
                    class="w-10 h-10 rounded-full border border-slate-700 text-slate-400 hover:text-white hover:border-white transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-arrow-left text-sm"></i>
                </button>
                <button @click="activeSlide = activeSlide === totalSlides - 1 ? 0 : activeSlide + 1"
                    class="w-10 h-10 rounded-full border border-slate-700 text-slate-400 hover:text-white hover:border-white transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
            </div>
            @endif

        </div>
    </section>

</x-layout>
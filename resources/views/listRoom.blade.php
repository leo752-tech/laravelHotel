<x-layout>
    <section class="relative h-screen w-full overflow-hidden flex items-center justify-center">

        <!-- Immagine di sfondo con animazione Zoom -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop"
                alt="Camera Hotel di Lusso"
                class="w-full h-full object-cover animate-hero">
            <!-- Overlay scuro per rendere il testo leggibile -->
            <div class="absolute inset-0 bg-black/40 back-drop-blur-[2px]"></div>
        </div>

        <!-- Contenuto della Hero -->
        <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto space-y-6">
            <span class="text-sm uppercase tracking-[0.3em] text-stone-300 block opacity-0 animate-[fadeIn_1s_ease-out_0.5s_forwards]">
                Esperienza Esclusiva
            </span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif tracking-wide opacity-0 animate-[fadeIn_1s_ease-out_0.8s_forwards]">
                Il tuo rifugio di classe
            </h1>
            <p class="text-lg md:text-xl text-stone-200 font-light max-w-2xl mx-auto opacity-0 animate-[fadeIn_1s_ease-out_1.1s_forwards]">
                Scatena il comfort in stanze progettate per il tuo relax assoluto.
            </p>
            <div class="pt-4 opacity-0 animate-[fadeIn_1s_ease-out_1.4s_forwards]">
                <a href="#camere" class="inline-block bg-white text-stone-900 px-8 py-3.5 text-sm font-medium uppercase tracking-wider rounded-none hover:bg-stone-900 hover:text-white transition-colors duration-300 shadow-lg">
                    Esplora le Camere
                </a>
            </div>
        </div>

        <!-- Indicatore di Scroll in basso -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 text-white animate-bounce">
            <a href="#camere" aria-label="Scorri verso il basso">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
    </section>

    <!-- 2. SEZIONE INTRODUTTIVA -->
    <section id="camere" class="py-20 px-4 max-w-7xl mx-auto text-center scroll-mt-10">
        <span class="text-xs uppercase tracking-widest text-amber-600 font-semibold">Il Nostro Hotel</span>
        <h2 class="text-3xl md:text-4xl font-serif mt-2 mb-6">Soggiorni indimenticabili</h2>
        <p class="text-stone-600 max-w-2xl mx-auto font-light leading-relaxed">
            Ogni camera è rifinita con materiali di pregio e dotata di tutti i comfort moderni per garantirti un soggiorno all'insegna del relax e del benessere.
        </p>
    </section>

    <!-- 3. SEZIONE VIRTUALIZZAZIONE CAMERE (Layout Alternato) -->
    <section class="max-w-7xl mx-auto px-4 pb-24 space-y-20 md:space-y-32">
        @foreach($rooms as $room)
        @if($loop->index % 2 == 0)

        <!-- Camera 1: Immagine a Sinistar, Testo a Destra -->
        <div class="w-full grid md:grid-cols-12 items-stretch min-h-[60vh] md:min-h-[85vh] bg-stone-50 overflow-hidden">

            <!-- Colonna Immagine -->
            <div class="col-span-12 md:col-span-8 relative overflow-hidden group min-h-[450px] md:min-h-0">
                <img src="{{asset('storage/' . $room->images->first()->pathImage)}}"
                    alt="{{ $room->name }}"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-out">
            </div>

            <!-- Colonna Contenuto -->
            <div class="col-span-12 md:col-span-4 flex flex-col justify-center px-8 py-16 md:p-12 lg:p-16 space-y-6">
                <h3 class="text-3xl md:text-4xl lg:text-5xl font-serif tracking-wide text-stone-900 leading-tight">
                    {{$room->name}}
                </h3>

                <p class="text-stone-600 font-light leading-relaxed text-base md:text-lg">
                    {{$room->description}}
                </p>

                <div class="pt-4">
                    <a href="{{ route('detailRoom', $room->id) }}" class="inline-block border-b border-stone-900 pb-2 text-sm font-semibold uppercase tracking-widest text-stone-900 hover:text-amber-800 hover:border-amber-800 transition-colors duration-300">
                        Scopri i dettagli
                    </a>
                </div>
            </div>
        </div>

        @else

        <!-- Camera 2: Testo a Sinistra, Immagine a Destra (Sistemata ed equivalente alla prima) -->
        <div class="w-full grid md:grid-cols-12 items-stretch min-h-[60vh] md:min-h-[85vh] bg-stone-50 overflow-hidden">

            <!-- Colonna Contenuto (Viene prima nell'HTML, stando a sinistra su Desktop) -->
            <div class="col-span-12 md:col-span-4 flex flex-col justify-center px-8 py-16 md:p-12 lg:p-16 space-y-6">
                <h3 class="text-3xl md:text-4xl lg:text-5xl font-serif tracking-wide text-stone-900 leading-tight">
                    {{$room->name}}
                </h3>

                <p class="text-stone-600 font-light leading-relaxed text-base md:text-lg">
                    {{$room->description}}
                </p>

                <div class="pt-4">
                    <a href="{{ route('detailRoom', $room->id)}}" class="inline-block border-b border-stone-900 pb-2 text-sm font-semibold uppercase tracking-widest text-stone-900 hover:text-amber-800 hover:border-amber-800 transition-colors duration-300">
                        Scopri i dettagli
                    </a>
                </div>
            </div>

            <!-- Colonna Immagine (Viene dopo nell'HTML, stando a destra su Desktop) -->
            <div class="col-span-12 md:col-span-8 relative overflow-hidden group min-h-[450px] md:min-h-0">
                <img src="{{asset('storage/' . $room->images->first()->pathImage)}}"
                    alt="{{ $room->name }}"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-out">
            </div>
        </div>
        @endif
        @endforeach

    </section>
</x-layout>
<x-layout>
    {{-- HEADER DELLA PAGINA / INTRO --}}
    <div class="relative bg-slate-900 py-24 px-4 sm:px-6 lg:px-8 text-center overflow-hidden">
        {{-- Sfondo soft decorativo --}}
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px]"></div>

        <div class="relative max-w-3xl mx-auto transition-all duration-1000 ease-out"
            x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
            <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest bg-emerald-500/10 px-4 py-1.5 rounded-full">Esclusività & Comfort</span>
            <h1 class="mt-6 text-4xl md:text-5xl font-light text-white tracking-tight">I Nostri Servizi</h1>
            <p class="mt-4 text-lg text-slate-400 font-light leading-relaxed">
                Ogni dettaglio è pensato per offrirti un soggiorno senza pensieri. Scopri le attenzioni, i comfort tecnologici e le esperienze su misura che abbiamo preparato per farti sentire a casa.
            </p>
        </div>
    </div>

    {{-- CONTENITORE DELLE TRE SEZIONI APPROFONDIMENTO --}}
    <div class="bg-white space-y-32 py-24 overflow-hidden">

        {{-- SEZIONE 1: ACCOGLIENZA E FLESSIBILITÀ (Layout: Immagine a Sinistra, Testo a Destra) --}}
        <section class="max-w-7xl mx-auto px-4 pb-24 space-y-20 md:space-y-32">
            @foreach($services as $service)
            @if($loop->index % 2 == 0)

            <!-- Camera 1: Immagine a Sinistar, Testo a Destra -->
            <div class="w-full grid md:grid-cols-12 items-stretch min-h-[60vh] md:min-h-[85vh] bg-stone-50 overflow-hidden">

                <!-- Colonna Immagine -->
                <div class="col-span-12 md:col-span-8 relative overflow-hidden group min-h-[450px] md:min-h-0">
                    <img src="{{asset('storage/' . $service->pathImage)}}"
                        alt="{{ $service->name }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-out">
                </div>

                <!-- Colonna Contenuto -->
                <div class="col-span-12 md:col-span-4 flex flex-col justify-center px-8 py-16 md:p-12 lg:p-16 space-y-6">
                    <h3 class="text-3xl md:text-4xl lg:text-5xl font-serif tracking-wide text-stone-900 leading-tight">
                        {{$service->name}}
                    </h3>

                    <p class="text-stone-600 font-light leading-relaxed text-base md:text-lg">
                        {{$service->description}}
                    </p>
                </div>
            </div>

            @else

            <!-- Camera 2: Testo a Sinistra, Immagine a Destra (Sistemata ed equivalente alla prima) -->
            <div class="w-full grid md:grid-cols-12 items-stretch min-h-[60vh] md:min-h-[85vh] bg-stone-50 overflow-hidden">

                <!-- Colonna Contenuto (Viene prima nell'HTML, stando a sinistra su Desktop) -->
                <div class="col-span-12 md:col-span-4 flex flex-col justify-center px-8 py-16 md:p-12 lg:p-16 space-y-6">
                    <h3 class="text-3xl md:text-4xl lg:text-5xl font-serif tracking-wide text-stone-900 leading-tight">
                        {{$service->name}}
                    </h3>

                    <p class="text-stone-600 font-light leading-relaxed text-base md:text-lg">
                        {{$service->description}}
                    </p>

                    
                </div>

                <!-- Colonna Immagine (Viene dopo nell'HTML, stando a destra su Desktop) -->
                <div class="col-span-12 md:col-span-8 relative overflow-hidden group min-h-[450px] md:min-h-0">
                    <img src="{{asset('storage/' . $service->pathImage)}}"
                        alt="{{ $service->name }}"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-out">
                </div>
            </div>
            @endif
            @endforeach

        </section>

    </div>
</x-layout>
<x-layout>
    {{-- HEADER DELLA PAGINA / INTRO --}}
    <div class="relative bg-slate-900 py-24 px-4 sm:px-6 lg:px-8 text-center overflow-hidden">
        {{-- Sfondo soft decorativo --}}
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px]"></div>

        <div class="relative max-w-3xl mx-auto transition-all duration-1000 ease-out"
            x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
            <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest bg-emerald-500/10 px-4 py-1.5 rounded-full">Guida Locale</span>
            <h1 class="mt-6 text-4xl md:text-5xl font-light text-white tracking-tight">Scopri il Nostro Territorio</h1>
            <p class="mt-4 text-lg text-slate-400 font-light leading-relaxed">
                Un viaggio tra meraviglie nascoste, panorami mozzafiato e tradizioni millenarie. Esplora i luoghi più autentici e vivi le esperienze che rendono unica questa destinazione, 365 giorni all'anno.
            </p>
        </div>
    </div>

    {{-- CONTENITORE DELLE TRE SEZIONI APPROFONDIMENTO --}}
    <div class="bg-white space-y-32 py-24 overflow-hidden">

        {{-- SEZIONE 1: STORIA, BORGHI E ARTE (Layout: Immagine a Sinistra, Testo a Destra) --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                {{-- Blocco Immagine (Scorcio storico/culturale elegante) --}}
                <div class="lg:col-span-7 relative group transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="absolute inset-0 bg-emerald-600 rounded-2xl transform translate-x-4 translate-y-4 opacity-10 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-500"></div>
                    <div class="relative h-[450px] overflow-hidden rounded-2xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=1200&q=80"
                            alt="Centri storici e cultura"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                        <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-lg shadow-sm">
                            <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">Storia & Radici</p>
                        </div>
                    </div>
                </div>

                {{-- Blocco Testo --}}
                <div class="lg:col-span-5 space-y-6 transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Luoghi da Visitare</div>
                    <h2 class="text-3xl font-light text-slate-900 leading-tight">Un Patrimonio Storico da Raccontare</h2>
                    <p class="text-slate-500 font-light leading-relaxed">
                        Perdersi tra le vie antiche della nostra zona significa fare un salto indietro nel tempo. Dai vicoli in pietra dei borghi storici vicini, ricchi di architetture medievali e botteghe artigiane, fino ai monumenti e ai musei che custodiscono l'essenza culturale del luogo. Ogni angolo nasconde un segreto o una leggenda che aspetta solo di essere scoperta.
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-block px-8 py-3 text-sm font-medium tracking-wider uppercase border border-slate-800 text-slate-800 rounded-full hover:bg-slate-800 hover:text-white transition-all duration-300">
                            Punti di Interesse
                        </a>
                    </div>
                </div>

            </div>
        </section>


        {{-- SEZIONE 2: NATURA, PAESAGGI E OUTDOOR (Layout Invertito: Testo a Sinistra, Immagine a Destra) --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                {{-- Blocco Testo --}}
                <div class="lg:col-span-5 order-2 lg:order-1 space-y-6 transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Natura & Paesaggi</div>
                    <h2 class="text-3xl font-light text-slate-900 leading-tight">Oasi di Pace e Scenari Incontaminati</h2>
                    <p class="text-slate-500 font-light leading-relaxed">
                        Il territorio circostante offre una varietà straordinaria di paesaggi naturali che cambiano volto con il mutare delle stagioni. Che si tratti di maestose viste collinari, sentieri immersi nei boschi o scorci panoramici mozzafiato, troverai lo spazio ideale per staccare dalla routine quotidiana e riconnetterti con la natura in totale libertà e sicurezza.
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-flex items-center gap-2 text-slate-800 font-medium uppercase text-sm tracking-wider hover:text-slate-500 transition-colors group">
                            Itinerari Naturalistici
                            <i class="fa-solid fa-arrow-right transform transition-transform duration-300 group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>

                {{-- Blocco Immagine (Natura evocativa ed estetica) --}}
                <div class="lg:col-span-7 order-1 lg:order-2 relative group transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    <div class="absolute inset-0 bg-slate-900 rounded-2xl transform -translate-x-4 translate-y-4 opacity-10 group-hover:-translate-x-2 group-hover:translate-y-2 transition-transform duration-500"></div>
                    <div class="relative h-[450px] overflow-hidden rounded-2xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80"
                            alt="Paesaggi naturali"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                        <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-lg shadow-sm">
                            <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">Scenari da Sogno</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        {{-- SEZIONE 3: ATTIVITÀ ed ENOGASTRONOMIA (Layout: Griglia Asimmetrica) --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Griglia di immagini d'atmosfera (Attività, cibo, outdoor, dettagli) --}}
                <div class="lg:col-span-6 grid grid-cols-12 gap-4 relative transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">

                    {{-- 1. Attività outdoor generica (Trekking/Passeggiata dall'alto o bici) --}}
                    <div class="col-span-8 overflow-hidden rounded-xl shadow-lg h-72 group">
                        <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=800&q=80"
                            alt="Attività all'aria aperta"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>

                    {{-- 2. Enogastronomia locale / calici di vino e prodotti --}}
                    <div class="col-span-4 overflow-hidden rounded-xl shadow-lg h-48 mt-12 group">
                        <img src="https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?auto=format&fit=crop&w=600&q=80"
                            alt="Cucina e sapori"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>

                    {{-- 3. Dettaglio di un'esperienza locale o artigianato --}}
                    <div class="col-span-4 overflow-hidden rounded-xl shadow-lg h-48 -mt-8 group">
                        <img src="https://images.unsplash.com/photo-1459411552884-841db9b3cc2a?auto=format&fit=crop&w=600&q=80"
                            alt="Tradizioni locali"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>

                    {{-- 4. Momento di relax / Tramonto o punto panoramico --}}
                    <div class="col-span-8 overflow-hidden rounded-xl shadow-lg h-64 -mt-20 group">
                        <img src="https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=800&q=80"
                            alt="Esperienze memorabili"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>
                </div>

                {{-- Blocco Testo descrittivo --}}
                <div class="lg:col-span-6 lg:pl-12 space-y-6 transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Esperienze Locali</div>
                    <h2 class="text-3xl font-light text-slate-900 leading-tight">Cose da Fare, Sapori da Vivere</h2>
                    <p class="text-slate-500 font-light leading-relaxed">
                        Vivere appieno il territorio significa farsi coinvolgere dalle attività locali. Dalle escursioni all'aria aperta e sport stagionali, fino alle esperienze enogastronomiche guidate. Potrai assaporare i piatti della tradizione basati su materie prime d'eccellenza, partecipare a degustazioni nelle cantine più rinomate o scoprire i segreti dell'artigianato tipico tramandato da generazioni.
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-block px-8 py-3 text-sm font-medium tracking-wider text-white bg-slate-900 rounded-full shadow-md hover:bg-slate-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                            Calendario Esperienze
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </div>
</x-layout>
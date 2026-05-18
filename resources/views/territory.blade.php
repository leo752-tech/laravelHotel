<x-layout>
    {{-- HEADER DELLA PAGINA / INTRO --}}
    <div class="relative bg-slate-900 py-24 px-4 sm:px-6 lg:px-8 text-center overflow-hidden">
        {{-- Sfondo soft decorativo --}}
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px]"></div>

        <div class="relative max-w-3xl mx-auto transition-all duration-1000 ease-out"
            x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)"
            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
            <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest bg-emerald-500/10 px-4 py-1.5 rounded-full">Il Cuore degli Appennini</span>
            <h1 class="mt-6 text-4xl md:text-5xl font-light text-white tracking-tight">Esplora Roccaraso & Pescasseroli</h1>
            <p class="mt-4 text-lg text-slate-400 font-light leading-relaxed">
                Dalle vette innevate del comprensorio Alto Sangro fino ai sentieri incontaminati del Parco Nazionale d'Abruzzo. Un territorio magico da vivere 365 giorni all'anno.
            </p>
        </div>
    </div>

    {{-- CONTENITORE DELLE TRE SEZIONI APPROFONDIMENTO --}}
    <div class="bg-white space-y-32 py-24 overflow-hidden">

        {{-- SEZIONE 1: ROCCARASO & SPORT INVERNIALI (Layout: Immagine a Sinistra, Testo a Destra) --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                {{-- Blocco Immagine con card asimmetrica --}}
                <div class="lg:col-span-7 relative group transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="absolute inset-0 bg-emerald-600 rounded-2xl transform translate-x-4 translate-y-4 opacity-10 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-500"></div>
                    <div class="relative h-[450px] overflow-hidden rounded-2xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?auto=format&fit=crop&w=1200&q=80"
                            alt="Sci a Roccaraso"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                        <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-lg shadow-sm">
                            <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">Comprensorio Alto Sangro</p>
                        </div>
                    </div>
                </div>

                {{-- Blocco Testo --}}
                <div class="lg:col-span-5 space-y-6 transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Inverno Attivo</div>
                    <h2 class="text-3xl font-light text-slate-900 leading-tight">Le Piste da Sci più Grandi del Centro Italia</h2>
                    <p class="text-slate-500 font-light leading-relaxed">
                        Con oltre 110 km di piste, Roccaraso (Aremogna, Monte Pratello e Pizzalto) è il paradiso degli amanti della neve. Che tu sia un professionista dello snowboard o alle prime armi, troverai impianti di risalita all'avanguardia e panorami mozzafiato.
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-block px-8 py-3 text-sm font-medium tracking-wider uppercase border border-slate-800 text-slate-800 rounded-full hover:bg-slate-800 hover:text-white transition-all duration-300">
                            Impianti & Skipass
                        </a>
                    </div>
                </div>

            </div>
        </section>


        {{-- SEZIONE 2: PESCASSEROLI & PARCO NAZIONALE (Layout Invertito: Testo a Sinistra, Immagine a Destra) --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                {{-- Blocco Testo --}}
                <div class="lg:col-span-5 order-2 lg:order-1 space-y-6 transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-16'">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Ecoturismo & Natura</div>
                    <h2 class="text-3xl font-light text-slate-900 leading-tight">Nel Cuore del Parco Nazionale d'Abruzzo</h2>
                    <p class="text-slate-500 font-light leading-relaxed">
                        Pescasseroli è la culla della conservazione della natura in Italia. Cammina tra le faggete vetuste, patrimonio UNESCO, ed esplora i sentieri dove vivono in totale libertà l'Orso Bruno Marsicano, il Lupo Appenninico e il Camoscio d'Abruzzo.
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-flex items-center gap-2 text-slate-800 font-medium uppercase text-sm tracking-wider hover:text-slate-500 transition-colors group">
                            Guida ai Sentieri Trekking
                            <i class="fa-solid fa-arrow-right transform transition-transform duration-300 group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>

                {{-- Blocco Immagine con design a sbalzo geometrico --}}
                <div class="lg:col-span-7 order-1 lg:order-2 relative group transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-16'">
                    <div class="absolute inset-0 bg-slate-900 rounded-2xl transform -translate-x-4 translate-y-4 opacity-10 group-hover:-translate-x-2 group-hover:translate-y-2 transition-transform duration-500"></div>
                    <div class="relative h-[450px] overflow-hidden rounded-2xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=1200&q=80"
                            alt="Natura Pescasseroli"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                        <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-lg shadow-sm">
                            <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">Patrimonio Mondiale UNESCO</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        {{-- SEZIONE 3: I BORGHI STORICI & TRADIZIONI (Layout: Griglia Asimmetrica Focalizzata su Esperienza) --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Doppia immagine incastrata per un effetto editoriale molto elegante --}}
                <div class="lg:col-span-6 grid grid-cols-12 gap-4 relative transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">

                    <div class="col-span-8 overflow-hidden rounded-xl shadow-lg h-72 group">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80"
                            alt="Borghi Abruzzesi"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>

                    <div class="col-span-4 overflow-hidden rounded-xl shadow-lg h-48 mt-12 group">
                        <img src="https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?auto=format&fit=crop&w=600&q=80"
                            alt="Enogastronomia locale"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>

                    <div class="col-span-4 overflow-hidden rounded-xl shadow-lg h-48 -mt-8 group">
                        <img src="https://images.unsplash.com/photo-1516257984-b1b4d707412e?auto=format&fit=crop&w=600&q=80"
                            alt="Artigianato Scanno"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>

                    <div class="col-span-8 overflow-hidden rounded-xl shadow-lg h-64 -mt-20 group">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80"
                            alt="Paesaggio Montano"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    </div>
                </div>

                {{-- Blocco Testo descrittivo --}}
                <div class="lg:col-span-6 lg:pl-12 space-y-6 transition-all duration-1000 ease-out"
                    x-data="{ shown: false }" x-intersect:enter="shown = true" x-intersect:leave="shown = false"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Cultura & Sapori</div>
                    <h2 class="text-3xl font-light text-slate-900 leading-tight">Storia Antica, Sapori Autentici</h2>
                    <p class="text-slate-500 font-light leading-relaxed">
                        Esplorare il territorio significa anche perdersi nei vicoli in pietra dei centri storici di Pescasseroli, Castel di Sangro o della vicina Scanno. Scopri le antiche tradizioni dell'artigianato orafo e lasciati conquistare da una cucina ricca di sapori genuini: dai famosi arrosticini ai formaggi pecorini d'alpeggio, fino ai dolci tipici della transumanza.
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-block px-8 py-3 text-sm font-medium tracking-wider text-white bg-slate-900 rounded-full shadow-md hover:bg-slate-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                            Esperienze Gastronomiche
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </div>
</x-layout>
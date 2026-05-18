<x-layout>
    <section class="relative h-screen w-full overflow-hidden flex items-center justify-center">
        <!-- Sfondo con immagine e animazione -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="{{asset('storage/' . $room->images->first()->pathImage)}}"
                alt="Suite Imperiale Vista Interna"
                class="w-full h-full object-cover animate-hero-zoom">
            <!-- Overlay scuro e caldo -->
            <div class="absolute inset-0 bg-black/35 backdrop-blur-[1px]"></div>
        </div>
    </section>

    <!-- 2. TRAFILETTO DESCRITTIVO SINTETICO -->
    <section id="scopri" class="py-16 md:py-24 bg-white border-b border-stone-100 scroll-mt-6">
        <div class="max-w-4xl mx-auto text-center px-6 space-y-4">
            <span class="text-xs uppercase tracking-[0.3em] text-amber-800 font-semibold">Il Risveglio Perfetto</span>
            <h2 class="text-3xl md:text-4xl font-serif text-stone-900 leading-snug">
                Sinfonia di luce, spazio e silenzio sul mare.
            </h2>
            <div class="w-12 h-[1px] bg-amber-800/40 mx-auto my-4"></div>
            <p class="text-stone-600 font-light text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
                Progettata per superare ogni aspettativa, la Suite Imperiale combina arredi sartoriali italiani, tonalità calde e una spettacolare apertura verso l'orizzonte. Un soggiorno che rigenera lo spirito.
            </p>
        </div>
    </section>

    <!-- 3. SLIDER QUASI A TUTTO SCHERMO + TESTO STATICO AFFIANCATO -->
    <section class="py-12 md:py-20 max-w-[95vw] md:max-w-[90vw] mx-auto">
        <div class="grid md:grid-cols-12 gap-8 md:gap-12 items-center">

            <!-- Galleria/Slider Grande (9 Colonne su 12 per essere quasi a tutto schermo) -->
            <div class="col-span-12 md:col-span-9 relative group overflow-hidden shadow-lg aspect-[16/10] md:aspect-[16/9] bg-stone-900">
                @foreach($room->images as $image)
                <!-- Immagine Slider 1 (Attiva di default) -->
                <img id="slide-0" src="{{ asset('storage/' . $image->pathImage)}}"
                    alt="Particolare Letto e Design"
                    class="room-slide absolute inset-0 w-full h-full object-cover opacity-100 slide-fade cursor-zoom-in"
                    onclick="openLightboxFromSlider($loop->index)">

                @endforeach

                <!-- Gradiente scuro di controllo per rendere visibili le frecce su qualsiasi foto -->
                <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

                <!-- Freccia Sinistra -->
                <button id="slider-prev" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/90 text-white hover:text-stone-900 w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center backdrop-blur-sm transition-all shadow-md z-20" aria-label="Immagine precedente">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <!-- Freccia Destra -->
                <button id="slider-next" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/90 text-white hover:text-stone-900 w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center backdrop-blur-sm transition-all shadow-md z-20" aria-label="Immagine successiva">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

                <!-- Indicatore numerico discreto in basso a destra dell'immagine -->
                <div class="absolute bottom-4 right-4 bg-black/50 backdrop-blur-md px-3 py-1 text-xs text-stone-200 tracking-widest uppercase z-20 font-medium">
                    <span id="slider-counter">1 / 4</span>
                </div>
            </div>

            <!-- Testo Descrittivo Affiancato Statico (3 Colonne su 12) -->
            <div class="col-span-12 md:col-span-3 space-y-6 md:pl-2">
                <h3 class="text-2xl md:text-3xl font-serif text-stone-900 tracking-wide leading-tight">
                    Semplicità & Comfort
                </h3>
                <p class="text-stone-600 font-light text-sm md:text-base leading-relaxed">
                    Ogni angolo è pensato per farti sentire come a casa: arredi semplici e funzionali in legno chiaro, finestre luminose che si affacciano sulla tranquillità del borgo, un comodo armadio per i tuoi bagagli e un bagno privato curato, dotato di tutto il necessario per rigenerarsi dopo una giornata di viaggio. </p>
                
                <div class="pt-4">
                    <a href="#contatti" class="inline-block text-center bg-stone-900 text-white px-6 py-3 text-xs font-semibold uppercase tracking-widest hover:bg-amber-800 transition-colors duration-300 shadow">
                        Richiedi Disponibilità
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- 4. OVERLAY LIGHTBOX (Per ingrandimento e scorrimento a schermo intero) -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black/95 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300 ease-in-out">
        <!-- Pulsante di Chiusura in alto a destra -->
        <button id="lightbox-close" class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors p-2 z-50" aria-label="Chiudi galleria">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Pulsante Precedente Lightbox -->
        <button id="lightbox-prev" class="absolute left-4 md:left-8 text-white/70 hover:text-white hover:bg-white/10 p-3 rounded-full transition-all z-50" aria-label="Immagine precedente">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>

        <!-- Pulsante Successivo Lightbox -->
        <button id="lightbox-next" class="absolute right-4 md:right-8 text-white/70 hover:text-white hover:bg-white/10 p-3 rounded-full transition-all z-50" aria-label="Immagine successiva">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        <!-- Immagine Ingrandita -->
        <div class="relative max-w-[90vw] max-h-[80vh] flex items-center justify-center select-none">
            <img id="lightbox-active-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-none shadow-2xl scale-95 transition-transform duration-300 ease-out">
        </div>

        <!-- Didascalia e Contatore del Lightbox -->
        <div class="absolute bottom-6 text-center text-white space-y-1">
            <p id="lightbox-caption" class="font-serif text-lg tracking-wide"></p>
            <p id="lightbox-counter" class="text-xs text-stone-400 tracking-widest uppercase"></p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Logica dello Slider principale (con dissolvenza)
            const slides = document.querySelectorAll('.room-slide');
            const sliderPrev = document.getElementById('slider-prev');
            const sliderNext = document.getElementById('slider-next');
            const sliderCounter = document.getElementById('slider-counter');
            let activeSlideIndex = 0;

            const updateSlider = (newIndex) => {
                // Rimuove visibilità dalla slide corrente
                slides[activeSlideIndex].classList.replace('opacity-100', 'opacity-0');
                slides[activeSlideIndex].classList.add('pointer-events-none');

                // Imposta il nuovo indice
                activeSlideIndex = newIndex;

                // Mostra la nuova slide
                slides[activeSlideIndex].classList.replace('opacity-0', 'opacity-100');
                slides[activeSlideIndex].classList.remove('pointer-events-none');

                // Aggiorna il contatore numerico
                sliderCounter.textContent = `${activeSlideIndex + 1} / ${slides.length}`;
            };

            sliderNext.addEventListener('click', (e) => {
                e.stopPropagation();
                const nextIndex = (activeSlideIndex + 1) % slides.length;
                updateSlider(nextIndex);
            });

            sliderPrev.addEventListener('click', (e) => {
                e.stopPropagation();
                const prevIndex = (activeSlideIndex - 1 + slides.length) % slides.length;
                updateSlider(prevIndex);
            });


            // Logica del Lightbox (Galleria a schermo intero)
            const lightboxModal = document.getElementById('lightbox-modal');
            const lightboxActiveImg = document.getElementById('lightbox-active-img');
            const lightboxCaption = document.getElementById('lightbox-caption');
            const lightboxCounter = document.getElementById('lightbox-counter');

            const closeBtn = document.getElementById('lightbox-close');
            const prevBtn = document.getElementById('lightbox-prev');
            const nextBtn = document.getElementById('lightbox-next');

            let currentLightboxIndex = 0;

            // Funzione per aprire il lightbox richiamato dal click sulla slide principale
            window.openLightboxFromSlider = (index) => {
                currentLightboxIndex = index;
                const selectedImg = slides[currentLightboxIndex];

                lightboxActiveImg.src = selectedImg.src;
                lightboxCaption.textContent = selectedImg.alt || "Dettaglio Suite Imperiale";
                lightboxCounter.textContent = `${currentLightboxIndex + 1} / ${slides.length}`;

                lightboxModal.classList.remove('opacity-0', 'pointer-events-none');
                lightboxModal.classList.add('opacity-100', 'pointer-events-auto');

                setTimeout(() => {
                    lightboxActiveImg.classList.remove('scale-95');
                    lightboxActiveImg.classList.add('scale-100');
                }, 50);
            };

            const closeLightbox = () => {
                lightboxActiveImg.classList.remove('scale-100');
                lightboxActiveImg.classList.add('scale-95');

                lightboxModal.classList.add('opacity-0', 'pointer-events-none');
                lightboxModal.classList.remove('opacity-100', 'pointer-events-auto');
            };

            const showNextLightbox = (e) => {
                if (e) e.stopPropagation();
                let nextIndex = (currentLightboxIndex + 1) % slides.length;
                openLightboxFromSlider(nextIndex);
            };

            const showPrevLightbox = (e) => {
                if (e) e.stopPropagation();
                let prevIndex = (currentLightboxIndex - 1 + slides.length) % slides.length;
                openLightboxFromSlider(prevIndex);
            };

            // Eventi per pulsanti di controllo Lightbox
            closeBtn.addEventListener('click', closeLightbox);
            nextBtn.addEventListener('click', showNextLightbox);
            prevBtn.addEventListener('click', showPrevLightbox);

            // Chiusura cliccando fuori dall'immagine principale
            lightboxModal.addEventListener('click', (e) => {
                if (e.target === lightboxModal || e.target.closest('.relative') === null && e.target !== prevBtn && e.target !== nextBtn) {
                    closeLightbox();
                }
            });

            // Navigazione da tastiera per un'esperienza desktop impeccabile
            document.addEventListener('keydown', (e) => {
                if (lightboxModal.classList.contains('opacity-100')) {
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowRight') showNextLightbox();
                    if (e.key === 'ArrowLeft') showPrevLightbox();
                } else {
                    // Controllo tastiera anche per lo slider principale se non siamo in lightbox
                    if (e.key === 'ArrowRight') sliderNext.click();
                    if (e.key === 'ArrowLeft') sliderPrev.click();
                }
            });
        });
    </script>
</x-layout>
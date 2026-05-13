<x-layout>
    <div class="py-12 bg-base-200 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">

            <div class="card bg-white shadow-2xl">
                <div class="card-body">
                    <h2 class="card-title text-2xl font-bold mb-4">Prenota il tuo soggiorno</h2>
                    <p class="text-gray-500 mb-6">Scegli le date del tuo soggiorno per verificare la disponibilità.</p>

                    <form action="/prenotazione/conferma" method="POST">
                        @csrf

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold text-lg">Seleziona Date</span>
                            </label>
                            <div class="relative">
                                {{-- L'INPUT DEL CALENDARIO --}}
                                <input type="text"
                                    id="booking_range"
                                    name="date_range"
                                    class="input input-bordered w-full pl-12 text-lg"
                                    placeholder="Clicca per scegliere le date..."
                                    readonly>

                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="card-actions justify-end mt-8">
                            <button type="submit" class="btn btn-primary btn-block lg:btn-wide">Verifica Disponibilità</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- 2. LO SCRIPT VA QUI (A fondo pagina) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#booking_range", {
                mode: "range",
                minDate: "today",
                dateFormat: "d-m-Y",
                locale: "it",
                showMonths: 2,
                // Personalizzazione colori per DaisyUI
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.classList.add('shadow-xl', 'border-primary');
                }
            });
        });
    </script>
</x-layout>
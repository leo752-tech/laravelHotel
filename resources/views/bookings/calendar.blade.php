<x-layoutBooking>
    <div class="py-12 bg-base-200 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800">Prenota il tuo Soggiorno</h1>
                <p class="text-gray-500 mt-2">Verifica la disponibilità delle nostre camere in tempo reale</p>
            </div>

            @if(session('specialOfferId'))
            <div class="mb-8 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 via-secondary/10 to-primary/10 animate-pulse"></div>

                <div class="relative border border-primary/20 rounded-2xl p-4 flex flex-col md:flex-row items-center justify-between gap-4 backdrop-blur-sm">
                    <div class="flex items-center gap-4">
                        <div class="bg-primary text-white p-3 rounded-xl shadow-lg shadow-primary/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 20h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                Offerta Speciale Attiva!
                                <span class="badge badge-secondary badge-sm">Esclusiva</span>
                            </h3>
                            <p class="text-sm text-gray-600">
                                Il tuo soggiorno deve durare esattamente <span class="font-black text-primary">{{ session('specialOfferLenght') }} notti</span> per sbloccare lo sconto.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('home') }}" class="btn btn-ghost btn-sm hover:bg-error/10 hover:text-error transition-colors">
                            Annulla offerta
                        </a>
                        <div class="hidden md:block h-8 w-[1px] bg-gray-200 mx-2"></div>
                        <span class="text-xs font-mono font-bold text-primary animate-bounce">
                            Seleziona le date ↓
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <div class="card bg-white shadow-2xl">
                <div class="card-body p-8">

                    <form action="{{ route('search') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">1. Quando vuoi soggiornare?</span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        id="booking_range"
                                        name="date_range"
                                        class="input input-bordered w-full pl-12 text-lg focus:border-primary transition-all"
                                        placeholder="Seleziona Arrivo e Partenza"
                                        readonly>

                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <label class="label">
                                    <span class="label-text-alt text-gray-400 font-mono italic" id="nightCount">Seleziona almeno 2 date</span>
                                </label>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">2. Quanti sarete?</span>
                                </label>
                                <div class="bg-base-100 p-6 rounded-xl border border-base-300">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="flex items-baseline gap-1">
                                            <span id="guestLabel" class="text-5xl font-black text-primary">2</span>
                                            <span class="text-xl font-semibold text-gray-500">Posti</span>
                                        </div>

                                        <input type="range"
                                            name="beds_required"
                                            min="1"
                                            max="6"
                                            value="2"
                                            class="range range-primary"
                                            step="1"
                                            id="guestRange"
                                            oninput="updateGuestDisplay(this.value)" />

                                        <div class="w-full flex justify-between text-xs px-2 font-bold opacity-50">
                                            <span>1</span>
                                            <span>2</span>
                                            <span>3</span>
                                            <span>4</span>
                                            <span>5</span>
                                            <span>6+</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="label">
                                    <span class="label-text-alt text-gray-400 italic">Cercheremo camere con almeno questa capienza</span>
                                </label>
                            </div>

                        </div>

                        <div class="mt-8 p-4 bg-primary/5 rounded-lg border border-primary/10 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-primary text-white rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold">Il tuo preventivo rapido</p>
                                    <p class="text-sm opacity-70">Prezzo basato sulla migliore tariffa disponibile per <span class="res-nights">0</span> notti.</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-10 shadow-lg">Cerca Camere</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div class="p-4">
                    <p class="font-bold">✨ Miglior Prezzo</p>
                    <p class="text-xs opacity-60">Garantito prenotando direttamente</p>
                </div>
                <div class="p-4">
                    <p class="font-bold">🛡️ Pagamento Sicuro</p>
                    <p class="text-xs opacity-60">Sistemi criptati SSL</p>
                </div>
                <div class="p-4">
                    <p class="font-bold">🚀 Conferma Istantanea</p>
                    <p class="text-xs opacity-60">Ricevi subito il voucher via email</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        function updateGuestDisplay(val) {
            document.getElementById('guestLabel').innerText = val;
        }

        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#booking_range", {
                mode: "range",
                minDate: "today",
                dateFormat: "d-m-Y",
                locale: "it",
                showMonths: window.innerWidth > 768 ? 2 : 1, // 2 mesi su desktop, 1 su mobile
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const diffTime = Math.abs(selectedDates[1] - selectedDates[0]);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                        document.getElementById('nightCount').innerText = `Durata soggiorno: ${diffDays} notti`;
                        document.querySelectorAll('.res-nights').forEach(el => el.innerText = diffDays);
                    }
                    
                }
            });
        });
    </script>
</x-layout>
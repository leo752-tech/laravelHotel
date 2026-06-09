<x-layoutBooking title="Prenotazione Confermata - SuiteDirect">

    {{-- Sfondo globale morbido --}}
    <div x-data="{ showDemoModal: false }" class="bg-[#F4F1EE] min-h-screen py-12 flex items-center justify-center px-4 sm:px-6 lg:px-8">

        <div class="max-w-2xl w-full">

            {{-- Card Principale --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden text-center relative">

                {{-- Effetto decorativo in alto --}}
                <div class="h-2 bg-[#00A651] w-full absolute top-0 left-0"></div>

                {{-- Header con Check Verde --}}
                <div class="bg-[#E6F4EA] pt-12 pb-8 px-6">
                    <div class="mx-auto w-24 h-24 bg-[#00A651] rounded-full flex items-center justify-center mb-6 shadow-md border-4 border-white">
                        <i class="fa-solid fa-check text-5xl text-white"></i>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-green-900 mb-2">Prenotazione Confermata!</h1>
                    <p class="text-green-800 text-sm sm:text-base font-medium">Grazie per aver scelto SuiteDirect. Il tuo soggiorno è garantito.</p>
                </div>

                {{-- Dettagli e Messaggio --}}
                <div class="p-8 sm:p-10">

                    {{-- Box Numero Prenotazione --}}
                    <div class="mb-8 p-5 bg-gray-50 rounded-lg border border-gray-200 inline-block min-w-[250px]">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Numero di Prenotazione</p>
                        {{-- Per la demo, puoi generare un ID finto, nella realtà userai $booking->id o simile --}}
                        <p class="text-3xl font-mono font-bold text-[#003366]">#SD-847291</p>
                    </div>

                    <p class="text-gray-600 mb-8 leading-relaxed text-sm sm:text-base">
                        Abbiamo appena inviato un'email di riepilogo all'indirizzo <br class="hidden sm:block">
                        <strong class="text-gray-800">mario.rossi@demo.com</strong> con tutti i dettagli del tuo soggiorno, le condizioni e le istruzioni per il check-in.
                    </p>

                    {{-- Call to Action --}}
                    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-4">
                        <a href="{{ route('home') }}" class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition text-sm text-center">
                            TORNA ALLA HOME
                        </a>
                        {{-- Per la demo questo bottone può non portare a nulla o ricaricare la pagina --}}
                        <a href="#" @click.prevent="showDemoModal = true" class="px-6 py-3.5 bg-[#003366] hover:bg-blue-900 text-white font-bold rounded-lg transition shadow-sm text-sm text-center">
                            GESTISCI PRENOTAZIONE
                        </a>
                    </div>
                </div>

                {{-- Popup esplicativo per l'albergatore --}}
                <div x-show="showDemoModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                    <div @click.away="showDemoModal = false" class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 text-center relative border-t-4 border-[#003366]">
                        <i class="fa-solid fa-sliders text-4xl text-[#003366] mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Area Gestione Cliente</h3>
                        <p class="text-gray-600 text-sm mb-6">
                            In questa sezione l'ospite potrà gestire in totale autonomia il suo soggiorno: effettuare il check-in online, richiedere upgrade di camera, aggiungere servizi extra o cancellare la prenotazione secondo le tue policy.
                        </p>
                        <button @click="showDemoModal = false" class="w-full bg-[#003366] text-white py-2.5 rounded font-bold text-sm hover:bg-blue-900 transition">
                            Ho capito, continua
                        </button>
                    </div>
                </div>

                {{-- Footer Info Reception --}}
                <div class="bg-gray-50 p-5 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 text-sm text-gray-600">
                    <span>Hai domande o richieste particolari?</span>
                    <a href="tel:+39021234567" class="font-bold text-[#003366] flex items-center gap-2 hover:underline">
                        <i class="fa-solid fa-phone"></i> +39 02 1234567
                    </a>
                </div>

            </div>

            {{-- Messaggio extra per la demo per far capire l'utilità al cliente albergatore --}}
            <p class="text-center text-xs text-gray-400 mt-6 flex justify-center items-center gap-2">
                <i class="fa-solid fa-shield-halved"></i> Transazione sicura e verificata
            </p>

        </div>

    </div>
</x-layoutBooking>
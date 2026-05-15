<x-layout>
    <div class="hero min-h-[70vh]" style="background-image: asset('sfondoUp.png');">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold uppercase tracking-widest">Luxury Hotel</h1>
                <p class="mb-5 text-lg italic">Dove l'eleganza incontra il comfort. Vivi un'esperienza indimenticabile nel cuore della città.</p>
                <a href="{{ route('calendar') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary px-8">Prenota Ora</a>
            </div>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800">Perché scegliere noi</h2>
                <div class="divider w-24 mx-auto divider-primary"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="bg-base-200 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Posizione Centrale</h3>
                    <p class="text-gray-500">A pochi passi dai principali monumenti e dai distretti dello shopping più esclusivi.</p>
                </div>
                <div class="text-center">
                    <div class="bg-base-200 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Spa & Benessere</h3>
                    <p class="text-gray-500">Rilassati nella nostra area wellness dotata di sauna, bagno turco e piscina riscaldata.</p>
                </div>
                <div class="text-center">
                    <div class="bg-base-200 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Reception 24/7</h3>
                    <p class="text-gray-500">Il nostro staff è a tua completa disposizione per ogni esigenza, in qualsiasi momento.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-base-200">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-10 text-center">Le Nostre Camere</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($rooms as $room)
                <div class="card bg-white shadow-xl hover:scale-105 transition-transform duration-300">
                    <figure>
                        {{-- Se hai una relazione per le immagini usa quella, altrimenti tieni il placeholder --}}
                        <img src="{{ asset('storage/' . $room->images->first()?->pathImage) }}" alt="{{ $room->name }}" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $room->name }}</h2>
                        <p>{{ Str::limit($room->description, 100) }}</p>
                        <div class="card-actions justify-end mt-4">
                            <div class="badge badge-outline font-bold text-primary">
                                Da € {{ number_format($room->price, 2, ',', '.') }} / notte
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div> {{-- Fine Grid --}}
        </div>
    </div>

    <div class="max-w-4xl mx-auto my-10 p-6 bg-white shadow-xl rounded-2xl border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Listino Prezzi Stagionale</h2>
            <p class="text-gray-500">Tariffe giornaliere per tipologia di camera</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-sm tracking-wider">
                        <th class="px-6 py-4 font-semibold border-b">Camera</th>
                        <th class="px-6 py-4 font-semibold border-b">Bassa Stagione</th>
                        <th class="px-6 py-4 font-semibold border-b bg-blue-50 text-blue-700">Alta Stagione (+50%)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($rooms as $room)
                    <tr>
                        <td class="px-6 py-4">{{ $room->name }}</td>
                        <td class="px-6 py-4">€ {{ number_format($room->price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 font-bold text-blue-600 bg-blue-50/30">
                            {{-- Calcolo automatico del +50% --}}
                            € {{ number_format($room->price * 1.5, 2, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-4 bg-amber-50 rounded-lg flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm text-amber-800">
                <strong>Nota:</strong> L'alta stagione include i mesi di Agosto, Dicembre, Gennaio e Febbraio.
            </p>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-12 italic text-primary">"Cosa dicono i nostri ospiti"</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <blockquote class="bg-base-100 p-8 rounded-2xl shadow-inner relative">
                    <p class="text-gray-600 italic">"Un soggiorno magico. La cura dei dettagli e la cortesia del personale sono state impeccabili. Tornerò sicuramente!"</p>
                    <cite class="block mt-4 font-bold text-gray-800">- Marco G.</cite>
                </blockquote>
                <blockquote class="bg-base-100 p-8 rounded-2xl shadow-inner relative">
                    <p class="text-gray-600 italic">"La spa è un piccolo paradiso nel centro città. Colazione a buffet tra le migliori mai provate in un hotel."</p>
                    <cite class="block mt-4 font-bold text-gray-800">- Elena V.</cite>
                </blockquote>
            </div>
        </div>
    </div>

</x-layout>
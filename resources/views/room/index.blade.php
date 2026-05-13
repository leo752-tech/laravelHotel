<x-layout>
    <div class="bg-primary py-16 text-white text-center">
        <h1 class="text-4xl font-bold uppercase tracking-widest mb-4">Le Nostre Esclusive Camere</h1>
        <p class="opacity-90 max-w-2xl mx-auto italic">Dal comfort essenziale della Business Single all'eleganza senza tempo delle nostre Suite. Scegli il tuo rifugio ideale.</p>
    </div>

    <div class="bg-base-200 border-b border-base-300 py-4 sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <span class="text-sm font-medium">{{ $rooms->count() }} soluzioni trovate</span>
            <div class="flex gap-2">
                <a href="{{ route('calendar') }}" class="btn btn-sm btn-outline btn-primary">Controlla disponibilità</a>
            </div>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                @foreach($rooms as $room)
                <div class="group card bg-base-100 shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500">
                    <figure class="relative h-64 overflow-hidden">
                        <img src="{{ $room->images->first()->path ?? 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=800&q=80' }}"
                            alt="{{ $room->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />

                        <div class="absolute top-4 right-4">
                            <div class="badge badge-primary font-bold p-4 shadow-lg">
                                Da € {{ number_format($room->price, 0) }} / notte
                            </div>
                        </div>
                    </figure>

                    <div class="card-body">
                        <div class="flex justify-between items-start">
                            <h2 class="card-title text-2xl font-serif text-gray-800">{{ $room->name }}</h2>
                            <div class="flex items-center gap-1 text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-bold">5.0</span>
                            </div>
                        </div>

                        <p class="text-gray-500 text-sm mt-2 leading-relaxed">
                            {{ Str::limit($room->description, 120) }}
                        </p>

                        <div class="flex gap-4 my-4 text-gray-400 border-y border-gray-100 py-3">
                            <span title="Wi-Fi Gratuito"><i class="fas fa-wifi"></i></span>
                            <span title="Aria Condizionata"><i class="fas fa-snowflake"></i></span>
                            <span title="Smart TV"><i class="fas fa-tv"></i></span>
                            <span title="Minibar"><i class="fas fa-glass-martini-alt"></i></span>
                            <span class="text-xs font-semibold ml-auto text-gray-400 uppercase tracking-tighter">{{ $room->beds }} Posti Letto</span>
                        </div>

                        <div class="card-actions justify-between items-center mt-2">
                            <a href="{{ route('detailRoomGuest', $room->id) }}" class="text-sm font-bold text-primary hover:underline transition-all">Dettagli camera</a>
                            <a href="{{ route('calendar', ['room_id' => $room->id]) }}" class="btn btn-primary btn-sm px-6">Prenota</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="bg-base-200 py-12">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h3 class="text-xl font-bold mb-4">Tutte le camere includono</h3>
            <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                <span>✓ Colazione inclusa</span>
                <span>✓ Set di cortesia Premium</span>
                <span>✓ Cancellazione gratuita (fino a 48h)</span>
                <span>✓ Check-out posticipato su richiesta</span>
            </div>
        </div>
    </div>
</x-layout>
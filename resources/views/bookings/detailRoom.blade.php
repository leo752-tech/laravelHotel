<x-layout>
    <div class="py-12 bg-base-200 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <div class="text-sm breadcrumbs mb-6">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/calendar">Ricerca</a></li>
                    <li class="text-primary font-bold">{{ $room->name }}</li>
                </ul>
            </div>

            <form action="{{ route('checkOut') }}" method="GET">
                {{-- Input nascosti per trasportare i dati della camera al checkout --}}
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="check_in" value="{{ $checkIn->format('Y-m-d') }}">
                <input type="hidden" name="check_out" value="{{ $checkOut->format('Y-m-d') }}">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">

                        <div class="card bg-white shadow-xl overflow-hidden">
                            <div class="carousel w-full h-[400px]">
                                @forelse($room->images as $index => $image)
                                <div id="slide{{ $index }}" class="carousel-item relative w-full">
                                    <img src="{{ asset('storage/' . $image->pathImage) }}" class="w-full object-cover" />
                                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                        <a href="#slide{{ $index - 1 }}" class="btn btn-circle btn-ghost text-white bg-black/20">❮</a>
                                        <a href="#slide{{ $index + 1 }}" class="btn btn-circle btn-ghost text-white bg-black/20">❯</a>
                                    </div>
                                </div>
                                @empty
                                <div class="flex items-center justify-center w-full bg-gray-200 text-gray-400">
                                    Nessuna immagine disponibile
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h1 class="text-3xl font-bold text-gray-800">{{ $room->name }}</h1>
                                <div class="flex gap-2 my-2">
                                    <div class="badge badge-secondary">{{ $room->type }}</div>
                                    <div class="badge badge-outline">{{ $room->beds }} Posti Letto</div>
                                </div>

                                <div class="divider"></div>
                                <h2 class="text-xl font-bold mb-2 text-primary">Descrizione</h2>
                                <p class="text-gray-600 leading-relaxed">{{ $room->description }}</p>

                                <div class="divider"></div>
                                <h2 class="text-xl font-bold mb-4">Servizi Inclusi</h2>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div class="flex items-center gap-2 text-sm"><span class="text-success">✔</span> Wi-Fi Alta Velocità</div>
                                    <div class="flex items-center gap-2 text-sm"><span class="text-success">✔</span> Aria Condizionata</div>
                                    <div class="flex items-center gap-2 text-sm"><span class="text-success">✔</span> Minibar</div>
                                    <div class="flex items-center gap-2 text-sm"><span class="text-success">✔</span> TV Satellitare</div>
                                    <div class="flex items-center gap-2 text-sm"><span class="text-success">✔</span> Cassaforte</div>
                                    <div class="flex items-center gap-2 text-sm"><span class="text-success">✔</span> Set Cortesia</div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h2 class="text-2xl font-bold mb-1">Personalizza il tuo soggiorno</h2>
                                <p class="text-sm text-gray-500 mb-6">Seleziona i servizi extra che desideri aggiungere alla tua prenotazione.</p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($services as $service)
                                    <label class="flex items-center p-4 border rounded-xl hover:border-primary transition-all group cursor-pointer bg-base-100 shadow-sm">
                                        <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border border-base-300">
                                            <img src="{{ asset('storage/' . $service->pathImage) }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                        </div>

                                        <div class="flex-grow ml-4">
                                            <h3 class="font-bold text-sm">{{ $service->name }}</h3>
                                            <p class="text-xs text-gray-400 line-clamp-2">{{ $service->description }}</p>
                                            <p class="text-primary font-bold text-sm mt-1">€{{ number_format($service->price, 2) }}</p>
                                        </div>

                                        <div class="form-control ml-2">
                                            <input type="checkbox"
                                                name="extras[]"
                                                value="{{ $service->id }}"
                                                class="checkbox checkbox-primary checkbox-lg"
                                                data-price="{{ $service->price }}"
                                                onchange="updateTotalWithExtras()" />
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="card bg-white shadow-2xl sticky top-8 border border-base-300">
                            <div class="card-body">
                                <h2 class="card-title text-xl mb-4 border-b pb-2">Riepilogo Soggiorno</h2>

                                <div class="bg-base-200 p-4 rounded-xl space-y-3 mb-6">
                                    <div class="flex justify-between text-sm">
                                        <span class="opacity-70">Check-in:</span>
                                        <span class="font-bold">{{ $checkIn->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="opacity-70">Check-out:</span>
                                        <span class="font-bold">{{ $checkOut->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm border-t border-base-300 pt-2 font-semibold">
                                        <span>Durata:</span>
                                        <span class="text-primary">{{ $nights }} Notti</span>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Soggiorno base:</span>
                                        <span class="font-medium">€{{ number_format($totalPrice, 2, ',', '.') }}</span>
                                    </div>

                                    <div id="extraRow" class="flex justify-between items-center text-sm text-secondary hidden animate-fade-in">
                                        <span>Servizi Extra:</span>
                                        <span class="font-medium" id="extraAmount">+ €0,00</span>
                                    </div>

                                    <div class="divider my-1"></div>

                                    <div class="flex justify-between items-end mt-4">
                                        <div>
                                            <p class="text-xs uppercase tracking-widest opacity-50 font-bold">Totale Finale</p>
                                            <p class="text-3xl font-black text-primary" id="finalDisplayPrice">€{{ number_format($totalPrice, 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg group">
                                    Procedi al Pagamento
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>

                                <p class="text-[10px] text-center mt-4 opacity-50 uppercase tracking-tighter">
                                    Cancellazione gratuita entro 48 ore dall'arrivo
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateTotalWithExtras() {
            const basePrice = {{ $totalPrice }};
            let extrasTotal = 0;

            // Seleziona tutti i checkbox degli extra spuntati
            const checkedExtras = document.querySelectorAll('input[name="extras[]"]:checked');

            checkedExtras.forEach(checkbox => {
                extrasTotal += parseFloat(checkbox.getAttribute('data-price'));
            });

            const finalTotal = basePrice + extrasTotal;
            const extraRow = document.getElementById('extraRow');
            const extraAmount = document.getElementById('extraAmount');
            const finalDisplayPrice = document.getElementById('finalDisplayPrice');

            // Gestione visibilità riga extra
            if (extrasTotal > 0) {
                extraRow.classList.remove('hidden');
                extraAmount.innerText = `+ €${extrasTotal.toLocaleString('it-IT', {minimumFractionDigits: 2})}`;
            } else {
                extraRow.classList.add('hidden');
            }

            // Aggiorna il prezzo totale finale con animazione semplice
            finalDisplayPrice.innerText = `€${finalTotal.toLocaleString('it-IT', {minimumFractionDigits: 2})}`;
        }
    </script>
</x-layout>
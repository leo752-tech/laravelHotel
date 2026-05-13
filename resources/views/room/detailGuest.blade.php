<x-layout>
    <div class="py-12 bg-base-200 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <div class="text-sm breadcrumbs mb-6">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/camere">Le Nostre Camere</a></li>
                    <li class="text-primary font-bold">{{ $room->name }}</li>
                </ul>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="card bg-white shadow-xl overflow-hidden">
                        <div class="carousel w-full h-[450px]">
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
                                <div class="badge badge-primary">Da €{{ number_format($room->price, 2, ',', '.') }} / Notte</div>
                            </div>

                            <div class="divider"></div>

                            <h2 class="text-xl font-bold mb-2 text-primary">Esperienza e Comfort</h2>
                            <p class="text-gray-600 leading-relaxed text-lg">{{ $room->description }}</p>

                            <div class="divider"></div>

                            <h2 class="text-xl font-bold mb-4">Servizi in Camera</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4">
                                <div class="flex items-center gap-2 text-sm"><span class="text-success text-xl">✔</span> Wi-Fi Alta Velocità</div>
                                <div class="flex items-center gap-2 text-sm"><span class="text-success text-xl">✔</span> Aria Condizionata</div>
                                <div class="flex items-center gap-2 text-sm"><span class="text-success text-xl">✔</span> Minibar Premium</div>
                                <div class="flex items-center gap-2 text-sm"><span class="text-success text-xl">✔</span> Smart TV 4K</div>
                                <div class="flex items-center gap-2 text-sm"><span class="text-success text-xl">✔</span> Cassaforte Digitale</div>
                                <div class="flex items-center gap-2 text-sm"><span class="text-success text-xl">✔</span> Set Cortesia Bio</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="space-y-6 sticky top-8">

                        <div class="card bg-white shadow-2xl border border-primary/20">
                            <div class="card-body">
                                <h2 class="card-title text-xl mb-2">Ti piace questa camera?</h2>
                                <p class="text-sm text-gray-500 mb-6">Controlla la disponibilità in tempo reale e assicurati la miglior tariffa garantita.</p>

                                <a href="{{ route('calendar') }}" class="btn btn-primary btn-block group">
                                    Verifica Disponibilità
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
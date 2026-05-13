<x-layout>
    <div class="py-12 bg-base-200 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-800 italic">I Nostri Servizi Esclusivi</h1>
                <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg">
                    Rendi il tuo soggiorno indimenticabile aggiungendo i nostri servizi premium pensati per ogni tua esigenza.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-all duration-300 group">
                    <figure class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $service->pathImage) }}"
                         
                            class="h-64 w-full object-cover group-hover:scale-110 transition-transform duration-500" />

                        <div class="absolute top-4 right-4">
                            <div class="badge badge-primary badge-lg p-4 font-bold shadow-lg">
                                € {{ number_format($service->price, 2, ',', '.') }}
                            </div>
                        </div>
                    </figure>

                    <div class="card-body p-6">
                        <h2 class="card-title text-2xl font-bold text-gray-800">
                            {{ $service->name }}
                        </h2>

                        <p class="text-gray-600 leading-relaxed mt-2 italic">
                            {{ $service->description }}
                        </p>

                        <div class="flex items-center gap-4 mt-6 text-xs font-semibold text-gray-400 uppercase tracking-widest">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Disponibile
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-info" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Info in Hotel
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($services->isEmpty())
                <div class="col-span-full bg-white p-12 rounded-2xl text-center shadow-inner border border-base-300">
                    <div class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 012-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <p class="text-xl text-gray-400 font-medium">Stiamo preparando nuovi servizi per te. Torna a trovarci!</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
<x-layout title="Offerte Speciali">
    <div class="container mx-auto p-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-secondary">Offerte Imperdibili</h1>
            <p class="text-gray-500 mt-2">Prenota ora e risparmia sul tuo prossimo soggiorno</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($specialOffers as $offer)
            <div class="card lg:card-side bg-base-100 shadow-2xl border border-secondary/20 hover:scale-[1.02] transition-transform duration-300">
                <figure class="bg-secondary text-secondary-content p-8 flex flex-col justify-center items-center min-w-[200px]">
                    <span class="text-5xl font-bold">{{ $offer->lenght }}</span>
                    <span class="text-xl uppercase tracking-widest">Notti</span>
                </figure>

                <div class="card-body">
                    <div class="flex justify-between items-start">
                        <h2 class="card-title text-2xl">{{ $offer->title }}</h2>
                    </div>

                    <p class="text-gray-600 mt-2">{{ $offer->description }}</p>

                    <div class="card-actions justify-between items-center mt-6">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-400 uppercase">Sconto Straordinario</span>
                            <span class="text-3xl font-bold text-success">{{ ($offer->specialPrice * 100) }}%</span>
                        </div>
                        <a href="{{ route('calendarOffer', $offer->id) }}" class="btn btn-secondary">Prenota Ora</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>
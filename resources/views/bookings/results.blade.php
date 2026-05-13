<x-layout>
    <div class="py-12 bg-base-200">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6">Camere disponibili per {{ $nights }} notti</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">  
                @forelse($rooms as $room)
                <div class="card bg-white shadow-xl overflow-hidden">
                    <figure class="h-48">
                        <img src="{{ asset('storage/' . $room->images->first()?->pathImage) }}" alt="{{ $room->name }}" class="object-cover w-full h-full" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $room->name }}</h2>
                        <p class="text-sm opacity-60">{{ Str::limit($room->description, 100) }}</p>

                        <div class="flex justify-between items-center mt-4">
                            <span class="text-2xl font-bold text-primary">€{{ ($room->price * $nights) * (1 - ($discount ?? 0)) }}</span>
                            <div class="badge badge-outline">{{ $room->beds }} Posti Letto</div>
                        </div>

                        <div class="card-actions justify-end mt-4">
                            <a href="{{ route('detailRoom', $room->id) }}" class="btn btn-primary">
                                Prenota Ora
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full alert alert-warning">
                    <span>Nessuna camera disponibile per le date e i posti selezionati. Prova a cambiare periodo!</span>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
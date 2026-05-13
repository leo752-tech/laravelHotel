<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">Gestione Camere</h1>
                <p class="text-sm text-gray-500">Visualizza e gestisci le camere dell'hotel</p>
            </div>
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Aggiungi Camera
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success shadow-lg mb-6">
            <span>{{ session('success') }}</span>
        </div>
        @endif
        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="table table-zebra w-full">
                <thead class="bg-neutral text-neutral-content">
                    <tr>
                        <th>Immagine</th>
                        <th>Nome / Tipo</th>
                        <th>Posti Letto</th>
                        <th>Prezzo</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr class="hover">
                        <td>
                            <div class="avatar">
                                <div class="mask mask-squircle w-16 h-16">
                                    {{-- Prende la prima immagine come copertina, altrimenti placeholder --}}
                                    @if($room->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $room->images->first()->pathImage) }}" alt="{{ $room->name }}" />
                                    @else
                                    <img src="https://ui-avatars.com/api/?name=No+Image&background=ccc&color=fff" alt="No Image" />
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="font-bold text-lg">{{ $room->name }}</div>
                                <div class="badge badge-ghost badge-sm italic">{{ $room->type }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">{{ $room->beds }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        </td>
                        <td>
                            <span class="text-success font-bold">€{{ number_format($room->price, 2, ',', '.') }}</span>
                            <span class="text-xs opacity-50">/notte</span>
                        </td>
                        <th class="space-x-2">
                            <div class="join">
                                <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-ghost btn-xs join-item border border-base-300">Modifica</a>

                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questa camera?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-xs join-item border border-base-300 text-error">Elimina</button>
                                </form>
                            </div>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($rooms->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-400">Nessuna camera registrata nel sistema.</p>
            </div>
            @endif
        </div>
    </div>
</x-layoutAdmin>
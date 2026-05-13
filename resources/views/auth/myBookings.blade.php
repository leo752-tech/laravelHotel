<x-layout>

    <div class="max-w-6xl mx-auto p-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold">Le mie Prenotazioni</h1>
                <p class="text-base-content/60">Gestisci i tuoi soggiorni e visualizza i dettagli delle tue prenotazioni.</p>
            </div>
            <a href="/calendar" class="btn btn-primary">
                Nuova Prenotazione
            </a>
        </div>

        @if($bookings->isEmpty())
        <div class="card bg-base-100 shadow-xl border border-base-200 p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="p-4 bg-base-200 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold">Non hai ancora prenotato nulla</h2>
            <p class="mt-2 text-base-content/60">I tuoi futuri viaggi appariranno qui.</p>
        </div>
        @else
        <div class="grid grid-cols-1 gap-6">
            @foreach($bookings as $booking)
            <div class="card card-side bg-base-100 shadow-md border border-base-200 overflow-hidden hover:shadow-lg transition-shadow">
                <figure class="hidden md:block w-72">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=400&q=80" alt="Stanza" class="h-full object-cover" />
                </figure>

                <div class="card-body">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="card-title text-xl">Camera #{{ $booking->roomId }}</h2>
                            <p class="text-sm text-base-content/60 italic">Codice Prenotazione: #{{ $booking->id }}</p>
                        </div>
                        <div class="badge @if($booking->status == 'confirmed') badge-success @elseif($booking->status == 'pending') badge-warning @else badge-ghost @endif p-3">
                            {{ ucfirst($booking->status) }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-4 p-4 bg-base-200/50 rounded-xl">
                        <div>
                            <span class="block text-xs uppercase font-semibold opacity-50">Check-in</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($booking->checkInDate)->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase font-semibold opacity-50">Check-out</span>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($booking->checkOutDate)->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase font-semibold opacity-50">Totale</span>
                            <span class="font-bold text-primary">{{ $booking->totalPrice }}€</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase font-semibold opacity-50">Offerta Speciale</span>
                            <span class="text-sm">{{ $booking->specialOfferId ? 'Applicata' : 'Nessuna' }}</span>
                        </div>
                    </div>

                    @if($booking->status!='cancelled' && $booking->status!='checkedIn')
                    <div class="card-actions justify-end mt-2">
                        <form action="{{ route('deleteBooking', $booking->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error btn-outline btn-sm">
                                Elimina
                            </button>
                        </form>
                    </div>
                    @endif
                    <div class="card-actions justify-end mt-2 gap-2">
                        {{-- Controlla che sia effettuato il check-in E che non esista già una recensione --}}
                        @if($booking->status == 'checkedIn' && !$booking->review)
                        <a href="{{ route('createReview', ['bookingId' => $booking->id]) }}" class="btn btn-outline btn-sm btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Recensisci
                        </a>
                        @elseif($booking->review)
                        <span class="badge badge-ghost">Già recensito</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <div class="mt-8 text-center">
            <a href="/profile" class="btn btn-ghost btn-sm"> Torna al Profilo</a>
        </div>
    </div>
</x-layout>
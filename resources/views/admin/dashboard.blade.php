<x-layoutAdmin>
    <div class="p-6 bg-base-100 min-h-screen">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Dashboard Amministrativa</h1>
                <p class="text-base-content/60">Bentornato, ecco cosa succede nel tuo hotel oggi.</p>
            </div>
            <div class="text-sm breadcrumbs">
                <ul>
                    <li>Admin</li>
                    <li>Dashboard</li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stats shadow bg-primary text-primary-content">
                <div class="stat">
                    <div class="stat-title text-primary-content/60">Nuove Prenotazioni</div>
                    <div class="stat-value">{{ $newBookingsCount }}</div>
                    <div class="stat-desc text-primary-content/60">Nelle ultime 24 ore</div>
                </div>
            </div>

            <div class="stats shadow bg-success text-success-content">
                <div class="stat">
                    <div class="stat-title text-success-content/60">Incassi Mese</div>
                    <div class="stat-value">€ {{ number_format($monthlyEarnings, 2, ',', '.') }}</div>
                </div>
            </div>

            <div class="stats shadow bg-neutral text-neutral-content">
                <div class="stat">
                    <div class="stat-title text-neutral-content/60">Occupazione Camere</div>
                    <div class="stat-value">{{ $occupancyRate }}%</div>
                    <div class="stat-desc text-neutral-content/60">{{ $occupiedRooms }} camere su {{ $totalRooms }}</div>
                </div>
            </div>

            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Media Recensioni</div>
                    <div class="stat-value text-warning">{{ number_format($averageRating, 1) }}</div>
                    <div class="stat-desc">Basato su {{ $reviewsCount }} voti</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title mb-4">Ultime Prenotazioni Ricevute</h2>
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Ospite</th>
                                    <th>Stanza</th>
                                    <th>Check-in</th>
                                    <th>Stato</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="font-bold">{{ $booking->user->name }}</div>
                                        <div class="text-sm opacity-50">{{ $booking->user->email }}</div>
                                    </td>
                                    <td>{{ $booking->room->name }}</td>
                                    <td>{{ $booking->checkInDate->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-success">{{$booking->status}}</span>
                                        
                                    </td>
                                    <th>
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-ghost btn-xs">dettagli</a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <a href="/admin/bookings" class="btn btn-sm btn-link text-primary">Vedi tutte le prenotazioni</a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title">Azioni Rapide</h2>
                        <div class="flex flex-col gap-2 mt-4">

                            <a class="btn btn-primary btn-outline" href="{{ route('admin.rooms.create') }}">Aggiungi Nuova Camera</a>

                            <button href="{{ route('admin.specialOffers.create') }}" class="btn btn-secondary btn-outline">Crea Offerta Speciale</button>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</x-layoutAdmin>
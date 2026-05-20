<x-layoutAdmin>
    <div class="p-6 bg-base-100 min-h-screen" x-data="{ view: '{{ $view }}' }">

        <!-- INTESTAZIONE AGGIORNATA CON PULSANTE NUOVA PRENOTAZIONE -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 pb-4 border-b border-base-200">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Gestione Prenotazioni</h1>
                <p class="text-base-content/60 text-sm mt-1" x-show="view === 'list'">Lista dettagliata di tutte le prenotazioni ({{ $bookings->count() }})</p>
                <p class="text-base-content/60 text-sm mt-1" x-show="view === 'calendar'">Panoramica delle occupazioni per camera</p>
            </div>

            <!-- Gruppo Azioni Destra (Filtro Vista + Bottone Crea) -->
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-end">
                <div class="join border border-base-300 shadow-sm bg-base-100">
                    <button @click="view = 'list'" :class="view === 'list' ? 'btn-primary' : 'btn-ghost'" class="btn btn-sm join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Lista
                    </button>
                    <button @click="view = 'calendar'" :class="view === 'calendar' ? 'btn-primary' : 'btn-ghost'" class="btn btn-sm join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Calendario
                    </button>
                </div>

                
            </div>
        </div>

        {{-- Filtri (Logica da implementare con query strings o Livewire) --}}
        <form action="/admin/bookings" method="GET" class="bg-base-200 p-4 rounded-xl mb-6 flex flex-wrap gap-4 items-end">
            <div class="form-control w-full max-w-xs">
                <label class="label"><span class="label-text text-xs font-bold uppercase">Cerca Ospite</span></label>
                <input type="text" name="search" placeholder="Nome o Email..." class="input input-bordered input-sm w-full" value="{{ request('search') }}" />
            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label"><span class="label-text text-xs font-bold uppercase">Stato</span></label>
                <select name="status" class="select select-bordered select-sm">
                    <option value="">Tutti</option>
                    <option value="confirmed">Confermate</option>
                    <option value="pending">In attesa</option>
                    <option value="cancelled">Cancellate</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-neutral">Filtra Risultati</button>
        </form>

        {{-- VIEW: LISTA --}}
        <div x-show="view === 'list'" x-transition class="card bg-base-100 shadow-xl border border-base-200">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr class="bg-base-200">
                            <th>ID</th>
                            <th>Ospite</th>
                            <th>Camera</th>
                            <th>Soggiorno</th>
                            <th>Prezzo</th>
                            <th>Stato</th>
                            <th class="text-right">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td class="font-mono text-xs">#BK-{{ $booking->id }}</td>
                            <td>
                                <div class="font-bold">{{ $booking->user->firstName }} {{ $booking->user->lastName }}</div>
                                <div class="text-xs opacity-50">{{ $booking->user->email }}</div>
                            </td>
                            <td>
                                <div class="badge badge-outline">{{ $booking->room->room_number }} - {{ $booking->room->type }}</div>
                            </td>
                            <td>
                                <div class="text-sm">
                                    {{ \Carbon\Carbon::parse($booking->checkInDate)->format('d M') }} -
                                    {{ \Carbon\Carbon::parse($booking->checkOutDate)->format('d M') }}
                                </div>
                                <div class="text-xs text-primary font-semibold">
                                    {{ \Carbon\Carbon::parse($booking->checkInDate)->diffInDays($booking->checkOutDate) }} Notti
                                </div>
                            </td>
                            <td class="font-bold">€ {{ number_format($booking->totalPrice, 2, ',', '.') }}</td>
                            <td>
                                @php
                                $statusClasses = [
                                'confirmed' => 'badge-success',
                                'pending' => 'badge-warning',
                                'cancelled' => 'badge-error',
                                ];
                                @endphp
                                <span class="badge {{ $statusClasses[$booking->status] ?? 'badge-ghost' }} badge-sm uppercase">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="text-right">
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                    onsubmit="return confirm('Sei sicuro di voler cancellare questa prenotazione?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-xs text-error gap-2 hover:bg-error/10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Cancella
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        {{-- VIEW: CALENDARIO PROFESSIONALE --}}
        <div x-show="view === 'calendar'" x-transition>
            <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <h2 class="text-xl font-bold">Planning</h2>
                    <span class="badge badge-outline opacity-70">
                        {{ $days[0]->translatedFormat('d M') }} — {{ end($days)->translatedFormat('d M Y') }}
                    </span>
                </div>

                <div class="join shadow-sm border border-base-300">
                    <a href="{{ route('admin.bookings.index', ['start_date' => now()->format('Y-m-d'), 'view' => 'calendar']) }}"
                        class="join-item btn btn-sm btn-white">Oggi</a>

                    <a href="{{ route('admin.bookings.index', ['start_date' => $currentStart->copy()->subDays(7)->format('Y-m-d'), 'view' => 'calendar']) }}"
                        class="join-item btn btn-sm btn-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        7gg
                    </a>

                    <a href="{{ route('admin.bookings.index', ['start_date' => $currentStart->copy()->addDays(7)->format('Y-m-d'), 'view' => 'calendar']) }}"
                        class="join-item btn btn-sm btn-white">
                        7gg
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card bg-base-100 shadow-2xl border border-base-300">
                <div class="p-4 bg-base-200 flex justify-between items-center border-b border-base-300">
                    <h2 class="font-black text-secondary tracking-tighter">PLANNING OCCUPAZIONE</h2>
                    <div class="flex gap-4 text-[10px] uppercase">
                        <span class="flex items-center gap-1">
                            <div class="w-3 h-3 bg-info rounded-full"></div> Confermato
                        </span>
                        <span class="flex items-center gap-1">
                            <div class="w-3 h-3 bg-success rounded-full"></div> In Casa
                        </span>
                        <span class="flex items-center gap-1">
                            <div class="w-3 h-3 bg-base-300 rounded-full"></div> Libero
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="sticky left-0 z-20 bg-base-200 p-4 border-r border-b border-base-300 w-48 text-left text-xs uppercase">Camera</th>
                                @foreach($days as $day)
                                <th class="p-2 border-b border-r border-base-300 min-w-[100px] bg-base-100 {{ $day->isWeekend() ? 'bg-base-200' : '' }}">
                                    <span class="text-[10px] block opacity-50">{{ $day->translatedFormat('D') }}</span>
                                    <span class="text-lg font-bold">{{ $day->format('d') }}</span>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr class="h-16 hover:bg-base-200/50 transition-colors">
                                <td class="sticky left-0 z-20 bg-base-100 border-r border-b border-base-300 p-3 shadow-md">
                                    <div class="font-bold text-sm leading-none">{{ $room->room_number }}</div>
                                    <div class="text-[10px] opacity-60 uppercase mt-1">{{ $room->type }}</div>
                                </td>

                                @foreach($days as $day)
                                <!-- Aggiunto p-0 per permettere al link interno di occupare tutto lo spazio -->
                                <td class="border-r border-b border-base-200 relative p-0 group">
                                    @php
                                    $booking = $room->bookings->first(function($b) use ($day) {
                                    return $day->between($b->checkInDate, \Carbon\Carbon::parse($b->checkOutDate)->subDay());
                                    });
                                    @endphp

                                    @if($booking)
                                    @php
                                    $isStart = \Carbon\Carbon::parse($booking->checkInDate)->isSameDay($day);
                                    $statusColor = $booking->status === 'checkedIn' ? 'bg-success' : 'bg-info';
                                    @endphp

                                    <div class="absolute inset-y-2 left-0 right-0 {{ $statusColor }} shadow-lg {{ $isStart ? 'rounded-l-lg ml-1' : '' }} flex items-center px-2 overflow-hidden z-10 cursor-pointer hover:brightness-110 transition-all"
                                        x-data
                                        @click="$dispatch('open-booking-modal', { 
                                            id: '{{ $booking->id }}', 
                                            guest_name: '{{ $booking->user->firstName }} {{ $booking->user->lastName }}',
                                            check_in: '{{ $booking->checkInDate }}',
                                            check_out: '{{ $booking->checkOutDate }}',
                                            room_id: '{{ $booking->roomId }}',
                                            total_price: {{ $booking->totalPrice }},
                                            status: '{{ $booking->status }}',
                                            special_offer: '{{ $booking->specialOfferId ?? 'Nessuna' }}'
                                        })">

                                        @if($isStart)
                                        <span class="text-[10px] font-black text-white truncate uppercase whitespace-nowrap">
                                            {{ $booking->user->firstName }} {{ $booking->user->lastName }}
                                        </span>
                                        @endif
                                    </div>
                                    @else
                                    {{-- CELLA VUOTA: Interamente cliccabile --}}
                                    <a href="{{ route('admin.newBooking', ['roomId' => $room->id, 'checkInDate' => $day->format('Y-m-d')]) }}"
                                        class="absolute inset-0 flex items-center justify-center bg-transparent hover:bg-base-300/50 transition-colors cursor-pointer group-hover:opacity-100 opacity-0 z-0"
                                        title="Aggiungi prenotazione per {{ $day->format('d/m/Y') }}">
                                        <!-- Icona Più -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </a>
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL INTERATTIVO DI VISUALIZZAZIONE (Alpine.js) --}}
    <div x-data="{ open: false, booking: {} }"
        @open-booking-modal.window="open = true; booking = $event.detail"
        class="relative z-50"
        x-show="open"
        style="display: none;">

        <div x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    @click.away="open = false"
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md p-6">

                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Dettaglio Prenotazione</h3>
                            <p class="text-xs text-gray-500">ID Prenotazione: #<span x-text="booking.id"></span></p>
                        </div>
                        <button @click="open = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            ✕
                        </button>
                    </div>

                    <div class="mt-4 space-y-4 text-sm">
                        <div>
                            <span class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Ospite principale</span>
                            <p class="mt-0.5 font-medium text-gray-900" x-text="booking.guest_name"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 bg-gray-50 p-3 rounded-lg">
                            <div>
                                <span class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Arrivo (Check-in)</span>
                                <p class="mt-0.5 font-medium text-gray-900" x-text="booking.check_in"></p>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Partenza (Check-out)</span>
                                <p class="mt-0.5 font-medium text-gray-900" x-text="booking.check_out"></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Camera</span>
                                <p class="mt-0.5 font-medium text-gray-900">Stanza #<span x-text="booking.room_id"></span></p>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Stato</span>
                                <span class="inline-flex items-center rounded-md px-2 py-1 mt-1 text-xs font-medium uppercase tracking-wide border"
                                    :class="{
                                      'bg-yellow-50 text-yellow-800 border-yellow-200': booking.status === 'pending',
                                      'bg-green-50 text-green-800 border-green-200': booking.status === 'confirmed',
                                      'bg-red-50 text-red-800 border-red-200': booking.status === 'cancelled'
                                  }"
                                    x-text="booking.status">
                                </span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 my-2"></div>

                        <div>
                            <span class="block text-xs font-semibold uppercase tracking-wider text-gray-400">Offerta Applicata</span>
                            <p class="mt-0.5 text-gray-900" :class="booking.special_offer === 'Nessuna' ? 'text-gray-400 italic' : 'font-medium'" x-text="booking.special_offer"></p>
                        </div>

                        <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-lg flex justify-between items-center">
                            <span class="text-xs font-bold uppercase tracking-wider text-indigo-700">Totale Soggiorno</span>
                            <span class="text-xl font-black text-indigo-900">
                                <span x-text="(booking.total_price).toLocaleString('it-IT', { style: 'currency', currency: 'EUR' })"></span>
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button" @click="open = false" class="w-full sm:w-auto rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 transition-colors">
                            Chiudi scheda
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layoutAdmin>
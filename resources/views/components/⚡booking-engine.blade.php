<?php

use Livewire\Volt\Component;
use App\Models\Room;
use Carbon\Carbon;

new class extends Component
{
    // Proprietà (Stato del componente)
    public $checkin;
    public $checkout;
    public $adults = 2;
    public $children = 0;
    public $hasSearched = false;

    // Inizializzazione delle date di default (Oggi -> tra 13 notti)
    public function mount()
    {
        $this->checkin = Carbon::today()->format('Y-m-d');
        $this->checkout = Carbon::today()->addDays(13)->format('Y-m-d');
    }

    // Funzione di ricerca avviata dal click del bottone
    public function search()
    {
        $this->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ]);

        $this->hasSearched = true;
    }

    // Passiamo i dati estratti dal DB alla parte HTML sottostante
    public function with(): array
    {
        if ($this->hasSearched) {
            $rooms = Room::where('max_capacity', '>=', ($this->adults + $this->children))
                ->whereDoesntHave('bookings', function ($query) {
                    $query->where(function ($q) {
                        $q->where('checkin_date', '<', $this->checkout)
                            ->where('checkout_date', '>', $this->checkin);
                    });
                })->get();
        } else {
            $rooms = Room::all();
        }

        return [
            'rooms' => $rooms,
        ];
    }
};
?>

<div class="max-w-7xl mx-auto px-4 py-8 custom-booking-engine">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <aside class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit sticky top-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Seleziona date e ospiti</h2>

            <form wire:submit.prevent="search" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Data di Arrivo</label>
                    <input type="date" wire:model="checkin"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 bg-gray-50">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Data di Partenza</label>
                    <input type="date" wire:model="checkout"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 bg-gray-50">
                </div>

                <hr class="border-gray-100">

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Adulti</label>
                        <select wire:model="adults" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 bg-gray-50">
                            @for ($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Bambini</label>
                        <select wire:model="children" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 p-3 bg-gray-50">
                            @for ($i = 0; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-medium py-3 px-4 rounded-xl transition duration-200 shadow-sm flex justify-center items-center">
                    <span wire:loading.remove wire:target="search">Cerca Disponibilità</span>
                    <span wire:loading wire:target="search" class="inline-block animate-spin rounded-full h-5 w-5 border-t-2 border-white"></span>
                </button>
            </form>
        </aside>

        <main class="lg:col-span-8 space-y-6">
            <div class="bg-gray-50 p-4 rounded-xl flex flex-wrap justify-between items-center text-sm text-gray-600 border border-gray-100">
                <div>
                    @if($hasSearched)
                    Risultati per: <strong class="text-gray-900">{{ Carbon\Carbon::parse($checkin)->format('d M') }} - {{ Carbon\Carbon::parse($checkout)->format('d M Y') }}</strong>
                    ({{ Carbon\Carbon::parse($checkin)->diffInDays(Carbon\Carbon::parse($checkout)) }} notti),
                    <strong class="text-gray-900">{{ $adults }} adulti</strong> @if($children > 0) e <strong class="text-gray-900">{{ $children }} bambini</strong> @endif
                    @else
                    <span class="italic text-gray-500">Mostrate tutte le sistemazioni della struttura. Seleziona le date per verificare prezzi e disponibilità reale.</span>
                    @endif
                </div>
            </div>

            @forelse($rooms as $room)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row hover:shadow-md transition duration-200">
                <div class="md:w-1/3 relative min-h-[200px] bg-gray-100">
                    @if(isset($room->image_path) && $room->image_path)
                    <img src="{{ asset('storage/' . $room->image_path) }}" alt="{{ $room->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="p-6 md:w-2/3 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $room->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $room->description }}</p>

                        <div class="flex gap-4 mt-3 text-xs text-gray-600">
                            <span class="bg-gray-100 px-2.5 py-1 rounded-full">Max {{ $room->max_capacity }} ospiti</span>
                            @if(isset($room->size))
                            <span class="bg-gray-100 px-2.5 py-1 rounded-full">{{ $room->size }} m²</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex items-end justify-between">
                        <div>
                            <span class="block text-xs text-gray-400">a partire da</span>
                            @if($hasSearched)
                            <span class="text-2xl font-black text-gray-950">
                                € {{ number_format($room->price_per_night * Carbon\Carbon::parse($checkin)->diffInDays(Carbon\Carbon::parse($checkout)), 2, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-500 block">per l'intero soggiorno</span>
                            @else
                            <span class="text-2xl font-black text-gray-950">€ {{ number_format($room->price_per_night, 2, ',', '.') }}</span>
                            <span class="text-xs text-gray-500 block">a notte</span>
                            @endif
                        </div>

                        <button class="bg-emerald-800 hover:bg-emerald-950 text-white font-medium text-sm py-2.5 px-5 rounded-xl transition duration-200">
                            Mostra proposte
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 bg-white rounded-2xl border border-gray-100">
                <p class="text-gray-500">Nessuna camera disponibile per i criteri selezionati.</p>
            </div>
            @endforelse
        </main>

    </div>
</div>
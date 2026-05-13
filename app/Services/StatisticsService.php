<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Service; // Assumendo sia il tuo modello per extraServices
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function getDashboardStats()
    {
        $now = Carbon::now();

        // 1. Statistiche Camere con Eloquent
        // 1. Statistiche Camere con Eloquent
        $rooms = Room::with(['bookings' => function ($query) {
            // Prendiamo solo i soldi veri, ovvero le prenotazioni confermate
            $query->whereIn('status', ['confirmed', 'checkedIn']);
        }])->get();

        $roomStats = $rooms->map(function ($room) use ($now) {
            $createdDate = Carbon::parse($room->created_at);
            $daysAvailable = $createdDate->diffInDays($now) ?: 1;

            // Notti effettive (solo confermate grazie al filtro sopra)
            $nightsBooked = $room->bookings->sum(function ($b) {
                return Carbon::parse($b->checkInDate)->diffInDays(Carbon::parse($b->checkOutDate));
            });

            return [
                'name' => $room->name, // Assicurati che sia 'name' e non 'firstName'
                'occupancy_rate' => round(($nightsBooked / $daysAvailable) * 100, 2),
                'revenue' => $room->bookings->sum('totalPrice') // Somma corretta per questa camera
            ];
        });

        // 2. Statistiche Prenotazioni Globali
        $totalBookings = Booking::count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        // Sostituisci la query incriminata con questa:
        $avgStay = Booking::select(DB::raw('AVG(julianday(checkOutDate) - julianday(checkInDate)) as avg_stay'))
            ->first()
            ->avg_stay;
        // 3. Ricavi Servizi Extra
        // Assumendo una tabella pivot o relazione tra Booking e Service
        // Calcolo ricavi extra usando le relazioni (più pulito)
        $extraServiceRevenue = Booking::with('services')->get()->sum(function ($booking) {
            return $booking->services->sum('price');
        });

        // 4. Distribuzione Recensioni (1-5)
        $reviewRatings = Review::select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        // Assicuriamoci che tutti i voti da 1 a 5 esistano (anche se 0)
        $fullRatings = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0], $reviewRatings);

        return [
            'roomStats' => $roomStats,
            'avgStay' => round($avgStay, 2),
            'cancelRate' => $totalBookings > 0 ? round(($cancelledBookings / $totalBookings) * 100, 2) : 0,
            'roomRevenueData' => $roomStats->pluck('revenue', 'name'),
            'extraRevenue' => $extraServiceRevenue,
            'reviewRatings' => array_values($fullRatings),
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Services\StatisticsService;
use Illuminate\Support\Carbon;
use App\Models\Review;
use App\Models\SpecialOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard(){
        // 1. Nuove prenotazioni (ultime 24 ore)
        $newBookingsCount = Booking::where('created_at', '>=', Carbon::now()->subDay())->count();

        // 2. Incassi Mese Corrente
        $monthlyEarnings = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereIn('status', ['confirmed', 'checkedIn']) // Prende entrambi gli stati
            ->sum('totalPrice');

        // 3. Occupazione Camere (percentuale)
        $totalRooms = Room::count();
        $occupiedRooms = Booking::where('checkInDate', '<=', Carbon::today())
            ->where('checkOutDate', '>', Carbon::today())
            ->where('status', 'confirmed') // Consideriamo solo quelle confermate
            ->distinct('roomId')          // Contiamo una volta sola se ci fossero sovrapposizioni
            ->count('roomId');

        // 4. Calcoliamo la percentuale
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;
        // 4. Media Recensioni
        $averageRating = Review::avg('rating') ?: 0;
        $reviewsCount = Review::count();

        // 5. Ultime 5 prenotazioni per la tabella
        $latestBookings = Booking::with(['user', 'room']) // Eager loading per non fare troppe query
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'newBookingsCount',
            'monthlyEarnings',
            'occupancyRate',
            'occupiedRooms',
            'totalRooms',
            'averageRating',
            'reviewsCount',
            'latestBookings'
        ));
    }

    public function showStatistics(StatisticsService $statsService)
    {
        $data = $statsService->getDashboardStats();
        return view('admin.stats.index', $data);
    }

    public function edit(){
        return view('admin.edit');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */

        $user = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required|current_password', // Controlla se coincide con la password nel DB
            'password' => ['nullable', 'confirmed', Password::default()],
        ], [
            'current_password.current_password' => 'La password attuale non è corretta.',
            'password.confirmed' => 'Le due password non coincidono.'
        ]);

        // Aggiornamento email
        $user->email = $validated['email'];

        // Aggiornamento password solo se fornita
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profilo aggiornato con successo!');
    }

    public function newBooking($roomId, $checkInDate)
    {
        
        $specialOffers = SpecialOffer::all();
        $room = Room::findOrFail($roomId);
        $rooms = Room::all();
        return view('admin.bookings.manualBooking', compact('room', 'rooms', 'checkInDate', 'specialOffers'));
    }
}

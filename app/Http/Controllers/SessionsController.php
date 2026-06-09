<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class SessionsController extends Controller
{

    public function create()
    {
        return view('auth.login-provvisorio');
    }


    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::default()]
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin) {
                return redirect('/admin/dashboard');
            }

            return redirect()->intended('/profile')->with('success','Benvenuto!');
        }

        return back()->with('error','Le credenziali fornite non corrispondono a nessun profilo')->withInput();
    }

    

   
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showProfile()
    {
        return view('auth.profile');
    }

    public function editProfile()
    {
        return view('auth.editProfile');
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'birthDate' => ['date', 'max:255'],
            'birthPlace' => ['string', 'max:255']
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        DB::transaction(function() use($user, $validatedData){
            $user->update($validatedData);

            $user->guest->update($validatedData);
        });
        return redirect('/profile')->with('success', 'Profilo aggiornato con successo!');    
    }

    public function editCredentials(){
        return view('auth.editCredentials');
    }

    public function editEmail()
    {
        return view('auth.editEmail');
    }

    public function updateEmail(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validatedData = $request->validate([
            'current_password' => ['required', 'current_password'], 
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), 
            ],
        ]);

        DB::transaction(function () use ($user, $validatedData) {
            $user->update([
                'email' => $validatedData['email'],
                'email_verified_at' => null, 
            ]);
        });

        return redirect('/profile')->with('success', 'Email aggiornata con successo!');
    }

    public function editPassword()
    {
        return view('auth.editPassword');
    }


    public function updatePassword(Request $request){
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [Password::default(), 'confirmed']
        ]);

        
        
        $request->user()->update(['password' => Hash::make($request->password)]);

        return redirect('/profile')->with('success', 'Password aggiornata');
    }

    

    public function showMyBooking()
    {
        $bookings = Booking::where('userId', Auth::id())
            ->orderBy('checkInDate', 'desc')
            ->get();

        return view('auth.myBookings', compact('bookings'));
    }
    

    public function deleteBooking($id)
    {
        $booking = Booking::where('id', $id)
            ->where('userId', Auth::id())
            ->first();

        if (!$booking) {
            return back()->with('error', 'Prenotazione non trovata.');
        }

        $oggi = Carbon::now();
        $dataCheckIn = Carbon::parse($booking->checkInDate);

        if ($oggi->diffInDays($dataCheckIn, false) < 10) {
            return back()->with('error', 'Spiacenti, puoi annullare una prenotazione solo fino a 10 giorni prima del check-in.');
        }

        $booking->update(['status' => Booking::STATUS_CANCELLED]);
        $booking->save();

        return redirect()->route('myBookings')->with('success', 'Prenotazione annullata con successo.');
    }
}

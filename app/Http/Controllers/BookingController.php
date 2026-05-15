<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Service;
use App\Models\SpecialOffer;
use App\Models\Season;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Cashier;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class BookingController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room']);

        $view = $request->query('view', 'list');
        $query->when($request->search, function ($q, $search) {
            $q->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('firstName', 'like', "%{$search}%")
                    ->orWhere('lastName', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        });

        $query->when($request->status, function ($q, $status) {
            $q->where('status', $status);
        });

        $bookings = $query->orderBy('checkInDate', 'desc')->get();

        $rooms = Room::with('bookings.user')->get();

        $startDate = $request->has('start_date')
            ? \Carbon\Carbon::parse($request->start_date)
            : now();

        $days = [];
        // Mostriamo ad esempio 21 giorni alla volta
        for ($i = 0; $i < 14; $i++) {
            $days[] = (clone $startDate)->addDays($i);
        }

        return view('admin.bookings.calendar', [
            'bookings' => $bookings,
            'rooms' => $rooms,
            'days' => $days,
            'view' => $view,
            'currentStart' => $startDate
        ]);
    }

    public function showCalendar(){
        session()->forget(['specialOfferId', 'specialOfferLenght']);
        return view('bookings.calendar');
    }

    public function showCalendarOffer($id)
    {
        $offer = SpecialOffer::findOrFail($id);
        session([
            'specialOfferId' => $offer->id,
            'specialOfferLenght' => $offer->lenght
        ]);
        return view('bookings.calendar');
    }

    public function search(Request $request)
    {   
        $request->validate([
            'date_range' => 'required|string',
            'beds_required' => 'required|integer|min:1',
        ]);

        $dates = preg_split('/ (to|al|-) /', $request->date_range);

        if (count($dates) < 2) {
            return back()->with('error', 'Per favore, seleziona sia la data di arrivo che quella di partenza.');
        }

        try {
            $checkIn = Carbon::createFromFormat('d-m-Y', trim($dates[0]))->startOfDay();
            $checkOut = Carbon::createFromFormat('d-m-Y', trim($dates[1]))->startOfDay();
            $nights = $checkIn->diffInDays($checkOut);
        } catch (\Exception $e) {
            return back()->with('error', 'Formato data non valido.');
        }

        // Controlliamo se c'è un'offerta speciale attiva in sessione
        if (session()->has('specialOfferId')) {
            $specialOfferLenght = session('specialOfferLenght');
            $specialOffer = SpecialOffer::findOrFail(session('specialOfferId'));
            $discount = $specialOffer->specialPrice;

            if ($nights != $specialOfferLenght) {
                return back()->withErrors([
                    'date_error' => "Questa offerta richiede un soggiorno di esattamente $specialOfferLenght giorni. Hai selezionato $nights giorni."
                ]);
            }
        }

        session([
            'search_check_in'  => $checkIn->format('Y-m-d'), 
            'search_check_out' => $checkOut->format('Y-m-d'),
            'search_nights'    => $nights,
            'search_guests'    => $request->beds_required,
        ]);

        $availableRooms = Room::where('beds', '>=', $request->beds_required)
            ->whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('checkInDate', '<', $checkOut->format('Y-m-d'))
                        ->where('checkOutDate', '>', $checkIn->format('Y-m-d'));
                })
                    ->where('cancellation','!=', true);
            })
            ->with('images')
            ->get();

        $totalPrice = 0;
        $currentDate = $checkIn->copy();

        while ($currentDate->lt($checkOut)) {
            // Cerchiamo se il giorno corrente ricade in una stagione specifica
            $season = Season::where('startDate', '<=', $currentDate->format('Y-m-d'))
                ->where('endDate', '>=', $currentDate->format('Y-m-d'))
                ->first();

            // Se c'è una stagione applichiamo il moltiplicatore, altrimenti prezzo base
            
            foreach($availableRooms as $room){
                $room->price = $season ? ($room->price * $season->multiplier) : $room->price;
            }

            $currentDate->addDay();
        }
        session(['availableRooms' => $availableRooms]);
        return view('bookings.calendar', [
            'rooms' => $availableRooms,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'nights' => $nights,
            'discount' => $discount ?? null,
            'guests' => $request->beds_required
        ]);
    }

    public function showDetail($id)
    {
        
        if (!session()->has('search_check_in')) {
            return redirect()->route('calendar')->with('error', 'Sessione scaduta o date non selezionate.');
        }

        
        $room = Room::with('images')->findOrFail($id);
        $rooms = session('availableRooms');
        $selected = $rooms->firstWhere('id', $id);
        $room->price = $selected->price;
        session(['roomId' => $id]);

        $checkIn = \Carbon\Carbon::parse(session('search_check_in'));
        $checkOut = \Carbon\Carbon::parse(session('search_check_out'));
        $nights = session('search_nights');
        $guests = session('search_guests');

        $totalPrice = $room->price * $nights;
        if (session()->has('specialOfferId')) {
            $specialOfferId = session('specialOfferId');
            $offer = SpecialOffer::findOrFail($specialOfferId);
            $totalPrice = $room->price * $nights - $room->price * $nights * $offer->specialPrice;
        }

        if ($guests > $room->beds) {
            return back()->with('error', 'Questa camera non ha abbastanza posti per il numero di ospiti selezionato.');
        }
        


        Stripe::setApiKey(env('STRIPE_SECRET'));

        // CREAZIONE DEL PAYMENT INTENT (Addebito immediato)
        $paymentIntent = PaymentIntent::create([
            'amount' => (int) ($totalPrice * 100), // Stripe vuole i centesimi
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'metadata' => [
                'roomId' => $room->id,
                'checkIn' => $checkIn,
                'checkOut' => $checkOut
            ],
        ]);
        $services = Service::all();


        return view('bookings.newCheckOut', [
            'clientSecret' => $paymentIntent->client_secret,
            'totalPrice' => $totalPrice,
            'room' => $room,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'nights' => $nights,
            'services' => $services,
            'guests' => $guests
        ]);
    }
    public function checkout(Request $request)
    {

        $roomId = session('roomId');
        $room = Room::findOrFail($roomId);

        $beds = session('search_guests');
        if (!session()->has('search_check_in')) {
            return redirect()->route('calendar')->with('error', 'Sessione scaduta. Ricomincia la ricerca.');
        }
        $selectedExtrasIds = $request->input('extras', []); // Prende l'array di ID o un array vuoto

        // Recupera i servizi dal DB per essere sicuri dei prezzi reali
        $selectedServices = Service::whereIn('id', $selectedExtrasIds)->get();

        // Somma i prezzi dei servizi
        $extrasTotal = $selectedServices->sum('price');

        $rooms = session('availableRooms');
        $selected = $rooms->firstWhere('id', $roomId);
        $room->price = $selected->price;
        $checkIn = session('search_check_in');
        $checkOut = session('search_check_out');
        $nights = session('search_nights');
        $totalPrice = $room->price * $nights + $extrasTotal;
        if (session()->has('specialOfferId')) {
            $specialOfferId = session('specialOfferId');
            $offer = SpecialOffer::findOrFail($specialOfferId);
            $totalPrice = $room->price * $nights - $room->price * $nights * $offer->specialPrice;
        }

        session(['totalPrice' => $totalPrice]);

        // Inizializza Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // CREAZIONE DEL PAYMENT INTENT (Addebito immediato)
        $paymentIntent = PaymentIntent::create([
            'amount' => (int) ($totalPrice * 100), // Stripe vuole i centesimi
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'metadata' => [
                'roomId' => $room->id,
                'checkIn' => $checkIn,
                'checkOut' => $checkOut,
                'extras' => json_encode($selectedExtrasIds),
            ],
        ]);

        return view('bookings.newCheckOut', [
            'clientSecret' => $paymentIntent->client_secret,
            'totalPrice' => $totalPrice,
            'room' => $room,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'guests' => $beds
        ]);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('home');
        }

        $checkoutSession = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

        if ($checkoutSession->payment_status !== 'paid') {
            return redirect()->route('calendar')->with('error', 'Il pagamento non è andato a buon fine');
        }

        $meta = $checkoutSession->metadata;

        $existingBooking = Booking::where('stripe_session_id', $sessionId)->first();
        if ($existingBooking) {
            return redirect()->route('home')->with('success', 'Prenotazione già registrata!');
        }

        DB::beginTransaction();

        try {
            // Creazione del Booking
            //dd($checkoutSession->metadata);
            $booking = Booking::create([
                'userId' => Auth::id(),
                'checkInDate' => $meta->checkIn,
                'checkOutDate' => $meta->checkOut,
                'roomId' => $meta->roomId,
                'status' => Booking::STATUS_CONFIRMED,
                'totalPrice' => $checkoutSession->amount_total / 100, // Convertiamo da centesimi
                'specialOfferId' => !empty($meta->specialOfferId) ? $meta->specialOfferId : null,
                'stripe_session_id' => $sessionId // Utile per tracciabilità e per evitare duplicati
            ]);

            // Gestione Servizi Extra
            $extras = json_decode($meta->extras, true);
            if (!empty($extras)) {
                $booking->services()->attach($extras);
            }

            // Recupera il PaymentIntent separatamente per sicurezza
            $paymentIntent = null;
            if ($checkoutSession->payment_intent) {
                $paymentIntent = Cashier::stripe()->paymentIntents->retrieve($checkoutSession->payment_intent, [
                    'expand' => ['latest_charge'] // Espandiamo la carica per leggere i dati della carta
                ]);
            }

            // Estrai le ultime 4 cifre in modo sicuro
            $last4 = '****';
            if ($paymentIntent && $paymentIntent->latest_charge) {
                $last4 = $paymentIntent->latest_charge->payment_method_details->card->last4 ?? '****';
            }

            // Ora crea il record Payment
            Payment::create([
                'bookingId' => $booking->id,
                'amount' => $checkoutSession->amount_total / 100,
                'lastFourDigits' => $last4,
                'cardHolderName' => Auth::user()->firstName . ' ' . Auth::user()->lastName
            ]);

            DB::commit();
            $checkoutSession = Cashier::stripe()->checkout->sessions->retrieve($sessionId);

            $invoiceId = null;

            // Metodo 1: Dalla sessione (quello che stiamo provando)
            if ($checkoutSession->invoice) {
                $invoiceId = is_string($checkoutSession->invoice) ? $checkoutSession->invoice : $checkoutSession->invoice->id;
            }

            // Metodo 2: Se il primo fallisce, passiamo dal Payment Intent (Il più sicuro)
            if (!$invoiceId && $checkoutSession->payment_intent) {
                $paymentIntent = Cashier::stripe()->paymentIntents->retrieve($checkoutSession->payment_intent);

                // Cerchiamo l'ID fattura dentro il pagamento
                $invoiceId = $paymentIntent->invoice ?? null;
            }

            // DEBUG: Vediamo se ora l'abbiamo trovata
            if (!$invoiceId) {
                dd("Ancora null. Controlla su Stripe se il pagamento " . $checkoutSession->payment_intent . " ha davvero una fattura collegata.");
            }
            $booking->load('room');

            Mail::to($request->user())->send(new BookingConfirmed($booking, Auth::user()));

            // Pulizia sessione
            session()->forget(['search_check_in', 'search_check_out', 'roomId', 'specialOfferId']);

            return redirect()->route('home')->with('success', 'Pagamento ricevuto e camera confermata!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('calendar')->with('error', 'Errore nella registrazione: ' . $e->getMessage());
        }
    }


    public function checkoutOld(Request $request)
    {

        $roomId = session('roomId');
        $room = Room::findOrFail($roomId);

        if (!session()->has('search_check_in')) {
            return redirect()->route('calendar')->with('error', 'Sessione scaduta. Ricomincia la ricerca.');
        }
        $selectedExtrasIds = $request->input('extras', []); // Prende l'array di ID o un array vuoto

        // Recupera i servizi dal DB per essere sicuri dei prezzi reali
        $selectedServices = Service::whereIn('id', $selectedExtrasIds)->get();

        // Somma i prezzi dei servizi
        $extrasTotal = $selectedServices->sum('price');

        $checkIn = session('search_check_in');
        $checkOut = session('search_check_out');
        $nights = session('search_nights');
        $totalPrice = $room->price * $nights + $extrasTotal;
        if (session()->has('specialOfferId')) {
            $specialOfferId = session('specialOfferId');
            $offer = SpecialOffer::findOrFail($specialOfferId);
            $totalPrice = $room->price * $nights - $room->price * $nights * $offer->specialPrice;
        }
        
        session(['totalPrice' => $totalPrice]);

        return view('bookings.checkout', compact('room', 'checkIn', 'checkOut', 'nights', 'totalPrice', 'selectedExtrasIds'));
    }


    public function processPayment(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'cardHolderName' => 'required|string',
            'lastFourDigits' => 'required',
        ]);

        $checkIn = session('search_check_in');
        $checkOut = session('search_check_out');
        $roomId = session('roomId');
        $totalPrice = session('totalPrice');
        if(session()->has('specialOfferId')){
            $offerId = session('specialOfferId');
        }

        if (!$checkIn || !$checkOut || !$totalPrice) {
            return redirect()->route('calendar')->with('error', 'Sessione scaduta.');
        }

        sleep(2); 

        DB::beginTransaction();

        try {
            $booking = Booking::create([
                'userId' => Auth::id(),
                'checkInDate' => $checkIn,
                'checkOutDate' => $checkOut,
                'roomId' => $roomId,
                'status' => Booking::STATUS_PENDING,
                'totalPrice' => $totalPrice,
                'specialOfferId' => $offerId ?? null
            ]);

            if ($request->has('extras')) {
                // attach() prende l'array di ID [1, 2, 5] e crea le righe in booking_service
                $booking->services()->attach($request->extras);
            }

            Payment::create([
                'bookingId' => $booking->id,
                'amount' => $totalPrice,
                'lastFourDigits' => substr($request->lastFourDigits, -4),
                'cardHolderName' => $request->cardHolderName
            ]);

            $booking->update(['status' => Booking::STATUS_CONFIRMED]);

            DB::commit();

            session()->forget(['search_check_in', 'search_check_out', 'search_nights', 'search_guests', 'totalPrice', 'roomId']);

            return redirect()->route('home')->with('success', 'Camera confermata!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Errore nel pagamento: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([]);
    }

    public function edit(Booking $booking) 
    {

    }

    public function update(Request $request)
    {
        $validated = $request->validate([]);
    }

    public function destroy(Booking $booking) 
    {
        try {
            $this->authorize('delete', $booking);        
            $booking->delete();

            return redirect()->route('admin.bookings')
                ->with('success', 'Prenotazione #BK-' . $booking->id . ' eliminata con successo.');
        } catch (\Exception $e) {
            return back()->with('error', 'Impossibile eliminare la prenotazione: ' . $e->getMessage());
        }
    }
}

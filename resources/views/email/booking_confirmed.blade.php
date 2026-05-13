<h1>Grazie per la tua prenotazione!</h1>
<p>Gentile {{ $user->firstName ?? 'Cliente' }}, la sua prenotazione è stata confermata</p>
<ul>
    <li><strong>Camera:</strong> {{ $booking->room->name }}</li>
    <li><strong>Check-in:</strong> {{ $booking->checkInDate }}</li>
    <li><strong>Check-out:</strong> {{ $booking->checkOutDate }}</li>
    <li><strong>Prezzo Totale:</strong> €{{ $booking->totalPrice }}</li>
</ul>

<p>Ti aspettiamo!</p>
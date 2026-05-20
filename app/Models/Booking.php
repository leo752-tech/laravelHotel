<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_CHECKED_IN = 'checkedIn';
    const STATUS_CHECKED_OUT = 'checkedOut';

    protected $fillable = [
        'userId',
        'checkInDate',
        'checkOutDate',
        'roomId',
        'status',
        'totalPrice',
        'specialOfferId',
        'stripe_session_id', // DEVE ESSERE QUI
        'stripe_invoice_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'roomId');
    }

    public function specialOffer()
    {
        return $this->belongsTo(SpecialOffer::class, 'specialOfferId');
    }

    public function canBeCancelled(){
        return $this->created_at->diffInDays(now())>=10;
    }

    public function review(){
        return $this->hasOne(Review::class, 'bookingId');
    }

    public function services()
    {
        // Specifica il nome della tabella pivot se non è quello standard (booking_service)
        return $this->belongsToMany(Service::class, 'booking_service', 'bookingId', 'serviceId')
        ->withTimestamps();
    }

    protected $casts = [
        'checkInDate' => 'date',
        'checkOutDate' => 'date',
        'cancellation' => 'boolean',
    ];
}

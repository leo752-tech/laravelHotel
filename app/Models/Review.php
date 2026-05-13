<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'title',
        'description',
        'rating',
        'userId',
        'bookingId'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function booking(){
        return $this->belongsTo(Booking::class, 'bookingId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'beds',
        'price',
        'type',
        'description'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomId');
    }

    public function images(){
        return $this->hasMany(Image::class, 'roomId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    protected $fillable = [
        'firstName',
        'lastName',
        'birthDate',
        'birthPlace'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'guestId', 'id');
    }
}

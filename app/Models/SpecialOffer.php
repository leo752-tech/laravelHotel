<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    protected $table = 'special_offers';

    protected $fillable = [
        'title',
        'description',
        'lenght',
        'specialPrice'
    ];

}

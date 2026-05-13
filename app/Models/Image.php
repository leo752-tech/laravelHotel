<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'rooms_images';    

    protected $fillable = [
        'roomId',
        'pathImage'
    ];

    public function room(){
        return $this->belongsTo(Room::class, 'roomId');
    }

}

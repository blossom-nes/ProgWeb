<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spectateur extends Model
{
    //
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}

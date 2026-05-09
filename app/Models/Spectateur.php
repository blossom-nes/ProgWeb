<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spectateur extends Model
{
    //
    protected $fillable = ['prenom', 'nom', 'reservation_id'];
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}

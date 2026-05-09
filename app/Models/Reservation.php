<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable = ['prenom', 'nom', 'email', 'telephone'];
    public function competitions(){
        return $this->belongsToMany(Competition::class, 'reservation_competition')->withPivot('quantite');
    }

    public function spectateurs(){
        return $this->hasMany(Spectateur::class);
    }
}

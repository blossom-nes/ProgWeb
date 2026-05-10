<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //une personne peut acheter des biellets pour plusieurs autres perssonnes 
    protected $fillable = ['prenom', 'nom', 'email', 'telephone'];
    public function competitions(){
        // une reservation peut concerner plsuieurs competitions 
        return $this->belongsToMany(Competition::class, 'reservation_competition')->withPivot('quantite');
    }

    public function spectateurs(){
        // une reservation a plusieurs spectetateurs(un billet acheté)
        return $this->hasMany(Spectateur::class);
    }
}

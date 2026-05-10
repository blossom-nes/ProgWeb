<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spectateur extends Model
{
    //
    //crée lors d'un resévation , un spectateur par un billet acheté . L'email et le telephone sont de l'acheteur 
    protected $fillable = ['prenom', 'nom', 'reservation_id'];
    public function reservation(){
        //un spectateur appartient à une réservation
        return $this->belongsTo(Reservation::class);
    }
}

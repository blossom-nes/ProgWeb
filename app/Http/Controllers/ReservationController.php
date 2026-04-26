<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //

    public function create(){
        return view('reservation.create');
    }

    public function store(Request $request)
{
    $reservation = Reservation::create([
        'prenom' => $request->prenom,
        'nom' => $request->nom,
        'email' => $request->email,
        'telephone' => $request->telephone
    ]);

    $panier = session()->get('panier', []);

    foreach($panier as $id => $item) {
        $reservation->competitions()->attach($id, [
            'quantite' => $item['quantite']
        ]);
    }

      session()->forget('panier');

    return "Réservation confirmée!!";
}

}

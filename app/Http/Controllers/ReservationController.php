<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //

    public function create(){
        $panier = session()->get('panier', []);
        // si le panier est vide , on redirige vers les compétitions 
        if(empty($panier)) {
            return redirect('/competitions')->with('info', 'Votre panier est vide. Veuillez ajouter des compétitions avant de réserver.');
        }
        return view('reservation.create',['panier'=> $panier]);
    }

    public function store(Request $request)
{ 
  $request->validate([
            'prenom'    => 'required|string|max:255',
            'nom'       => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
        ]);

    //Créer la réservation 
    $reservation = Reservation::create([
        'prenom' => $request->prenom,
        'nom' => $request->nom,
        'email' => $request->email,
        'telephone' => $request->telephone
    ]);
    //récupérer panier 

    $panier = session()->get('panier', []);
//  enregistrer dans pivot 
    foreach($panier as $id => $item) {
        $reservation->competitions()->attach($id, [
            'quantite' => $item['quantite']
        ]);
    }
    //vider panier
    // Sauvegarder le récapitulatif en session AVANT de vider le panier
        session()->put('recap', [
            'reservation' => $reservation->toArray(),
            'panier'      => $panier,
        ]);


      session()->forget('panier');

    return redirect('/confirmation');
}

}

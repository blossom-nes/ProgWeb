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
            'prenom'              => 'required|string|max:255',
            'nom'                 => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'telephone'           => 'required|string|max:20',
            'spectateurs'         => 'required|array',
            'spectateurs.*.prenom'=> 'required|string|max:255',
            'spectateurs.*.nom'   => 'required|string|max:255',
        ]);
 
        // Créer la réservation (coordonnées de l'acheteur)
        $reservation = Reservation::create([
            'prenom'    => $request->prenom,
            'nom'       => $request->nom,
            'email'     => $request->email,
            'telephone' => $request->telephone,
        ]);
 
        // Attacher les compétitions du panier (table pivot)
        $panier = session()->get('panier', []);
 
        foreach ($panier as $id => $item) {
            $reservation->competitions()->attach($id, [
                'quantite' => $item['quantite'],
            ]);
        }
 
        // Enregistrer les spectateurs (email et téléphone identiques à l'acheteur)
        foreach ($request->spectateurs as $s) {
            Spectateur::create([
                'prenom'         => $s['prenom'],
                'nom'            => $s['nom'],
                'reservation_id' => $reservation->id,
            ]);
        }
 
        // Sauvegarder le récapitulatif en session avant de vider le panier
        session()->put('recap', [
            'reservation' => $reservation->toArray(),
            'panier'      => $panier,
            'spectateurs' => $request->spectateurs,
        ]);
 
        session()->forget('panier');
 
        return redirect('/confirmation');
    }

}

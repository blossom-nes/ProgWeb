<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Spectateur;

class ReservationController extends Controller
{
    /**
     * Affiche le formulaire de réservation avec le récapitulatif du panier.
     * Redirige vers /competitions si le panier est vide.
     * Utilisé dans : resources/views/reservation/create.blade.php
     * Route : GET /reservation
     */
    public function create()
    {
        $panier = session()->get('panier', []);

        // Si le panier est vide, on redirige vers les compétitions
        if (empty($panier)) {
            return redirect('/competitions')->with('info', 'Votre panier est vide.');
        }

        return view('reservation.create', ['panier' => $panier]);
    }

    /**
     * Enregistre la réservation en base de données.
     * - Crée une entrée dans la table reservations (coordonnées acheteur)
     * - Attache les compétitions via la table pivot reservation_competition
     * - Crée un Spectateur par billet (prénom + nom)
     * - Sauvegarde un récapitulatif en session pour la page confirmation
     * - Vide le panier
     * Redirige vers : /confirmation
     * Route : POST /reservation
     */
    public function store(Request $request)
    {
        $request->validate([
            'prenom'               => 'required|string|max:255',
            'nom'                  => 'required|string|max:255',
            'email'                => 'required|email|max:255',
            'telephone'            => 'required|string|max:20',
            'spectateurs'          => 'required|array',
            'spectateurs.*.prenom' => 'required|string|max:255',
            'spectateurs.*.nom'    => 'required|string|max:255',
        ]);

        // Crée la réservation avec les coordonnées de l'acheteur
        $reservation = Reservation::create([
            'prenom'    => $request->prenom,
            'nom'       => $request->nom,
            'email'     => $request->email,
            'telephone' => $request->telephone,
        ]);

        // Récupère le panier stocké en session
        $panier = session()->get('panier', []);

        // Attache chaque compétition à la réservation via la table pivot
        foreach ($panier as $id => $item) {
            $reservation->competitions()->attach($id, [
                'quantite' => $item['quantite'],
            ]);
        }

        // Crée un spectateur par billet (email et téléphone identiques à l'acheteur)
        foreach ($request->spectateurs as $s) {
            Spectateur::create([
                'prenom'         => $s['prenom'],
                'nom'            => $s['nom'],
                'reservation_id' => $reservation->id,
            ]);
        }

        // Sauvegarde le récapitulatif en session avant de vider le panier
        session()->put('recap', [
            'reservation' => $reservation->toArray(),
            'panier'      => $panier,
            'spectateurs' => $request->spectateurs,
        ]);

        // Vide le panier
        session()->forget('panier');

        return redirect('/confirmation');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;

class PanierController extends Controller
{
    /**
     * Ajoute une compétition au panier ou incrémente sa quantité.
     * Le panier est stocké en session (pas en base de données).
     * Structure d'un item : ['nom', 'prix', 'quantite']
     * Redirige vers : la page précédente
     * Route : POST /panier/ajouter/{id}
     */
    public function ajouter(Request $request, $id)
    {
        // Récupère la compétition ou renvoie une 404 si introuvable
        $competition = Competition::findOrFail($id);

        // Récupère le panier actuel depuis la session
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            // Si la compétition est déjà dans le panier, on augmente la quantité
            $panier[$id]['quantite'] += $request->quantite ?? 1;
        } else {
            // Sinon on l'ajoute avec les infos nécessaires pour l'affichage
            $panier[$id] = [
                'nom'      => $competition->discipline->nom,
                'prix'     => $competition->prix,
                'quantite' => $request->quantite ?? 1,
            ];
        }

        // Sauvegarde le panier mis à jour en session
        session()->put('panier', $panier);

        return redirect()->back()->with('success', 'Ajouté au panier');
    }

    /**
     * Affiche le contenu du panier.
     * Utilisé dans : resources/views/panier/index.blade.php
     * Route : GET /panier
     */
    public function index()
    {
        // Récupère le panier depuis la session (tableau vide si aucun item)
        $panier = session()->get('panier', []);

        return view('panier.index', ['panier' => $panier]);
    }
}
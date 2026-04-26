<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanierController extends Controller
{
    //
    public function ajouter (Request $request,$id){
        $competition = Competition::findOrFail($id);
        // Va cherhcer une competiton dans la base de données avec cet id
        //ne trouve pas -> 404 
        $panier = session()->get('panier', []);
        //recupere le panier stocké en session ->stockage temporaire 

        if (isset($panier[$id])) {
            # code...
            $panier[$id]['quantite']++;
        }else{
            $panier[$id] =[
                "nom"=> $competition -> discipline -> nom,
                "prix"=>$competition -> prix,
                "quantite"=>1
            ];

        }
        session()->put('panier',$panier);
        //enregistre la panier dans la session

        return redirect()->back()->with('success','Ajouté au panier');
        // renvoie à la pahe précédente  // le message ajouté au panier va s'afficher la vue 


    }

    public function index(){
        $panier = session()->get('panier', []);
        return view('panier.index', ['panier' => $panier]);
        
    }

}

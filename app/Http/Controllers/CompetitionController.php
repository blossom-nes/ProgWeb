<?php

namespace App\Http\Controllers;
use App\Models\Competition;

use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    //

    public function index (){
        //afficher la liste des competitions 
        $competitions = Competition::with('discipline','tour','site')->get();

        return view('competitions.index', ['competitions' => $competitions]);
    
   
    }
}

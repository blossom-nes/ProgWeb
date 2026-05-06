<?php

namespace App\Http\Controllers;
use App\Models\Competition;
use App\Models\Discipline;


use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    //

    public function index (){
        //afficher la liste des competitions 
        $competitions = Competition::with('discipline','tour','site')->get();

        return view('competitions.index', ['competitions' => $competitions]);
    
   
    }

    public function indexAdmin (){
        //afficher la liste des competitions 
        $competitions = Competition::with('discipline','tour','site')->get();

        return view('admin.index', ['competitions' => $competitions]);
    
   
    }

    public function create()
{
    $disciplines = Discipline::all();
    $tours = Tour::all();
    $sites = Site::all();

    return view('admin.create', compact('disciplines','tours','sites'));
}

public function store(Request $request)
{
    Competition::create($request->all());

    return redirect('/admin');
}

public function edit($id)
{
    $competition = Competition::findOrFail($id);
    $disciplines = Discipline::all();
    $tours = Tour::all();
    $sites = Site::all();

    return view('admin.edit', compact('competition','disciplines','tours','sites'));
}

public function update(Request $request, $id)
{
    $competition = Competition::findOrFail($id);
    $competition->update($request->all());

    return redirect('/admin');
}
public function destroy($id)
{
    $competition = Competition::findOrFail($id);
    $competition->delete();

    return redirect('/admin');
}
public function calendrier(Request $request)
{
    $query = Competition::with('discipline','site','tour');

    // filtre discipline
    if ($request->discipline) {
        $query->where('discipline_id', $request->discipline);
    }

    $competitions = $query->orderBy('date')->get();

    // regrouper par date
    $competitionsParDate = $competitions->groupBy('date');

    $disciplines = Discipline::all();

    return view('calendrier.index', compact('competitionsParDate', 'disciplines'));
}

}

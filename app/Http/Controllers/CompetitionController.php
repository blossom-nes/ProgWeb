<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Discipline;
use App\Models\Tour;
use App\Models\Site;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Affiche la liste des compétitions disponibles pour le public.
     * Utilisé dans : resources/views/competitions/index.blade.php
     * Route : GET /competitions
     */
    public function index(Request $request)
    {
        $query = Competition::with('discipline', 'tour', 'site');

        if ($request->filled('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }

        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $competitions = $query->get();

        return view('competitions.index', ['competitions' => $competitions]);
    }

    /**
     * Affiche la liste des compétitions + toutes les réservations pour l'admin.
     * Utilisé dans : resources/views/admin/index.blade.php
     * Route : GET /admin
     */
    public function indexAdmin()
    {
        $competitions = Competition::with('discipline', 'tour', 'site')->get();
        $reservations = \App\Models\Reservation::with(
            'competitions.discipline',
            'competitions.tour',
            'spectateurs'
        )->get();

        return view('admin.index', compact('competitions', 'reservations'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle compétition.
     * Utilisé dans : resources/views/admin/create.blade.php
     * Route : GET /admin/create
     */
    public function create()
    {
        $disciplines = Discipline::all();
        $tours = Tour::all();
        $sites = Site::all();

        return view('admin.create', compact('disciplines', 'tours', 'sites'));
    }

    /**
     * Enregistre une nouvelle compétition en base de données.
     * Redirige vers : /admin
     * Route : POST /admin
     */
    public function store(Request $request)
    {
        Competition::create($request->all());

        return redirect('/admin');
    }

    /**
     * Affiche le formulaire de modification d'une compétition existante.
     * Utilisé dans : resources/views/admin/edit.blade.php
     * Route : GET /admin/{id}/edit
     */
    public function edit($id)
    {
        $competition = Competition::findOrFail($id);
        $disciplines = Discipline::all();
        $tours = Tour::all();
        $sites = Site::all();

        return view('admin.edit', compact('competition', 'disciplines', 'tours', 'sites'));
    }

    /**
     * Met à jour une compétition existante en base de données.
     * Redirige vers : /admin
     * Route : PUT /admin/{id}
     */
    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
        $competition->update($request->all());

        return redirect('/admin');
    }

    /**
     * Supprime une compétition de la base de données.
     * Redirige vers : /admin
     * Route : DELETE /admin/{id}
     */
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect('/admin');
    }

    /**
     * Affiche le calendrier des compétitions groupées par jour.
     * Permet de filtrer par discipline via un paramètre GET.
     * Utilisé dans : resources/views/calendrier/index.blade.php
     * Route : GET /calendrier
     */
    public function calendrier(Request $request)
    {
        $query = Competition::with('discipline', 'site', 'tour');

        // Filtre optionnel par discipline
        if ($request->discipline) {
            $query->where('discipline_id', $request->discipline);
        }

        $competitions = $query->orderBy('jour')->get();

        // Regroupe les compétitions par date pour l'affichage
        $competitionsParJour = $competitions->groupBy('jour');

        $disciplines = Discipline::all();

        return view('calendrier.index', compact('competitionsParJour', 'disciplines'));
    }
}
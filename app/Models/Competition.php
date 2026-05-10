<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    // une compeption combine une disicpline , tour site
    protected $fillable = [ 'discipline_id', 'tour_id', 'site_id', 'jour', 'heure_debut','heure_fin', 'prix'
];
    public function discipline()
    { // une competiton apparteint à une discipline 
        return $this->belongsTo(Discipline::class);
    }
    public function tour()
    {// une competiton appartient à  un tour (qualifications ou finale )
        return $this->belongsTo(Tour::class);
    }
    public function site()    {
        // une competiton se déroule dans un site
        return $this->belongsTo(Site::class);

    }

    public function reservations(){
        // une compétion peut avoir plusieurs réservations(many to many)
    return $this->belongsToMany(Reservation::class, 'reservation_competition')->withPivot('quantite');
}

    public function getNbSpectateursAttribute(){
        // nombre total de spectacteurs ayant réservé pour cette compétition 
        //additionne les quantités dans la table pivot reservation_competition 

        return $this->reservations->sum('pivot.quantite');
    }
    public function getPlacesRestantesAttribute()
    // nombre de places encore disponibles 
    //= capacité max du site - nombre de spectateirs ayant réservé 

{
    return $this->site->capacite_max - $this->nb_spectateurs;
}


}

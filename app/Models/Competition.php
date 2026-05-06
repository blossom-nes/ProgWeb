<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    //
    protected $fillable = [ 'discipline_id', 'tour_id', 'site_id', 'date', 'heure_debut','heure_fin', 'prix'
];
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    public function site()    {
        return $this->belongsTo(Site::class);

    }

    public function reservations(){
        return $this->belongsToMany(Reservation::class)->withPivot('quantite');
    }

    public function getNbSpectateursAttribute(){
        return $this->reservations->sum('pivot.quantite');
    }
    public function getPlacesRestantesAttribute()
{
    return $this->site->capacite_max - $this->nb_spectateurs;
}


}

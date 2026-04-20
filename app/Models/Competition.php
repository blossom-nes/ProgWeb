<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    //
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
}

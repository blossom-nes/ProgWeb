<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // Représente un type d'épreuve pour une discipline (qualifications , finale )
    protected $fillable = ['nom', 'discipline_id'];
    public function discipline()
    {// Un tour appartient à une discipline 
        return $this->belongsTo(Discipline::class);
    }
    public function competitions(){
        //un tour peut être associé a plusieurs compétitions 
        return $this->hasMany(Competition::class);
    }
}

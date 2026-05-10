<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    //
    protected $fillable = ['nom'];

    public function tours()
    {
        // une discipline  a plusieurs tours 
        return $this->hasMany(Tour::class);
    }

    public function competitions(){
        //une discipline a plusieurs  compétitions 
        return $this->hasMany(Competition::class);
    }
}

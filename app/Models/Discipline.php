<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    //

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function competitions(){
        return $this->hasMany(Competition::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
    public function competitions(){
        return $this->hasMany(Competition::class);
    }
}

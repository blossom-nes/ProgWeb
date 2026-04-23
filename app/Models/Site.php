<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $fillable = ['nom', 'capacite_max'];
    public function competitions(){
        return $this->hasMany(Competition::class);
    }
}

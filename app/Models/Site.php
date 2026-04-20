<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    public function competitions(){
        return $this->hasMany(Competition::class);
    }
}

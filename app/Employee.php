<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function visits() {
        return $this->hasMany('App\Visit');
    }
}

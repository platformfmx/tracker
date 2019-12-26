<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];

    public function employee() {
        return $this->belongsTo('App\Visit');
    }
}

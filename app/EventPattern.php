<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPattern extends Model {

    public function activities() {
        return $this->belongsToMany('App\Activity');
    }

    public function getNameAttribute() {
        return $this->name;
    }

}

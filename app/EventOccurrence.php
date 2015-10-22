<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventOccurrence extends Model {

    public function activities() {
        return $this->belongsToMany('App\Activity');
    }

    public function event() {
        return $this->hasOne('App\Event');
    }

    public function getDateAttribute($value) {
        return Carbon::parse($value);
    }
    public function getTimeAttribute(){        
        return isset($this->time) ? Carbon::parse($this->time) : $this->event()->time->copy()->setDate(0,0,0);
    }
}

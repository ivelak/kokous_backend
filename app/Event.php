<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model {

    protected $appends = ['time_string', 'date_string'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function eventOccurrences() {
        return $this->hasMany('App\EventOccurrence');
    }

    public function getTimeAttribute($value) {
        return Carbon::parse($value);
    }

    public function getTimeStringAttribute() {
        return $this->time->toTimeString();
    }

    public function getDateStringAttribute() {
        return $this->time->toDateString();
    }
}

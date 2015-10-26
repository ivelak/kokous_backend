<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model {

    protected $appends = ['time_string', 'date_string'];
    protected $dates = ['time','endDate','modified_at','created_at'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function eventOccurrences() {
        return $this->hasMany('App\EventOccurrence');
    }

    public function getTimeStringAttribute() {
        return $this->time->toTimeString();
    }

    public function getDateStringAttribute() {
        return $this->time->toDateString();
    }
}

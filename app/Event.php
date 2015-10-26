<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model {

    protected $dates = ['time','endDate','modified_at','created_at'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function eventOccurrences() {
        return $this->hasMany('App\EventOccurrence');
    }
}

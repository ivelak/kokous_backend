<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventOccurrence extends Model {

    public function activities() {
        return $this->belongsToMany('App\Activity');
    }

    public function event() {
        return $this->belongsTo('App\Event');
    }

    public function getDateAttribute($value) {
        return Carbon::parse($value);
    }

    public function getTimeAttribute($time) {
        return isset($time) ? Carbon::parse($time) : $this->event->time->copy()->setDate(0, 0, 0);
    }

    public function getNameAttribute() {
        return $this->event->name;
    }

    public function getPlaceAttribute() {
        return $this->event->place;
    }

    public function scopeUpcoming($query) {
        $events = EventOccurrence::all()
                        ->filter(function ($events) {
                            return Carbon::Parse($events['date']) > Carbon::yesterday();
                        })->map(function ($value, $key) {
            return $value['id']
            ;
        })
        ;
        return $query->whereIn('id', $events);
    }

}

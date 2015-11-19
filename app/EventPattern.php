<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPattern extends Model {

    public function activities() {
        return $this->belongsToMany('App\Activity');
    }
    
    public function setAgeGroupsAttribute($value)
    {
        $this->attributes['ageGroups'] = implode(',', $value);
    }
    
    public function getAgeGroupsAttribute()
    {
        return explode(',', $this->ageGroups);
    }

}

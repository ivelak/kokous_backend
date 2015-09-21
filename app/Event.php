<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{   
    public function activities(){
        return $this->belongsToMany('App\Activity');
    }
    
    public function getTimeAttribute($value)
    {
        return Carbon::parse($value);
    }
}

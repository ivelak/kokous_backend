<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{   
    protected $appends = ['time_string','date_string'];
    
    public function activities(){
        return $this->belongsToMany('App\Activity')->withPivot('occurrence');
    }
    
    public function groups(){
        return $this->belongsToMany('App\Group');
    }
    
    public function getTimeAttribute($value)
    {
        return Carbon::parse($value);
    }
    
    public function getTimeStringAttribute(){
        return $this->time->toTimeString();
    }
    
    public function getDateStringAttribute(){
        return $this->time->toDateString();
    }
}

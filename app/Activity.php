<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function events(){
        return $this->belongsToMany('App\Event');
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }
}

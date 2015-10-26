<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    
    public function events(){
        return $this->hasMany('App\Event');
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }
}

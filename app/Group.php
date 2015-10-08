<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $appends = ['time_string','date_string'];
    
    public function events(){
        return $this->belongsToMany('App\Event');
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }
}

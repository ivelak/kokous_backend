<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guid', 'age_group'];
    
    public function eventOccurences(){
        return $this->belongsToMany('App\EventOccurrence');
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }
}

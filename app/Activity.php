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
    protected $fillable = ['name', 'guid', 'age_group', 'task_group'];

    public function eventOccurences(){
        return $this->belongsToMany('App\EventOccurrence');
    }

    public function eventPatterns(){
        return $this->belongsToMany('App\EventPattern');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function comments(){
        return $this->morphMany('App\Comment','imageable');
    }
}

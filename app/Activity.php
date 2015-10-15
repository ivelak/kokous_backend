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
    
    public function events(){
        return $this->belongsToMany('App\Event')->withPivot('occurrence');
    }
    
    public function users(){
        return $this->belongsToMany('App\User');
    }
}

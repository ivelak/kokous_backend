<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $appends=['members', 'leaders'];
    protected $hidden=['users'];

    public function events(){
        return $this->hasMany('App\Event');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function getMembersAttribute(){
        return $this->users()->wherePivot('role', 'member')->getEager();
    }

    public function getLeadersAttribute(){
        return $this->users()->wherePivot('role', 'leader')->getEager();
    }
}

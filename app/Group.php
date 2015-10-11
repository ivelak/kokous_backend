<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Group
 *
 * @property integer $id
 * @property string $name
 * @property string $scout_group
 * @property string $age_group
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereScoutGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereAgeGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereUpdatedAt($value)
 */
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

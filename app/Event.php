<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Event
 *
 * @property string $name
 * @property integer $id
 * @property string $time
 * @property string $endDate
 * @property string $place
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Group[] $groups
 * @property-read mixed $time_string
 * @property-read mixed $date_string
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereUpdatedAt($value)
 */
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

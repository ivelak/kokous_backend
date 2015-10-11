<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Recurrence
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $start
 * @property \Carbon\Carbon $interval
 * @method static \Illuminate\Database\Query\Builder|\App\Recurrence whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recurrence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recurrence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recurrence whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Recurrence whereInterval($value)
 */
class Recurrence extends Model
{
    //
    protected $dates = ['created_at', 'updated_at', 'start','interval'];
    
}

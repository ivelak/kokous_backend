<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Hint
 *
 * @property integer $id
 * @property integer $activity_id
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereActivityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Hint whereUpdatedAt($value)
 */
class Hint extends Model
{
    //
}

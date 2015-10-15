<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Activity
 *
 * @property integer $id
 * @property integer $guid
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereGuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Activity whereUpdatedAt($value)
 */
	class Activity {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $partio_id
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activities
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePartioId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User {}
}

namespace App{
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
	class Hint {}
}

namespace App{
/**
 * App\Event
 *
 * @property string $name
 * @property integer $id
 * @property string $time
 * @property string $place
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Activity[] $activities
 * @property-read mixed $time_string
 * @property-read mixed $date_string
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereUpdatedAt($value)
 */
	class Event {}
}

namespace App{
/**
 * App\Group
 *
 * @property integer $id
 * @property string $name
 * @property string $scout_group
 * @property string $age_group
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereScoutGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereAgeGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Group whereUpdatedAt($value)
 */
	class Group {}
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $name, $time, $authority, $place, $activity;
}

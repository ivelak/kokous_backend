<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $appends = ['time_string','date_string'];
    
    
}

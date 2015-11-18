<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EventPattern;
use App\Activity;
use Session;

class EventPatternController extends Controller {

    public function create()
    {
        $activities = Activity::all();
        return view('newEventPattern', compact('activities'));
    }

}

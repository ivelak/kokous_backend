<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EventPattern;
use App\Activity;
use App\User;
use Carbon\Carbon;
use Session;

class EventPatternController extends Controller {

    public function create()
    {
        $activities = Activity::all();
        return view('newEventPattern', compact('activities'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'selectedAgeGroups' => 'required'
        ]);
        
        $selected_activities = $request->input('selected_activity');
        
        $event_pattern = new EventPattern();
        $event_pattern->name = $request->input('name');
        $event_pattern->ageGroups = $request->input('selectedAgeGroups');
        
        if($request->input('date') != NULL)
        {
            $event_pattern->date = Carbon::createFromFormat('d.m', $request->input('date'));
        }
        else 
        {
            $event_pattern->date = Carbon::createFromFormat('d.m', $request->input('start'));
            $event_pattern->endDate = Carbon::createFromFormat('d.m', $request->input('end'));
        }
        
        $event_pattern->save();
        
        for($i = 0; $i < count($selected_activities); $i++)
        {
            $activity = Activity::findOrFail($selected_activities[$i]);
            $event_pattern->activities()->attach($activity);
        }
        
        return redirect('/');
    }

}

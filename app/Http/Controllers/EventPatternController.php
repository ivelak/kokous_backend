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
use Validator;

class EventPatternController extends Controller {

    public function create()
    {
        $activities = Activity::all();
        return view('newEventPattern', compact('activities'));
    }
    
    public function index(Request $request) {
        $eventPatterns = EventPattern::paginate($request->input('perpage', 15));
        return view('eventPatterns', compact('eventPatterns'));
    }
    
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tapahtumapohjalla tulee olla nimi',
            'date.required' => 'Tapahtumapohjalla tulee olla aika',
            'start.required' => 'Tapahtumapohjalla tulee olla aika',
            'end.required' => 'Tapahtumapohjalla tulee olla aika',
            'selectedAgeGroups.required' => 'Tapahtumapohjalla tulee olla ikäryhmä',
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required_if:start,null',
            'start' => 'required_if:date,null',
            'end' => 'required_if:date,null',
            'selectedAgeGroups' => 'required',
        ], $messages);
        
        if ($validator->fails()) {
            return redirect('event_patterns/new')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        
        
        $selected_activities = $request->input('selected_activity');
        
        $event_pattern = new EventPattern();
        $event_pattern->name = $request->input('name');
        $event_pattern->ageGroups = $request->input('selectedAgeGroups');
        
        if($request->input('date') != NULL)
        {
            $event_pattern->date = Carbon::createFromFormat('d.m.Y', $request->input('date'));
        }
        else 
        {
            $event_pattern->date = Carbon::createFromFormat('d.m.Y', $request->input('start'));
            $event_pattern->endDate = Carbon::createFromFormat('d.m.Y', $request->input('end'));
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

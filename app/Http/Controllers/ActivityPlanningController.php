<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\EventPattern;

class ActivityPlanningController extends Controller
{
    public function showActivitySelectView()
    {
        $activities = Activity::all();
        $activitiesByTaskGroups = $activities->groupBy('task_group');
        $activitiesByTaskGroups = $activitiesByTaskGroups->map(function($item, $key) {
            return collect([$key => $item]);
        });
        
        $activitiesByAgeGroups = $activitiesByTaskGroups->groupBy(function($item, $key){
            return $item->first()->first()->age_group;
        });
        
        return view('ActivityPlanning/activitySelection', compact('activitiesByAgeGroups'));
    }
    
    public function selectActivities(){
        session(['activities' => request('activities')]);
        return redirect('activity_planning/events');
    }


    public function showEventSelectView()
    {
        //Testing data
        $event1 = new EventPattern();
        $event1->name = 'testE1';
        $event1->id = 1;
        $event1->activities =  factory('App\Activity', 5)->make();
        
        $event2 = new EventPattern();
        $event2->name = 'testE2';
        $event2->id = 2;
        $event2->activities =  factory('App\Activity', 5)->make();
        
        $eventPatterns = collect([$event1, $event2]);
        //End of test data
        return view('ActivityPlanning/eventSelection', compact('eventPatterns'));
    }
    
    public function selectEvents(){
        session(['activities' => request('activities')]);
        return redirect('activity_planning/events');
    }


    public function showActivityEventPlannerView()
    {
        return view('ActivityPlanning/activityEventPlanner');
    }

}

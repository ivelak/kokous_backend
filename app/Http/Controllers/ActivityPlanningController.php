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
        $eventPatterns = EventPattern::all();
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

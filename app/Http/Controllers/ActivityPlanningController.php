<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;

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
    
    public function showEventSelectView()
    {
        return view('ActivityPlanning/eventSelection');
    }
    
    public function showActivityEventPlannerView()
    {
        return view('ActivityPlanning/activityEventPlanner');
    }

}

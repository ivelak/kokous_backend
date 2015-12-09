<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\Group;
use App\EventOccurrence;
use App\EventPattern;
use App\Event;
use Carbon\Carbon;

class ActivityPlanningController extends Controller {

    public function showActivitySelectView() {
        $activities = Activity::all();
        $activitiesByTaskGroups = $activities->groupBy('task_group');
        $activitiesByTaskGroups = $activitiesByTaskGroups->map(function($item, $key) {
            return collect([$key => $item]);
        });
        
        $groups = Group::all();

        $activitiesByAgeGroups = $activitiesByTaskGroups->groupBy(function($item, $key) {
            return $item->first()->first()->age_group;
        });

        return view('ActivityPlanning/activitySelection', compact('activitiesByAgeGroups', 'groups'));
    }

    public function selectActivities() {
        session(['activities' => request('activities')]);
        session(['group' => request('group')]);
        return redirect('activity_planning/events');
    }

    public function showEventSelectView() {
        $eventPatterns = EventPattern::all();
        return view('ActivityPlanning/eventSelection', compact('eventPatterns'));
    }

    public function selectEvents() {
        session(['eventPatterns' => request('eventPatterns')]);
        return redirect('activity_planning/planner');
    }

    public function showActivityEventPlannerView() {
        $activitiesIds = session('activities');
        $activities = [];
        foreach ($activitiesIds as $id) {
            array_push($activities, Activity::find($id));
        }

        $eventPatternIds = session('eventPatterns');
        $eventPatterns = [];
        foreach ($eventPatternIds as $id) {
            array_push($eventPatterns, EventPattern::find($id));
        }

        $groupId = session('group');
        $group = Group::find($groupId);
        $groups = Group::all();
        //$events = EventOccurrence::with('activities')->where('group', $groupId)->get();
        $events = EventOccurrence::with('activities')->get();
        
        return view('ActivityPlanning/activityEventPlanner', compact('activities', 'eventPatterns', 'groups', 'group', 'events', 'groupId'));
    }
    
    public function handleActivityPlan(Request $request) {

        $occurrences = $request->input('occurrences');
        $eventPatterns = $request->input('patterns');
        
        // occurrencejen käsittely
        foreach($occurrences as $occurrence) {
            $eventOccurrence = EventOccurrence::findOrFail($occurrence['id']);
            foreach($occurrence['activities'] as $activityId)
            {
                $activity = Activity::findOrFail($activityId);
                $eventOccurrence->activities()->attach($activity);
            }
        }
        
        // eventPatternien käsittely
        foreach($eventPatterns as $eventPattern) {
            $eventPatternReal = EventPattern::findOrFail($eventPattern['id']);
            $event = new Event();
            return $eventPattern['date'];
            $event->time = Carbon::createFromFormat('d.m.Y h:i', $eventPattern['date'] . ' ' . $eventPattern['time']);
            $event->endDate = Carbon::createFromFormat('d.m.Y', $eventPattern['date']);
            $event->description = " ";
            $event->place = " ";
            $event->name = $eventPatternReal->name;
            $event->group_id = $request->input('group');
            $event->save();
            
            $eventOccurrence = new EventOccurrence();
            $eventOccurrence->date = Carbon::createFromFormat('d.m.Y', $eventPattern['date']);
            $eventOccurrence->event_id = $event->id;
            $eventOccurrence->save();
            
            foreach($eventPattern['activities'] as $activityId)
            {
                $activity = Activity::findOrFail($activityId);
                $eventOccurrence->activities()->attach($activity);
            }
        }
        
        return $request->input('patterns');
    }

}

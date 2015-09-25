<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\Activity;

class EventActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $event = Event::findOrFail($id);
        //refaktoroikaa tää :D
        $activities = Activity::whereNotIn('id', $event->activities()->get()->map(function ($item, $key) {return $item->id;}))->get();
        return view('eventActivities', compact('event', 'activities'));
    }


 /**
  * Adds activity for given event
  * 
  * @param type $id 
  * @param type $activityId
  */
    public function add($id, Request $request){
        $event = Event::findOrFail($id);
        $activity = Activity::findOrFail($request->input('activityId'));
        $event->activities()->attach($activity);
        $event->save();
        return redirect()->back();
    }
    
    /**
     * Removes activity from given event
     * 
     * @param type $id
     * @param type $activityId
     */
    public function remove($id, Request $request){
        $event = Event::findOrFail($id);
        $activity = Activity::findOrFail($request->input('activityId'));
        $event->activities()->detach($activity);
        $event->save();
        return redirect()->back();
    }
}

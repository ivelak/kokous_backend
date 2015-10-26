<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EventOccurrence;
use App\Activity;

class OccurrenceActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $occId)
    {
        $eventOccurrence = EventOccurrence::where('event_id', $id)->findOrFail($occId);
        //refaktoroikaa tää :D
        $activities = Activity::whereNotIn('id', $eventOccurrence->activities()->get()->map(function ($item, $key) {return $item->id;}))->get();
        return view('eventActivities', compact('eventOccurrence', 'activities'));
    }


 /**
  * Adds activity for given event
  *
  * @param type $id
  * @param type $activityId
  */
    public function add($id, $occId, Request $request){
        $eventOccurrence = EventOccurrence::where('event_id', $id)->findOrFail($occId);
        $activity = Activity::findOrFail($request->input('activityId'));
        $eventOccurrence->activities()->attach($activity);
        // Tähän tulee lisätä tieto siitä kuka suorituksen merkkasi!!
        $eventOccurrence->save();
        return redirect()->back();
    }

    /**
     * Removes activity from given event
     *
     * @param type $id
     * @param type $activityId
     */
    public function remove($id, $occId, Request $request){
        $eventOccurrence = EventOccurrence::where('event_id', $id)->findOrFail($occId);
        $activity = Activity::findOrFail($request->input('activityId'));
        $eventOccurrence->activities()->detach($activity);
        $eventOccurrence->save();
        return redirect()->back();
    }
}

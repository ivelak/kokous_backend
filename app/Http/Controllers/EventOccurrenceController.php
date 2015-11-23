<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\EventOccurrence;
use Carbon\Carbon;

class EventOccurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eventOccurrences = EventOccurrence::with('event')->orderBy('date', 'asc')->paginate($request->input('perpage', 15));
        return view('eventOccurrences', compact('eventOccurrences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $occId)
    {
        //
        $eventOccurrence = EventOccurrence::with(['comments'])->where('event_id', $id)->findOrFail($occId);
        $activitiesCompleted = collect([]);
        foreach($eventOccurrence->activities as $activity)
        {
            $usersWhoHaveCompleted = collect([]);
            foreach($eventOccurrence->event->group->users as $user)
            {
                $usersWhoHaveCompleted->push($user->id);
            }
            $activitiesCompleted->put($activity->id, $usersWhoHaveCompleted);
        }
        
        return view('eventOccurrence', compact('eventOccurrence'), compact('activitiesCompleted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $occId)
    {
        $eventOccurrence = EventOccurrence::where('event_id', $id)->findOrFail($occId);
        return view('editEventOccurrence', compact('eventOccurrence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $occId)
    {
        $this->validate($request, [
            'time' => 'required|date_format:H:i',
            'place' => 'required|max:128'
        ]);
        $event = EventOccurrence::where('event_id', $id)->findOrFail($occId);
        $event->time = Carbon::createFromFormat('H:i', $request->input('time'));
        $event->place = $request->input('place');
        $event->save();

        return redirect()->action('EventOccurrenceController@show', [$id, $occId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

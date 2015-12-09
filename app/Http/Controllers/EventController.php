<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use App\EventOccurrence;
use App\Group;
use Carbon\Carbon;
use Gate;

class EventController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        //
        $events = Event::with('group')->paginate($request->input('perpage', 15));

        return view('events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $groups = Group::all();
        return view('newEvent', compact('groups'));
    }

    public function createForGroup($id) {        
        $group = Group::FindOrFail($id);
        

        if (Gate::allows('manageForGroup', $group)) {
            return view('newEvent', compact('id'));
        } else {
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:64',
            'date' => 'required|date_format:d.m.Y|after:' . Carbon::now(),
            'time' => 'required|date_format:H:i',
            'place' => 'required|max:128'
        ]);

        $event = new Event();
        $event->name = $request->input('name');
        $event->time = Carbon::createFromFormat('d.m.Y H:i', $request->input('date') . ' ' . $request->input('time'));
        $event->place = $request->input('place');
        $event->description = $request->input('description');
        $event->group_id = $request->input('groupId');

        $group = Group::FindOrFail($request->input('groupId'));

        if (Gate::allows('manageForGroup', $group)) {
            $days = collect($request->input('days'));
            $date = Carbon::createFromFormat('d.m.Y', $request->input('date'));
            $endDate = $date->copy();
            $startDate = $date->copy();

            $interval = $request->input('interval');

            if ($request->input('repeat') != NULL) {
                $ending = $request->input('ending');
                $endDate = $ending == "afterYear" ? $endDate->addYear() : Carbon::createFromFormat('d.m.Y', $request->input('endDate'));
            }
            $event->endDate = $endDate;
            $event->save();

            do {
                if (($days->contains($date->dayOfWeek) && (($startDate->diffInWeeks($date)) % $interval) == 0) || $request->input('repeat') == NULL) {
                    $occurrence = new EventOccurrence();
                    $occurrence->event_id = $event->id;
                    $occurrence->date = $date;
                    $occurrence->save();
                }
                $date->addDay();
            } while ($date < $endDate);


            return redirect('events');
        } else {
            return abort(403);
        }
    }

    public function storeNoRedirect(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:64',
            'date' => 'required|date_format:d.m.Y|after:' . Carbon::now(),
            'time' => 'required|date_format:H:i',
            'place' => 'required|max:128'
        ]);

        $event = new Event();
        $event->name = $request->input('name');
        $event->time = Carbon::createFromFormat('d.m.Y H:i', $request->input('date') . ' ' . $request->input('time'));
        $event->place = $request->input('place');
        $event->description = $request->input('description');
        $event->group_id = $request->input('groupId');

        $group = Group::FindOrFail($request->input('groupId'));

        if (Gate::allows('manageForGroup', $group)) {

            $days = collect($request->input('days'));
            $date = Carbon::createFromFormat('d.m.Y', $request->input('date'));
            $endDate = $date->copy();
            $startDate = $date->copy();

            $interval = $request->input('interval');

            if ($request->input('repeat') != NULL) {
                $ending = $request->input('ending');
                $endDate = $ending == "afterYear" ? $endDate->addYear() : Carbon::createFromFormat('d.m.Y', $request->input('endDate'));
            }
            $event->endDate = $endDate;
            $event->save();

            do {
                if (($days->contains($date->dayOfWeek) && (($startDate->diffInWeeks($date)) % $interval) == 0) || $request->input('repeat') == NULL) {
                    $occurrence = new EventOccurrence();
                    $occurrence->event_id = $event->id;
                    $occurrence->date = $date;
                    $occurrence->save();
                }
                $date->addDay();
            } while ($date < $endDate);


            return redirect('activity_planning/planner');
        } else {
            return abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $event = Event::with(['group', 'eventOccurrences'])->findOrFail($id);
        $eventOccurrences = EventOccurrence::where('event_id', $id)->paginate();
        return view('event', compact('event', 'eventOccurrences'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $event = Event::findOrFail($id);

        if (Gate::allows('manage', $event)) {
            return view('editEvent', compact('event'));
        } else {
            return abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|max:64',
            'time' => 'required|date_format:H:i',
            'place' => 'required|max:128'
        ]);

        $event = Event::findOrFail($id);

        if (Gate::allows('manage', $event)) {
            $event->name = $request->input('name');
            $event->time = Carbon::createFromFormat('d.m.Y H:i', $event->time->format('d.m.Y') . ' ' . $request->input('time'));
            $event->place = $request->input('place');
            $event->description = $request->input('description');
            $event->save();

            return redirect()->action('EventController@show', [$event]);
        } else {
            return abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $event = Event::findOrFail($id);

        if (Gate::allows('manage', $event)) {
            Event::destroy($id);
            return redirect('events');
        } else {
            return abort(403);
        }
    }

}

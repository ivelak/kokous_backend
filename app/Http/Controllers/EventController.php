<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use Carbon\Carbon;

class EventController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        //
        $events = Event::paginate($request->input('perpage', 15));

        return view('events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('newEvent');
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
//            'endDate' => 'required|date_format:d.m.Y|after:' . Carbon::now(),
            'place' => 'required|max:128'
        ]);

        $event = new Event();
        $event->name = $request->input('name');
        $event->time = Carbon::createFromFormat('d.m.Y H:i', $request->input('date') . ' ' . $request->input('time'));
        $event->place = $request->input('place');
        $event->endDate = Carbon::createFromFormat('d.m.Y', $request->input('endDate'));
        $event->description = $request->input('description');
        $event->save();

        return redirect('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $event = Event::findOrFail($id);
        return view('event', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $event = Event::findOrFail($id);
        return view('editEvent', compact('event'));
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
            'date' => 'required|date_format:d.m.Y|after:' . Carbon::now(),
            'time' => 'required|date_format:H:i',
            'endDate' => 'required|date_format:d.m.Y|after:' . Carbon::now(),
            'place' => 'required|max:128'
        ]);
        $event = Event::findOrFail($id);
        $event->name = $request->input('name');
        $event->time = Carbon::createFromFormat('d.m.Y H:i', $request->input('date') . ' ' . $request->input('time'));
        $event->place = $request->input('place');
        $event->endDate = Carbon::createFromFormat('d.m.Y', $request->input('endDate') . ' ' . $request->input('endDate'));
        $event->description = $request->input('description');
        $event->save();

        return redirect()->action('EventController@show', [$event]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Event::destroy($id);
        return redirect('events');
    }

}

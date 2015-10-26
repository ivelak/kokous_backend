
<!DOCTYPE html>
@extends('templates.master')
@section('title', 'Tapahtuma')
@section('content')

<div class="container">
    <h1>{{ $eventOccurrence->event->name }}</h1>
    <hr>
    <div class="panel">
        {!!link_to_action('OccurrenceActivityController@index', $title = 'Muuta aktiviteetteja', ['occId' => $eventOccurrence->id, 'id' => $eventOccurrence->event->id], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Päivä: </strong>{{ $eventOccurrence->date->format('d.m.Y') }}</li>
                <li><strong>Aika: </strong>{{ $eventOccurrence->time->format('H:i') }}</li>
                <li><strong>Paikka: </strong>{{ $eventOccurrence->place }}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kuvaus:</strong></div>
        <div class="panel-body">
            {{ empty($eventOccurrence->event->description) ? 'Ei kuvausta' : $eventOccurrence->event->description}}
        </div>
    </div>
</div>

@endsection

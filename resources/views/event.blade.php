
<!DOCTYPE html>
@extends('templates.master')
@section('title', 'Aktiviteetti')
@section('content')

<div class="container">
    <h1>{{ $event->name }} <small>{{$event->group->name}}</small></h1>
    <hr>
    <div class="panel">

        {!!Form::open(array('action' => ['EventController@destroy', $event], 'method'=>'delete', 'class'=>'form-inline'))!!}
        {!!link_to_action('EventController@edit', $title = 'Muokkaa tapahtumaa', ['id' => $event->id], $attributes = array('class'=>'btn btn-default'))!!}
        {!!link_to_action('EventActivityController@index', $title = 'Muuta aktiviteetteja', ['id' => $event->id], $attributes = array('class'=>'btn btn-default'))!!}
        {!!Form::submit('Poista', ['onclick'=>'return confirm("Haluatko varmasti poistaa tapahtuman?")', 'class' => 'btn btn-default pull-right'])!!}
        {!!Form::close()!!}

    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Päivä: </strong>{{ $event->time->format('d.m.Y') }}</li>
                <li><strong>Aika: </strong>{{ $event->time->format('H:i') }}</li>
                <li><strong>Paikka: </strong>{{ $event->place }}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kuvaus:</strong></div>
        <div class="panel-body">
            {{ empty($event->description) ? 'Ei kuvausta' : $event->description}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tapahtuman toistot:</strong></div>
        <table class="table">
            @forelse($eventOccurrences as $eventOccurrence)
            <tr>
                <td>{{$eventOccurrence->date->format('d.m.Y')}}</td>
            </tr>
            @empty
            <tr>
                <td>Ei merkittyjä toistoja</td>
            </tr>
            @endforelse</tr>

        </table>

    </div>
    <div>{!!$eventOccurrences->render()!!}</div>
</div>

@endsection
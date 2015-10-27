
@extends('templates.master')

@section('title', 'Muokkaa tapahtumaa')

@section('content')

<div class="container">

    <h1 class="page-header"> {{ $eventOccurrence->name }} <small>{{ $eventOccurrence->date->format('D d.m.y') }}</small></h1>
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="well">
        {!! Form::model($eventOccurrence, array('action' => ['EventOccurrenceController@update', $eventOccurrence->event, $eventOccurrence], 'method' => 'put','role' => 'form')) !!}

        <div class="form-group">
            {!!Form::label('time', 'Aika:')!!}<br/>
            {!!Form::text('time', $eventOccurrence->time->format('H:i'), ['class'=>'form-control', 'placeholder'=>'hh:mm'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('place', 'Paikka:')!!}<br/>
            {!!Form::text('place', old('place'), ['class'=>'form-control', 'placeholder'=>'Tapahtumapaikka'])!!}
        </div>

        {!!Form::submit('Tallenna muutokset', ['class' => 'btn btn-default'])!!}
        {!!link_to_action('EventOccurrenceController@show', $title = 'Peruuta', ['occId' => $eventOccurrence->id, 'id' => $eventOccurrence->event->id], $attributes = array('class'=>'btn btn-default pull-right'))!!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

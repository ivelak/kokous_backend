
@extends('templates.master')

@section('title', 'Muokkaa tapahtumaa')

@section('content')

<div class="container">

    <h1> {{ $event->name }} </h1> <hr />
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="well">
        {!! Form::model($event, array('action' => ['EventController@update', $event->id], 'method' => 'put','role' => 'form')) !!}

        <div class="form-group">
            {!!Form::label('name', 'Tapahtuman nimi:')!!}<br/>
            {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi tapahtumalle'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('time', 'Aika:')!!}<br/>
            {!!Form::text('time', $event->time->format('H:i'), ['class'=>'form-control', 'placeholder'=>'hh:mm'])!!}
        </div>
        
        <div class="form-group">
            {!!Form::label('place', 'Paikka:')!!}<br/>
            {!!Form::text('place', old('place'), ['class'=>'form-control', 'placeholder'=>'Tapahtumapaikka'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('description', 'Kuvaus:')!!}
            {!!Form::textarea('description', old('description'), ['rows'=>'5', 'class'=>'form-control', 'placeholder'=>'Tapahtuman kuvaus'])!!}
        </div>

        {!!Form::submit('Tallenna muutokset', ['class' => 'btn btn-default'])!!}
        {!!link_to_action('EventController@show', $title = 'Peruuta', ['id' => $event->id], $attributes = array('class'=>'btn btn-default pull-right'))!!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
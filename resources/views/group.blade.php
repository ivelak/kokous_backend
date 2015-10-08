<!DOCTYPE html>
@extends('templates.master')
@section('title', 'Ryhmä')
@section('content')

<div class="container">
    <h1>{{ $group->name }}</h1>
    <hr>

    <div class="panel">

        {!!Form::open(array('action' => ['GroupController@destroy', $group], 'method'=>'delete', 'class'=>'form-inline'))!!}
        {!!link_to_action('GroupController@edit', $title = 'Muokkaa ryhmää', ['id' => $group->id], $attributes = array('class'=>'btn btn-default'))!!}
        {!!Form::submit('Poista', ['onclick'=>'return confirm("Haluatko varmasti poistaa ryhmän?")', 'class' => 'btn btn-default pull-right'])!!}
        {!!Form::close()!!}

    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Ryhmän nimi: </strong>{{ $group->name}}</li>               
                <li><strong>Lippukunta: </strong>{{ $group->scout_group }}</li>
                <li><strong>Ikäryhmä: </strong>{{ $group-> age_group }}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" href="#collapse1"><strong>Jäsenet: </strong></a>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <ul class="list-group">
                <li class="list-group-item">Jeee</li>
                <li class="list-group-item">Jeee1</li>
            </ul>
        </div> 
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" href="#collapse2"><strong>Tulevat tapahtumat: </strong></a>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <ul class="list-group">
                @forelse($group->events()->get() as $event)
                <li class="list-group-item">{{$event -> name}}</li>
                @empty
                <li class="list-group-item"><p><strong> Ei lisättyjä tapahtumia</strong></p></li>
                @endforelse
            </ul>
        </div>
    </div>

    @endsection

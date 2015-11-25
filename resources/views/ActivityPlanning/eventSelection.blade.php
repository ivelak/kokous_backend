@extends('templates.master')

@section('title', 'Valitse tapahtumat')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>Valitse Tapahtumat</h1>
    </div>
    {!! Form::open(['url' => '#', 'class' => '']) !!}
    <div class="panel-group">
        @forelse($eventPatterns as $eventPattern)
        <div class="panel">
            <div class="panel-heading">
                <input type="checkbox" name="eventPatterns[]" value="{{ $eventPattern->id }}" class="pull-right">
                <h3>{{ucfirst($eventPattern->name)}} <span class="small"><a data-toggle="collapse" href="#{{str_slug($eventPattern->name)}}">aktiviteetit</a></span></h3>
            </div>
            <div id="{{str_slug($eventPattern->name)}}" class="panel-collapse collapse">
                <ul class="list-group">
                    @foreach($eventPattern->activities as $activity)
                    <li class="list-group-item">{{$activity->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @empty
        <h3>Ei tapahtumapohjia</h3>
        @endforelse
    </div>
    <button class="btn btn-default" onclick="confirm('Oletko varma?')">Nollaa valinnat</button>
    <input type="submit" class="btn btn-primary" value="Seuraava"></button>
    {!! Form::close() !!}
</div>
@endsection
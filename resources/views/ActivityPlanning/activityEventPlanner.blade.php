@extends('templates.master')

@section('title', 'Valitse tapahtumat')

@section('content')

<div class="container-fluid">
    {!! Form::open(['url' => '#']) !!}
    <div class="row">
        <div class="col-sm-4">
            <h3>Aktiviteetit</h3>
            <div class="well">
                <ul class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)" ondragstart="drag(event)" style="min-height: 5em">
                    @foreach($activities as $activity)
                    <li class="list-group-item" draggable="true" id="{{$activity->id}}">{{$activity->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Tapahtumapohjat</h3>
            <div class="well">
                @foreach($eventPatterns as $eventPattern)
                <ul class="list-group event-draggable">
                    <h4 class="list-group-item-heading">{{$eventPattern->name}}</h4>
                    <ul class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)" ondragstart="drag(event)">
                        @foreach($eventPattern->activities as $activity)
                        <li class="list-group-item" draggable="false">{{$activity->name}}<span class="glyphicon glyphicon-lock pull-right"></span></li>
                        @endforeach
                    </ul>
                </ul>
                @endforeach
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Toimintasuunnitelma</h3>
            <div class="well">
            </div>
        </div>
    </div>
    <button class="btn btn-default" onclick="confirm('Oletko varma?')">Nollaa valinnat</button>
    <input type="submit" class="btn btn-primary" value="Seuraava"></button>
    {!! Form::close() !!}
</div>

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    //$(ev.target).addClass('list-group-item-info');
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var target = $(ev.target);
    
    if(!target.is('ul'))
    {
        target.parent('ul').append(document.getElementById(data));
    }
    else
    {
        target.append(document.getElementById(data));
    }
}
</script>
@endsection
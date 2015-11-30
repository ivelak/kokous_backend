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
            <div class="well" style="max-height: 500px; overflow-y:scroll;">
                @foreach($events as $event)
                <ul class="list-group event-draggable">
                    <h4 class="list-group-item-heading">{{$event->event->name}}</h4>
                    <ul class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)" ondragstart="drag(event)">
                        @foreach($event->activities as $activity)
                        <li class="list-group-item" draggable="false">{{$activity->name}}<span class="glyphicon glyphicon-lock pull-right"></span></li>
                        @endforeach
                    </ul>
                </ul>
                @endforeach
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                  Luo uusi tapahtuma
                </button>
            </div>
            <strong>Tapahtumien aikaväli</strong>
            <br>
            <div id="slider"></div>
        </div>
    </div>
    <button class="btn btn-default" onclick="confirm('Oletko varma?')">Nollaa valinnat</button>
    <input type="submit" class="btn btn-primary" value="Seuraava"></button>
    {!! Form::close() !!}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Luo tapahtuma</h4>
                      </div>
                      <div class="modal-body">
                        {!! Form::open(array('action' => 'EventController@storeNoRedirect', 'role' => 'form', 'id' => 'create_event')) !!}

                    <div class="form-group">
                        {!!Form::label('name', 'Tapahtuman nimi:')!!}<br/>
                        {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi tapahtumalle'])!!}
                    </div>
                    @if(isset($id))
                    {!!Form::hidden('groupId', $id)!!}
                    @else
                    <div class="form-group">

                        {!!Form::label('groups', 'Valitse ryhmä:')!!}
                        <select class="form-control sieve" name="groupId" id="groups">
                            @forelse($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>             
                            @empty
                            <option disabled value=""> Ei ryhmiä</option>
                            @endforelse
                        </select>
                    </div>
                    @endif

                    <div class="form-group"> 
                        {!!Form::label('date', 'Päiväys:')!!}<br/>
                        {!!Form::text('date', old('date'), ['class'=>'form-control', 'placeholder'=>'dd.mm.yyyy'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('time', 'Aika:')!!}<br/>
                        {!!Form::text('time', old('time'), ['class'=>'form-control', 'placeholder'=>'hh:mm'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('repeat', 'Toisto:')!!}
                        {!!Form::checkbox('repeat', old('repeat'), ['class'=>'form-control'])!!}<br/>
                    </div>

                    <div class="form-group">

                        @foreach (array( 1 => 'Ma', 2 => 'Ti', 3 => 'Ke', 
                        4 => 'To', 5 => 'Pe', 6 => 'La', 7 => 'Su' )as $i => $weekday)

                        {!!Form::label($weekday, $weekday)!!}
                        <input type="checkbox" name="days[]" value="{{$i}}" id="{{$weekday}}" class="checkbox-inline"/>
                        @endforeach          
                    </div>

                    <div class="form-group">
                        {!!Form::label('interval', 'Toistoväli:')!!}           
                        {!!Form::select('interval', array(1=>'1',2=>'2',3=>'3',4=>'4'), ['class'=>'form-control'])!!}
                        {!!Form::label('interval', 'viikon välein.')!!}   
                    </div>

                    <div class="form-group">
                        {!!Form::label('ending', 'Päättyy:')!!}<br/>
                        <input type="radio" name="ending" value="afterYear" checked> Vuoden päästä

                        <div class="input-group">

                            <span class=""><input type="radio" name="ending" value="until"> Päivänä </span>
                            {!!Form::text('endDate', old('endDate'), ['class'=>'form-control', 'placeholder'=>'dd.mm.yyyy'])!!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('place', 'Paikka:')!!}<br/>
                        {!!Form::text('place', old('place'), ['class'=>'form-control', 'placeholder'=>'Tapahtumapaikka'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('description', 'Kuvaus:')!!}
                        {!!Form::textarea('description', old('description'), ['rows'=>'5', 'class'=>'form-control', 'placeholder'=>'Tapahtuman kuvaus'])!!}
                    </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
                        {!!Form::submit('Tallenna', ['class' => 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>
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
$(function() {
    $( "#slider" ).slider();
});
</script>
@endsection
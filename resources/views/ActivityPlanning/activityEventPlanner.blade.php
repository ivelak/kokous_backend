@extends('templates.master')

@section('title', 'Valitse tapahtumat')

@section('content')

<div class="container">
    {!! Form::open(['url' => '#']) !!}
    <div class="panel-group">
        {--@foreach($activitiesByAgeGroups as $ageGroupName => $ageGroup)
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" href="#{{$ageGroupName}}"><h3>{{ucfirst($ageGroupName)}}</h3></a>
            </div>
            <div id="{{$ageGroupName}}" class="panel-collapse collapse">
                <ul class="list-group">
                    @foreach($ageGroup as $taskGroup)
                    @foreach($taskGroup as $taskGroupName => $tasks)
                    
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#{{str_slug($taskGroupName)}}" ><h4>{{ucfirst($taskGroupName)}}</h4></a>
                            </div>
                            <div id="{{str_slug($taskGroupName)}}" class="panel-collapse collapse">

                                <ul class="list-group">
                                    @foreach($taskGroup as $activity)
                                    @foreach($activity as $a)
                                    <li class="list-group-item">{{$a->name}} <input name="activities[]" value="{{$a->id}}" type="checkbox" class="pull-right"/></li>
                                    @endforeach
                                    @endforeach
                                </ul>           

                            </div>
                        </div>
 
                    @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach --}
    </div>
    <button class="btn btn-default" onclick="confirm('Oletko varma?')">Nollaa valinnat</button>
    <input type="submit" class="btn btn-primary" value="Seuraava"></button>
    {!! Form::close() !!}
</div>
@endsection
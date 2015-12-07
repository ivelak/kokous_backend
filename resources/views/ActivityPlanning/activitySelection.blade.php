
@extends('templates.master')

@section('title', 'Valitse aktiviteetit')

@section('content')

<div class="container">
    {!! Form::open(['action' => 'ActivityPlanningController@selectActivities']) !!}
    <div class="panel-group">
        @foreach($activitiesByAgeGroups as $ageGroupName => $ageGroup)
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
                                <a data-toggle="collapse" href="#{{str_slug($taskGroupName)}}" ><h4>{{ucfirst($taskGroupName)}}</a><input id="{{str_slug($taskGroupName)}}-checkall" onchange="selectAllFromTaskGroup(this.id, '{{str_slug($taskGroupName)}}-list')" type="checkbox" class="pull-right"/></h4>
                            </div>
                            <div id="{{str_slug($taskGroupName)}}" class="panel-collapse collapse">

                                <ul class="list-group" id="{{str_slug($taskGroupName)}}-list">
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
        @endforeach
    </div>
    <div class="container">
        {!!Form::label('groups', 'Valitse ryhmä:')!!}
            <select class="form-control sieve" name="groupId" id="groups">
                @forelse($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>             
                @empty
                <option disabled value=""> Ei ryhmiä</option>
                @endforelse
            </select>
    </div>
    <hr>
    <div class="btn-group pull-right" role="group">
        <button class="btn btn-default" onclick="confirm('Oletko varma?')">Nollaa valinnat</button>
        <input type="submit" class="btn btn-primary" value="Seuraava"></button>
    </div>
    {!! Form::close() !!}
</div>

@endsection
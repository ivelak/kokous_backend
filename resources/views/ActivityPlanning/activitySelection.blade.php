
@extends('templates.master')

@section('title', 'Valitse aktiviteetit')

@section('content')

<div class="container">
    @foreach($activitiesByAgeGroups as $ageGroupName => $ageGroup)
    <h3>{{$ageGroupName}}</h3>
    <ul>
        @foreach($ageGroup as $taskGroup)
        @foreach($taskGroup as $taskGroupName => $tasks)
        <li><ul>
            <h4>{{$taskGroupName}}</h4>
            @foreach($taskGroup as $activity)
                @foreach($activity as $a)
                <li>{{$a->name}}</li>
                @endforeach
            @endforeach
        </ul></li>
        @endforeach
        @endforeach
    </ul>
    @endforeach
</div>
@endsection
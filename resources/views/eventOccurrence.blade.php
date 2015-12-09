
@extends('templates.master')
@section('title', 'Tapahtuma')
@section('content')

<div class="container">
    {!! Form::open(['action' => ['UserActivityController@addMany', 'id' => $eventOccurrence->event->id, 'occId' => $eventOccurrence->id, 'class'=>'form-inline']])!!}
    <h1>{{ $eventOccurrence->event->name }}</h1>
    <hr>
    
    @can('manage',$eventOccurrence->event)
    
    <div class="panel">
        {!!link_to_action('OccurrenceActivityController@index', $title = 'Muuta aktiviteetteja', ['occId' => $eventOccurrence->id, 'id' => $eventOccurrence->event->id], $attributes = array('class'=>'btn btn-default'))!!}
        {!!link_to_action('EventOccurrenceController@edit', $title = 'edit', ['id' => $eventOccurrence->event, 'occId' => $eventOccurrence], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    
    @endcan
    
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Päivä: </strong>{{ $eventOccurrence->date->format('d.m.Y') }}</li>
                <li><strong>Aika: </strong>{{ $eventOccurrence->time->format('H:i') }}</li>
                <li><strong>Paikka: </strong>{{ $eventOccurrence->place }}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kuvaus:</strong></div>
        <div class="panel-body">
            {{ empty($eventOccurrence->event->description) ? 'Ei kuvausta' : $eventOccurrence->event->description}}
        </div>
    </div>
    
    @can('manage',$eventOccurrence->event)
    
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Suoritusten merkitseminen:</strong></div>
        <div class="panel-body">
            @if(count($eventOccurrence->activities) == 0)
            <p>Tapahtumaan ei sisälly aktiviteettejä</p>
            @else
            {!! Form::select('activityId', $eventOccurrence->activities->keyBy('id')->map(function ($item, $key) {return $item->name; }), null, ['class'=>'form-control']) !!}
            <br>

            @foreach($eventOccurrence->activities as $activity)
            <div id="{{$activity->id}}" style="display:none" name="activityBox">
                <ul class="list-group">
                    @foreach($eventOccurrence->event->group->members as $user)
                    @if($user->activities->contains($activity))
                    <li class="list-group-item list-group-item-success">
                        {{ $user->firstname . ' ' . $user->lastname }}
                    </li>
                    @else
                    <li class="list-group-item">
                        {{ $user->firstname . ' ' . $user->lastname }}<input type="checkbox" name="{{$user->id}}" class="pull-right">
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endforeach
            @endif
        </div>
        @if(count($eventOccurrence->activities) > 0)
        <div class="panel-footer">
            {!! Form::hidden('group', $eventOccurrence->event->group->id)!!}
            <button class="btn btn-default pull-left" onclick="selectAll()" type="button">Valitse kaikki</button>
            {!! Form::submit('Merkitse suoritetuiksi', ['class'=>'btn btn-primary pull-right']) !!}

            <div class="clearfix"></div>
        </div>
        @endif

    </div>
    
    @endcan
    
    {!! Form::close()!!}

    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kommentit:</strong></div>
        <div class="panel-body">

            @forelse($eventOccurrence->comments as $comment)
            <div class="well">
                <p>
                    {{$comment->comment}}
                </p>
                <br>

                {!! Form::open(['action' => ['CommentController@destroy'],'method'=>'delete'])!!}
                {!! Form::submit('poista',['class'=>'btn-link pull-right'])!!}
                {!! Form::hidden('id',$comment->id)!!}
                {!! Form::close()!!}

                <p>
                    {{$comment->user->firstname . ' ' . $comment->user->lastname . ' - ' . $comment->created_at->format('d.m.Y - H:i')}}
                </p>
            </div>
            @empty
            <p>Ei kommentteja!</p>


            @endforelse

        </div>
    </div>

    @include('newComment')

    <br>
</div>

<script>
    function toggle(source) {
        checkboxes = $("input:checkbox")
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source;
        }
    }

    function selectAll() {
        var activities = document.getElementsByName('activityBox');
        [].forEach.call(activities, function (a) {
            if (a.style.display === 'block')
            {
                var checkboxes = a.getElementsByTagName('input');
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    checkboxes[i].checked = true;
                }
            }
        });
    }

    $(document).ready(function () {
        var id = document.getElementsByName('activityId')[0].value;
        document.getElementById(id).style.display = 'block';
    });

    $('select').on('change', function () {
        toggle(false);
        var activities = document.getElementsByName('activityBox');
        [].forEach.call(activities, function (a) {
            a.style.display = 'none';
        });
        document.getElementById(this.value).style.display = 'block';
    });
</script>

@endsection

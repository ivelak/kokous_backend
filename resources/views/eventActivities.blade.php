
@extends('templates.master')
@section('title', 'Muuta aktiviteetteja')
@section('scripts')
@include('templates.linkRow')
@endsection
@section('content')
<div class="container">
    <h1>{{ $eventOccurrence->name }} - Aktiviteetit</h1>
    <hr>
    <div class="panel">
        <div class="form-group">
            {!! Form::open(['action' => ['OccurrenceActivityController@add', 'occId' => $eventOccurrence->id, 'id' => $eventOccurrence->event->id], 'class'=>'form-inline'])!!}
            {!! Form::select('activityId', $activities->keyBy('id')->map(function ($item, $key) {return $item->name; }), null, ['class'=>'form-control']) !!}
            {!! Form::submit('Lisää', ['class'=>'btn btn-default']) !!}
            {!!link_to_action('EventOccurrenceController@show', $title = 'Takaisin', ['id' => $eventOccurrence->id, 'occId' => $eventOccurrence], $attributes = array('class'=>'btn btn-default pull-right'))!!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Aktiviteetit:</strong></div>
        <table class="table">
            @forelse($eventOccurrence->activities()->get() as $activity)
            <tr id="{{$activity->id}}" class="tr-link">
                <td>
                    {!!Form::open(array('action' => ['OccurrenceActivityController@remove', $eventOccurrence->event, $eventOccurrence], 'method'=>'delete', 'class'=>'form-inline'))!!}
                    {{$activity->name}}
                    {!!Form::hidden('activityId', $activity->id)!!}
                    {!!Form::submit('Poista', ['class' => 'btn btn-default btn-xs pull-right'])!!}
                    {!!Form::close()!!}
                </td>
            </tr>
            @empty
            <tr>
                <td>Ei merkittyjä aktiviteetteja</td>
            </tr>
            @endforelse</tr>
        </table>
    </div>
</div>
@endsection

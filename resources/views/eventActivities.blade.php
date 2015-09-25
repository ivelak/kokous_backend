
@extends('templates.master')
@section('title', 'Muuta aktiviteetteja')
@section('content')
<div class="container">
    <h1>{{ $event->name }} - Aktiviteetit</h1>
    <hr>
    <div class="panel">
        <div class="form-group">
            {!! Form::open(['action' => ['EventActivityController@add', $event], 'class'=>'form-inline'])!!}
            {!! Form::select('activityId', $activities->keyBy('id')->map(function ($item, $key) {return $item->name; }), null, ['class'=>'form-control']) !!}
            {!! Form::submit('Lisää', ['class'=>'btn btn-default']) !!}
            {!!link_to_action('EventController@show', $title = 'Takaisin', ['id' => $event->id], $attributes = array('class'=>'btn btn-default pull-right'))!!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Aktiviteetit:</strong></div>
        <table class="table">
            @forelse($event->activities()->get() as $activity)
            <tr>
                <td>
                   {!!Form::open(array('action' => ['EventActivityController@remove', $event], 'method'=>'delete', 'class'=>'form-inline'))!!}
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

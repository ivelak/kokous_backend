
@extends('templates.master')
@section('title', 'Muuta suorituksia')
@section('content')
<div class="container">
    <h1>{{ $user->username }} - Suoritukset</h1>
    <hr>
    <div class="panel">
        <div class="form-group">
            {!! Form::open(['action' => ['UserActivityController@add', $user], 'class'=>'form-inline'])!!}
            {!! Form::select('activityId', $activities->keyBy('id')->map(function ($item, $key) {return $item->name; }), null, ['class'=>'form-control']) !!}
            {!! Form::submit('Lisää', ['class'=>'btn btn-default']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Suoritukset:</strong></div>
        <table class="table">
            @forelse($user->activities()->get() as $activity)
            <tr>
                <td>
                   {!!Form::open(array('action' => ['UserActivityController@remove', $user], 'method'=>'delete', 'class'=>'form-inline'))!!}
                    {{$activity->name}}
                    {!!Form::hidden('activityId', $activity->id)!!}
                    {!!Form::submit('Poista suoritus', ['class' => 'btn btn-default btn-xs pull-right'])!!}
                    {!!Form::close()!!}
                </td>
            </tr>
            @empty
            <tr>
                <td>Ei merkittyjä suorituksia</td>
            </tr>
            @endforelse</tr>
        </table>
    </div>
</div>
@endsection

@extends('templates.master')
@section('title', 'Lisää jäseniä')
@section('scripts')
@include('templates.linkRow')
@endsection
@section('content')
<div class="container">
    <h1>{{ $group->name }} - Jäsenet</h1>
    <hr>
    <div class="panel">
        <div class="form-group">
            {!! Form::open(['action' => ['GroupUserController@add', $group], 'class'=>'form-inline'])!!}
            {!! Form::select('userId', $users->keyBy('id')->map(function ($item, $key) {return $item->username; }), null, ['class'=>'form-control']) !!}
            {!! Form::submit('Lisää ryhmän jäsen', ['class'=>'btn btn-default', 'name'=> 'addLeader']) !!}
            {!!link_to_action('GroupController@show', $title = 'Takaisin', ['id' => $group->id], $attributes = array('class'=>'btn btn-default pull-right'))!!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Ryhmän jäsenet:</strong></div>
        <table class="table">
            @forelse($group->users()->where('role','member')->get() as $user)
            <tr id="{{$user->id}}" class="tr-link">
                <td>
                    {!!Form::open(array('action' => ['GroupUserController@remove', $group], 'method'=>'delete', 'class'=>'form-inline'))!!}
                    {{$user->username}}
                    {!!Form::hidden('userId', $user->id)!!}
                    {!!Form::submit('Poista', ['class' => 'btn btn-default btn-xs pull-right'])!!}
                    {!!Form::close()!!}
                </td>
            </tr>
            @empty
            <tr>
                <td>Ei lisättyjä ryhmäläisiä</td>
            </tr>
            @endforelse</tr>
        </table>
    </div>
</div>
@endsection


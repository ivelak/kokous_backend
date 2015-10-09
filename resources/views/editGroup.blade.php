
@extends('templates.master')

@section('title', 'Muokkaa ryhmää')

@section('content')

<div class="container">

    <h1> {{ $group->name }} </h1> <hr />
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
             <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="well">
        {!! Form::model($group, array('action' => ['GroupController@update', $group->id], 'method' => 'put','role' => 'form')) !!}

        <div class="form-group">
            {!!Form::label('name', 'Ryhmän nimi:')!!}<br/>
            {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi ryhmälle'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('scout_group', 'Lippukunta:')!!}<br/>
            {!!Form::text('scout_group', old('scout_group'), ['class'=>'form-control', 'placeholder'=>'Lippukunta'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('age_group', 'Ikäryhmä:')!!}
            {!!Form::text('age_group', old('age_group'), ['class'=>'form-control', 'placeholder'=>'Ikäryhmä'])!!}
        </div>
        
        {!!Form::submit('Tallenna muutokset', ['class' => 'btn btn-default'])!!}
        {!!link_to_action('GroupController@show', $title = 'Peruuta', ['id' => $group->id], $attributes = array('class'=>'btn btn-default pull-right'))!!}
        {!! Form::close() !!}
    </div>   
</div>
@endsection

@extends('templates.master')

@section('title', 'Ryhmän lisäys')

@section('content')

<div class="container">

    <h1> Ryhmän lisäys: </h1> <hr />
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="well">
        {!! Form::open(array('action' => 'GroupController@store', 'role' => 'form')) !!}

        <div class="form-group">
            {!!Form::label('name', 'Ryhmän nimi:')!!}<br/>
            {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi ryhmälle'])!!}
        </div>

        <div class="form-group"> 
            {!!Form::label('scout_group', 'Lippukunta:')!!}<br/>
            {!!Form::text('scout_group', old('scout_group'), ['class'=>'form-control', 'placeholder'=>'Lippukunnan nimi'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('age_group', 'Ikäryhmä:')!!}<br/>
            {!!Form::text('age_group', old('age_group'), ['class'=>'form-control', 'placeholder'=>'Ikäryhmä'])!!}
        </div>

        <div class="form-group">
            
            {!!Form::label('participants', 'Lisää ryhmäläisiä:')!!}
            <select multiple="multiple" class="form-control" name="participants[]" id="participants">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!!Form::label('participants2', 'Lisää ryhmänjohtajat:')!!}
            {!!Form::select('participants2[]', ['jaakko', 'kake', 'asd', 'dafs'], null, ['class'=>'form-control', 'multiple'=>'multiple'])!!}
        </div>
        {!!Form::submit('Lisää ryhmä', ['class' => 'btn btn-default'])!!}
        {!!link_to_action('GroupController@index', $title = 'Peruuta', [], $attributes = array('class'=>'btn btn-default pull-right'))!!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

@extends('templates.master')

@section('title', 'Tapahtuman lisäys')

@section('content')

<div class="container">
   
    <h1> Tapahtuman lisäys: </h1> <hr />
     <div class="well">
    {!! Form::open(array('action' => 'EventController@store', 'role' => 'form')) !!}

    <div class="form-group">
        {!!Form::label('name', 'Tapahtuman nimi:')!!}<br/>
        {!!Form::text('name', old('name'), ['class'=>'form-control'])!!}
    </div>

    <div class="form-group"> 
        {!!Form::label('date', 'Päiväys:')!!}<br/>
        {!!Form::text('date', old('date'), ['class'=>'form-control', 'placeholder'=>'dd.mm.yyyy'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('time', 'Aika:')!!}<br/>
        {!!Form::text('time', old('time'), ['class'=>'form-control', 'placeholder'=>'hh:mm'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('place', 'Paikka:')!!}<br/>
        {!!Form::text('place', old('place'), ['class'=>'form-control'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('description', 'Kuvaus:')!!}
        {!!Form::textarea('description', old('description'), ['rows'=>'5', 'class'=>'form-control'])!!}
    </div>

    {!!Form::submit('Lisää tapahtuma!', ['class' => 'btn btn-default'])!!}
</form>{!! Form::close() !!}
</div>
</div>
@endsection
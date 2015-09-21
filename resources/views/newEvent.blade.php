
@extends('templates.master')

@section('title', 'Tapahtuman lisäys')

@section('content')

<div class="container">

    <h1> Tapahtuman lisäys: </h1> <hr />
    {!! Form::open(array('action' => 'EventController@store')) !!}

    <div class="form-group">
        {!!Form::label('name', 'Tapahtuman nimi:')!!}<br/>
        {!!Form::text('name', null, ['class'=>'form-control'])!!}
    </div>

    <div class="form-group"> 
        {!!Form::label('date', 'Päiväys:')!!}<br/>
        {!!Form::text('date', null, ['class'=>'form-control', 'placeholder'=>'dd/mm/yyyy'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('time', 'Aika:')!!}<br/>
        {!!Form::text('time', null, ['class'=>'form-control', 'placeholder'=>'hh:mm'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('place', 'Paikka:')!!}<br/>
        {!!Form::text('place', null, ['class'=>'form-control'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('description', 'Kuvaus:')!!}<br/>
        {!!Form::textarea('description', null, ['size'=>'100x10'])!!}
    </div>

    <button type="submit" class="btn btn-default"> Lisää tapahtuma! </button>
</form>{!! Form::close() !!}
</div>
@endsection

@extends('templates.master')

@section('title', 'Tapahtuman lisäys')

@section('content')

<div class="container">

    <h1> Tapahtuman lisäys: </h1> <hr />
    {!! Form::open(array('action' => 'EventController@store')) !!}

        <div class="form-group">
            <label for="eventName" >Tapahtuman nimi:</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>

        <div class="form-group"> 
            <label for="date">Päiväys:</label>
            <input type="text" name="date" class="form-control" id="date" placeholder="dd/mm/yyyy">
        </div>

        <div class="form-group">
            <label for="time">Kellonaika:</label>
            <input type="text" name="time" class="form-control" id="time" placeholder="hh:mm">
        </div>

        <div class="form-group">
            <label for="place">Paikka:</label>
            <input type="text" name="place" class="form-control" id="place">
        </div>

    
        <button type="submit" class="btn btn-default"> Lisää tapahtuma! </button>
    </form>{!! Form::close() !!}
</div>
@endsection
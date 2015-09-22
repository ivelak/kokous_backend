
@extends('templates.master')

@section('title', 'Aktiviteetin lisäys')

@section('content')

<div class="container">

    <h1> Aktiviteetin lisäys: </h1> <hr />
    {!! Form::open(array('url' => '#', 'method' => 'post')) !!}

        <div class="form-group">
            <label for="activityName" >Aktiviteetin nimi:</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        
        <div class="form-group">
            <label for="event">Valitse tapahtuma:</label>
            <select class="form-control" id="eventSelection">
              <option>Ei tapahtumaa</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
        </div>
    
        <div class="form-group">
            <label for="hintText" >Toteutusvinkki:</label>
            <textarea class="form-control" rows="3" id="hint"></textarea>
        </div>

        <button type="submit" class="btn btn-default"> Lisää aktiviteetti! </button>
    {!! Form::close() !!}
</div>

@endsection
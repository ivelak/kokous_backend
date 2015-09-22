<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
@extends('templates.master')

@section('title', 'Akiviteetin lisäys')

@section('content')

<!--<div class="container">

    <h1> Akiviteetin lisäys: </h1> <hr />
    {!! Form::open(array('url' => '#', 'method' => 'post')) !!}

    <div class="form-group">
        <label for="eventName" >Aktiviteetin nimi:</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>

    <div class="form-group">
        {!! Form::label('test', 'Lisää toteutusvinkki?') !!}
        <br>
        {!! Form::textarea('test', null, ['size' => '111x5'])!!}
    </div>
    <div class="form-group">
        @inject('event', 'App\Event')
        {!! Form::select('nimiTälle', $event->all()) !!}
    </div>
    <button type="submit" class="btn btn-default"> Lisää aktiviteetti! </button>
</form>
</div>-->
<html>
<body>
<h1>Sudenpentujen Kokous</h1>
<hr>
<h2>Aktiviteetit:</h2>
<ul>
<li>Tiedän miten esiinnyn hyvin</li>
<li>Teen maalauksen</li>
<li>Keksin huudon iltanuotiolle</li>

{!! Form::open(array('url' => '#'))!!}
<li>{!! Form::select('uusi', array( 'retkeily' => array('1' => 'Osaan pukeutua oikein retkelle',
    '2' => 'Osallistun päiväretkeen', '3' => 'Tutustun retkikeittimeen'), 
    'muut' => array('4' => 'olen omena')), '1') !!}
{!! Form::submit('Lisää') !!}</li>
{!! Form::close() !!}
</ul>
</body>
</html>
@endsection
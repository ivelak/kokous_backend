@extends('templates.master')
@section('title', 'Tapahtuman lisäys')
@section('styles')
<style>
    .alert {
        position:absolute;
        top:70px;
        z-index: 100;
        right:5%;
        left:auto;
    }
</style>
@endsection
@section('content')

    <div class="container">
        <div id="background"></div>
        <div class="jumbotron">

        <h1>Kokous Backend</h1>
        <p> Tervetuloa partiolaisten mobiilikokoussovelluksen hallinnointisivulle.</p> 
        <img src="http://esimerkki.projektit.partio.fi/wp-content/uploads/sites/5/2013/03/Partion-logo_sin.png">
        <br>
        <a class='btn btn-primary btn-lg' href='/saml2/login'>Kirjaudu partion kautta</a>
        <br>
        @if(Auth::guest())
        {!!Form::open(['action' => 'DevLoginController@login'])!!}
        <button class='btn btn-primary btn-lg' type='submit'>Kirjaudu ilman partiota</button>
        {!!Form::close()!!}
        @else
        {!!Form::open(['action' => 'DevLoginController@logout'])!!}
        <button class='btn btn-primary btn-lg' type='submit'>Kirjaudu ulos</button>
        {!!Form::close()!!}
        @endif
    </div>
</div>
@endsection

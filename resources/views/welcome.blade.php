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

        <h1>Kokous backend</h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed posuere interdum sem. Quisque ligula eros ullamcorper quis, lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu. Sed arcu lectus auctor vitae, consectetuer et venenatis eget velit. Sed augue orci, lacinia eu tincidunt et eleifend nec lacus. Donec ultricies nisl ut felis, suspendisse potenti. Lorem ipsum ligula ut hendrerit mollis, ipsum erat vehicula risus, eu suscipit sem libero nec erat. Aliquam erat volutpat. Sed congue augue vitae neque. Nulla consectetuer porttitor pede. Fusce purus morbi tortor magna condimentum vel, placerat id blandit sit amet tortor.</p>
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

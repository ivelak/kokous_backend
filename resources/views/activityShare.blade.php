
@section('content')
@section('title', 'Aktiviteetti')

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!!Html::style('css/bootstrap.min.css', [], Request::secure())!!}
        {!!Html::style('css/bootstrap-theme.min.css', [], Request::secure())!!}
        {!!Html::style('css/styles.css', [], Request::secure())!!}
        {!!Html::style('http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css', [], Request::secure())!!}
        @yield('styles')
        {!! Html::script('js/jquery-2.1.4.js', [], $secure) !!}
        {!! Html::script('js/bootstrap.min.js', [], $secure) !!}
        {!! Html::script('js/jquery.sieve.js', [], $secure) !!}
        {!! Html::script('js/app.js', [], $secure) !!}
        {!! Html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.js', [], $secure) !!}
        @yield('scripts')

        <title></title>
    </head>
    <body>
        
        
        @if(Session::has('message'))
        <div class="container alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('message') }}
        </div>
        @endif
        @yield('content')


        <article class="container">

            <img src="http://toiminta.partio.fi/sites/partio.fi/files/uploads/partion-logo/partion_logo_web_gif.gif" align="right"></img>
            <h1>{{ $activity->name }}</h1>
            <br>
            <br>
            <h3>Suorittaja: {{$user->firstname . ' ' . $user->lastname}}</h3>
            <br>
            <p>{{ $singleActArray['content']}}</p>
            <br>
            <img src="{{$singleActArray['logo']}}" ></img>
            <br>
            <br>
            <p> Myönnetty: {{$singleActArray['event_date']}}</p>



        </article>
    </body>
</html>

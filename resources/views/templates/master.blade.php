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
        {!!Html::style('css/bootstrap.min.css', [], Request::secure())!!}
        {!!Html::style('css/bootstrap-theme.min.css', [], Request::secure())!!}
        @yield('styles')
        {!! Html::script('js/jquery-2.1.4.js', [], Request::secure()) !!}
        {!! Html::script('js/bootstrap.min.js', [], Request::secure()) !!}
        {!! Html::script('js/jquery.sieve.js', [], Request::secure()) !!}
        {!! Html::script('js/app.js', [], Request::secure()) !!}
        @yield('scripts')
        <title>@yield('title')</title>
    </head>
    <body>
        @include('navbar')
        @yield('content')
    </body>
</html>

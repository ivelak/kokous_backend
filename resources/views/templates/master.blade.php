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
        {!!Html::style('css/bootstrap.min.css')!!}
        {!!Html::style('css/bootstrap-theme.min.css')!!}
        {!! Html::script('js/jquery-2.1.4.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')
    </body>
</html>

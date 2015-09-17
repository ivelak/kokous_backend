<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <p> Lisätyt tapahtumat </p>
        <ul>
            @forelse ($events as $event)
            <li>{{ $event->name }}</li>
            
            @empty
            <p>Ei lisättyjä tapahtumia!</p>
            
            @endforelse
            
        </ul>
    </body>
</html>

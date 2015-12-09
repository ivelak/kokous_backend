
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
        <title></title>
    </head>
    <body>
        <img src="http://toiminta.partio.fi/sites/partio.fi/files/uploads/partion-logo/partion_logo_web_gif.gif" align="right"></img>
        <div class="container">

            <h1>{{ $activity->name }}</h1>
            <hr>
            <p>{{$user->firstname . ' ' . $user->lastname}} on ansainnut seuraavan suoritteen:</p>
            <p>{{ $activity->name }}</p>
            <p>{{ $singleActArray['content']}}</p>
            <img src="{{$singleActArray['logo']}}"></img>



        </div>
    </body>
</html>

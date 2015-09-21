
<!DOCTYPE html>
@extends('templates.master')
@section('title', 'Aktiviteetti')
@section('content')

<html>
<body>
<h1>{{ $event->name }}</h1>
<hr>
<h2></h2>
<ul>
    <li><strong>Paikka: </strong>{{ $event->place }}</li>
</ul>

</body>
</html>
@endsection
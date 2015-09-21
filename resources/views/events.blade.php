<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
@extends('templates.master)
@section('title', 'Lisätyt tapahtumat')
@section('content')

<h1> Lisätyt tapahtumat </h1>
<ul>
    @forelse ($events as $event)
    <li>{{ $event->name }}</li>

    @empty
    <p>Ei lisättyjä tapahtumia!</p>

    @endforelse

</ul>

@endsection
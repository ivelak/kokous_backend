<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
@extends('templates.master')
@section('title', 'Lisätyt tapahtumat')
@section('content')

<div class="container">
    <h1> Kaikki tapahtumat: </h1> <hr />
    <table class="table table-bordered">
        <tr>
            <td><strong>Tapahtuma</strong></td>
        </tr>
        @foreach($events as $event)
        <tr>
            <td><a href="/event/{{ $event->id }}">{{ $event->name }}</a></td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
@extends('templates.master')
@section('title', 'Aktiviteetti')
@section('content')

<div class="container">
    <h1>{{ $activity->name }}</h1>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Ikäryhmä: </strong>{{ $event->time->format('d.m.Y') }}</li>
                <li><strong>Pakollisuus: </strong>{{ $event->place }}</li>
                <li><strong>Paikka: </strong>{{ $event->place }}</li>
                <li><strong>Ryhmän koko: </strong>{{ $event->place }}</li>
                <li><strong>Suorituksen kesto: </strong>{{ $event->time->format('H:i') }}</li>

            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kuvaus:</strong></div>
        <div class="panel-body">
        </div>
    </div>
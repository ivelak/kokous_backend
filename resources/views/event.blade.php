
<!DOCTYPE html>
@extends('templates.master')
@section('title', 'Aktiviteetti')
@section('content')

<div class="container">
    <h1>{{ $event->name }}</h1>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Päivä: </strong>{{ $event->time->format('d.m.Y') }}</li>
                <li><strong>Aika: </strong>{{ $event->time->format('H:i') }}</li>
                <li><strong>Paikka: </strong>{{ $event->place }}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kuvaus:</strong></div>
        <div class="panel-body">
            {{ empty($event->description) ? 'Ei kuvausta' : $event->description}}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Aktiviteetit:</strong></div>
        <table class="table">
            @forelse($event->activities() as $activity)
            <tr>
                <td>{{$activity->name}}</td>
            </tr>
            @empty
            <tr>
                <td>Ei merkittyjä aktiviteetteja</td>
            </tr>
            @endforelse</tr>
        </table>
    </div>
</div>

@endsection
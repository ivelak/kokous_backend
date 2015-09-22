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
    <h1> Kaikki tapahtumat </h1> <hr />
    <div class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Tapahtumat:</strong>
                {!!link_to('events/new', $title = 'Uusi tapahtuma', $attributes = array('class'=>'pull-right'))!!}
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td><strong>Nimi</strong></td>
                        <td><strong>Paikka</strong></td>
                        <td><strong>Päivä</strong></td>
                        <td><strong>Aika</strong></td>
                    </tr>
                    @forelse($events as $event)
                    <tr onclick="location.href = '{!!url('events/'.$event -> id)!!}'">
        <!--                <td>{!!link_to('events/' . $event->id, $title = $event->name)!!}</td>-->
                        <td>{{$event->name}}</td>
                        <td>{{$event->place}}</td>
                        <td>{{$event->time->format('d.m.Y')}}</td>
                        <td>{{$event->time->format('H:i')}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td>Ei tapahtumia</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $events->render() !!}

    </div>

    @endsection
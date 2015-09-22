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
        <table class="table">
            <tr>
                <td><strong>Nimi</strong></td>
            </tr>
            @forelse($events as $event)
            <tr>
                <td>{!!link_to('events/' . $event->id, $title = $event->name)!!}</td>
            </tr>
            @empty
             <tr>
                <td>Ei tapatumia</td>
            </tr>
            @endforelse
        </table>
<!--        <div class="panel-footer">{!! $events->render() !!}</div>-->
    </div>
        {!! $events->render() !!}

</div>

@endsection
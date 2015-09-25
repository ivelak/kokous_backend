
@extends('templates.master')
@section('title', 'Lisätyt tapahtumat')
@section('content')
<div class="container">
    <h1> Kaikki tapahtumat </h1> <hr />
    <div class="panel">
        {!!link_to_action('EventController@create', $title = 'Uusi tapahtuma', [], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    <div class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Tapahtumat:</strong>
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
                    <tr onclick="location.href='{!!url('events/'.$event -> id)!!}'">
                        <td>{{$event->name}}</td>
                        <td>{{$event->place}}</td>
                        <td>{{$event->time->format('d.m.Y')}}</td>
                        <td>{{$event->time->format('H:i')}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Ei tapahtumia</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $events->render() !!}

    </div>
</div>
@endsection
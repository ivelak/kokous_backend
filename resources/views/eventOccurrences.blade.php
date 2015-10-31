@extends('templates.master')
@section('title', 'Kalenterinäkymä')
@section('scripts')
@endsection
@section('content')
<div class="container">
    <h1> Kalenterinäkymä </h1> <hr />
    <div class="panel">
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
                    @forelse($eventOccurrences as $event)
                    <tr id="{{$event->id}}" data-target="{{'/events/' . $event->event->id . '/occurrences/' . $event->id}}" class="tr-link">
                        <td>{{$event->name}}</td>
                        <td>{{$event->place}}</td>
                        <td>{{$event->date->format('d.m.Y')}}</td>
                        <td>{{$event->time->format('H:i')}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Ei tulevia tapahtumia</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $eventOccurrences->render() !!}

    </div>
</div>
@endsection

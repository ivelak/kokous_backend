
@extends('templates.master')
@section('title', 'Lisätyt tapahtumat')
@section('content')
<div class="container">
    <h1> Kaikki tapahtumat </h1> <hr />
    
    @if(App\Admin::isAdmin())
    <div class="panel">      
        {!!link_to_action('EventController@create', $title = 'Uusi tapahtuma', [], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    @endif
    <div class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Tapahtumat:</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Nimi</th>
                        <th>Ryhmä</th>
                        <th>Paikka</th>
                        <th>Päivä</th>
                        <th>Aika</th>

                    </tr>
                    @forelse($events as $event)
                    <tr data-target="{{'/events/' . $event->id}}" class="tr-link">
                        <td>{{$event->name}}</td>
                        <td>{{$event->group->name}}</td>
                        <td>{{$event->place}}</td>

                        @if($event->time->isSameDay($event->endDate))
                        <td>{{$event->time->format('d.m.Y')}}</td>

                        @else
                        <td>{{$event->time->format('d.m.Y').' - '.$event->endDate->format('d.m.Y')}}</td>
                        @endif

                        <td>{{$event->time->format('H:i')}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Ei tapahtumia</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $events->render() !!}

    </div>
</div>
@endsection

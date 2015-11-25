@extends('templates.master')
@section('title', 'Tapahtumapohjat')
@section('content')

<div class="container">
    <h1> Kaikki tapahtumapohjat </h1> <hr />
    <div class="panel">
        {!!link_to_action('EventPatternController@create', $title = 'Uusi tapahtumapohja', [], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    <div class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Tapahtumapohjat:</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    @forelse($eventPatterns as $eventPattern)
                    <tr>
                        <td>{{$eventPattern->name}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Ei tapahtumapohjia</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $eventPatterns->render() !!}

    </div>
</div>
@endsection

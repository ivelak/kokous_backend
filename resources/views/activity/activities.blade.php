

@extends('templates.master')
@section('title', 'Aktiviteetit')
@section('content')
<div class="container">
    <h1> Kaikki aktiviteetit </h1> <hr />
    <div class="panel">
        {!!link_to_action('ActivityController@create', $title = 'Uusi aktiviteetti', [], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    <div class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Aktiviteetit:</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td><strong>Aktiviteetti</strong></td>
                    </tr>
                    @forelse($activities as $activity)
                    <tr onclick="location.href='{!!url('activities/'.$activity -> id)!!}'">
                        <td>{{$activity->name}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Ei aktiviteetteja</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $activities->render() !!}

    </div>
</div>
@endsection


@extends('templates.master')
@section('title', 'Aktiviteetit')
@section('content')
@section('scripts')
@include('templates.linkRow')
@endsection
<div class="container">
    <h1> Kaikki aktiviteetit </h1> <hr />
    <div class="panel">
        {!!Form::open(array('action' => ['ActivityController@sync'], 'class'=>'form-inline'))!!}
        {!!link_to_action('ActivityController@create', $title = 'Uusi aktiviteetti', [], $attributes = array('class'=>'btn btn-default'))!!}
        {!!Form::submit('Hae POFista', ['class' => 'btn btn-default'])!!}
        {!!Form::close()!!}
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
                    <tr id="{{$activity->id}}" class="tr-link">
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
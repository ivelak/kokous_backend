

@extends('templates.master')
@section('title', 'Aktiviteetit')
@section('content')

<div class="container">
    <h1> Kaikki aktiviteetit </h1> <hr />
    <div class="panel">
        {!!Form::open(array('action' => ['ActivityController@sync'], 'class'=>'form-inline'))!!}
        @if(App\Admin::isAdmin())
        {!!Form::submit('Hae POFista', ['class' => 'btn btn-default'])!!}
        @endif
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
                        <th>Aktiviteetti</th>
                    </tr>
                    @forelse($activities as $activity)
                    <tr data-target="{{'/activities/' . $activity->id}}" class="tr-link">
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

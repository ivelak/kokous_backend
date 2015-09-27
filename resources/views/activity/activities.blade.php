
@extends('templates.master')

@section('title', 'Aktiviteetin lisäys')

@section('content')

<div class="container">
    <h1> Kaikki aktiviteetit: </h1> <hr />
    <table class="table table-bordered">
        <tr>
            <td><strong>Aktiviteetti</strong></td>
        </tr>
        @forelse($activities as $activity)
        <tr>
            <td>{{ $activity->name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Ei aktiviteetteja</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection
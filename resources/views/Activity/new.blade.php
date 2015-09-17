
@extends('templates.master')

@section('title', 'Aktiviteetin lisäys')

@section('content')

<div class="container">

    <h1> Aktiviteetin: </h1> <hr />
    <form role="form" action="#" method="post">

        <div class="form-group">
            <label for="activityName" >Aktiviteetin nimi:</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>

        <button type="submit" class="btn btn-default"> Lisää tapahtuma! </button>
    </form>
</div>
@endsection
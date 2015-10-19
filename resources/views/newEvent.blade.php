
@extends('templates.master')

@section('title', 'Tapahtuman lisäys')

@section('content')

<div class="container">

    <h1> Tapahtuman lisäys: </h1> <hr />
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="well">
        {!! Form::open(array('action' => 'EventController@store', 'role' => 'form')) !!}

        <div class="form-group">
            {!!Form::label('name', 'Tapahtuman nimi:')!!}<br/>
            {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi tapahtumalle'])!!}
        </div>

        @if(isset($id))
        {!!Form::hidden('groupId', $id)!!}
        @else
        <div class="form-group">

            {!!Form::label('groups', 'Valitse ryhmä:')!!}
            <select class="form-control sieve" name="groups[]" id="groups">
                @forelse($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>             
                @empty
                <option disabled value=""> Ei ryhmiä</option>
                @endforelse
            </select>
        </div>
        @endif

        <div class="form-group"> 
            {!!Form::label('date', 'Päiväys:')!!}<br/>
            {!!Form::text('date', old('date'), ['class'=>'form-control', 'placeholder'=>'dd.mm.yyyy'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('time', 'Aika:')!!}<br/>
            {!!Form::text('time', old('time'), ['class'=>'form-control', 'placeholder'=>'hh:mm'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('repeat', 'Toisto:')!!}
            {!!Form::checkbox('repeat', old('repeat'), ['class'=>'form-control'])!!}<br/>
        </div>

        <div class="form-group">

            @foreach (array( 0 => 'Ma', 1 => 'Ti', 2 => 'Ke', 
            3 => 'To', 4 => 'Pe', 5 => 'La', 6 => 'Su' )as $i => $weekday)

            {!!Form::label($weekday, $weekday)!!}
            <input type="checkbox" name="days[]" value="{{$i}}" id="{{$weekday}}" class="checkbox-inline"/>
            &emsp;
            @endforeach          
        </div>

        <div class="form-group">
            {!!Form::label('interval', 'Toistoväli:')!!}           
            {!!Form::select('interval', array('1','2','3','4'), ['class'=>'form-control'])!!}
            {!!Form::label('interval', 'viikon välein.')!!}   
        </div>

        <div class="form-group">
            {!!Form::label('ending', 'Päättyy:')!!}<br/>
            <input type="radio" name="ending" value="afterYear" checked> Vuoden päästä

            <div class="input-group">

                <span class=""><input type="radio" name="ending" value="until"> Päivänä </span>
                {!!Form::text('endDate', old('endDate'), ['class'=>'form-control', 'placeholder'=>'dd.mm.yyyy'])!!}
            </div>
        </div>

        <div class="form-group">
            {!!Form::label('place', 'Paikka:')!!}<br/>
            {!!Form::text('place', old('place'), ['class'=>'form-control', 'placeholder'=>'Tapahtumapaikka'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('description', 'Kuvaus:')!!}
            {!!Form::textarea('description', old('description'), ['rows'=>'5', 'class'=>'form-control', 'placeholder'=>'Tapahtuman kuvaus'])!!}
        </div>

        {!!Form::submit('Lisää tapahtuma', ['class' => 'btn btn-default'])!!}
        {!!link_to_action('EventController@index', $title = 'Peruuta', [], $attributes = array('class'=>'btn btn-default pull-right'))!!}
        {!! Form::close() !!}
    </div>
</div>
<script>
    $(document).ready(function () {
        $("select.sieve").sieve({itemSelector: "option"});
    });
</script>
@endsection

@extends('templates.master')

@section('title', 'Tapahtumapohjan lisäys')

@section('content')

<div class="container">
    <h1> Tapahtumapohjan lisäys: </h1> <hr />
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    
    {!! Form::open(array('action' => 'EventPatternController@store', 'role' => 'form')) !!}
    <div class="well">

        <div class="form-group">
            {!!Form::label('name', 'Tapahtumapohjan nimi:')!!}<br/>
            {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi tapahtumapohjalle'])!!}
        </div>
        
        <div class="form-group">
            <input id="radio1" type="radio" name="dateType" checked> Tapahtuu yhtenä päivänä
            <br/>
            <input id="radio2" type="radio" name="dateType"> Tapahtuu aikavälillä
        </div>
        

        <div class="form-group">
            {!!Form::label('name', 'Tapahtuma päivä:')!!}<br/>
            {!!Form::text('date', old('date'), ['class'=>'form-control', 'placeholder'=>'dd.mm.yyyy', 'id'=>'date'])!!}
        </div>
        
        {!!Form::label('name', 'Aikaväli:')!!}
        <div class="input-group">
            <input id="field1" name="start" type="text" class="form-control" placeholder="Alkamispäivä dd.mm.yyyy" disabled>
            <span class="input-group-addon">-</span>
            <input id="field2" name="end" type="text" class="form-control" placeholder="Loppumispäivä dd.mm.yyyy" disabled>
        </div>
        
        <br>
        
        {!!Form::label('name', 'Valitse ikäryhmät:')!!}
        <div class="form-group">
            <ul class="list-group" id="age_group_list" style="">
            @foreach($age_groups as $age_group)
            <li class="list-group-item">
                {{ $age_group }}
                <input type="checkbox" class="pull-right" value="{{ $age_group }}" name="selectedAgeGroups[]">
            </li>
            @endforeach
            </ul>  
        </div>
        
        <br>
        
        <div class="form-group">

            {!!Form::label('activities', 'Valitse aktiviteetit:')!!}
            <select id="selector" multiple="multiple" class="form-control sieve" name="activities[]" id="activities">
                @forelse($activities as $activity)
                <option value="{{ $activity->id }}">{{ $activity->name }}</option>             
                @empty
                <option disabled value="">Ei aktiviteetteja</option>
                @endforelse
            </select>
            <br>
            <button class="btn btn-primary pull-right" type="button" onclick="addActivitiesToList()">Lisää valitut</button>
            <br>
        </div>
        <br>
        <div class="form-group">
            {!!Form::label('selectedActivities', 'Valitut aktiviteetit:')!!}
            <ul class="list-group" id="activityList">
            </ul>
        </div>
        <hr/>
        {!!Form::submit('Luo tapahtumapohja', ['class' => 'btn btn-primary'])!!}
        {!! Form::close() !!}
         
    </div>
</div>


@endsection
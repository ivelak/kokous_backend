
@extends('templates.master')

@section('title', 'Ryhmän lisäys')

@section('content')

<div class="container">

    <h1> Ryhmän lisäys: </h1> <hr />
    @if( isset($errors))
    <ul class="list-group">
        @foreach($errors->all() as $error)
        <li class="list-group-item list-group-item-danger">{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <div class="well">
        {!! Form::open(array('action' => 'GroupController@store', 'role' => 'form')) !!}

        <div class="form-group">
            {!!Form::label('name', 'Ryhmän nimi:')!!}<br/>
            {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi ryhmälle'])!!}
        </div>

        <div class="form-group"> 
            {!!Form::label('scout_group', 'Lippukunta:')!!}<br/>
            {!!Form::text('scout_group', old('scout_group'), ['class'=>'form-control', 'placeholder'=>'Lippukunnan nimi'])!!}
        </div>

        <div class="form-group">
            {!!Form::label('age_group', 'Ikäryhmä:')!!}<br/>
            {!!Form::select('age_group', ['sudenpennut' => 'Sudenpennut','seikkailijat' => 'Seikkailijat','tarpojat' => 'Tarpojat','samoajat' => 'Samoajat','vaeltajat' => 'Vaeltajat'])!!}
        </div>

        <div class="form-group">

            {!!Form::label('participants', 'Valitse ryhmäläisiä:')!!}
            <select multiple="multiple" class="form-control sieve" name="participants[]" id="participants">
                @forelse($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>             
                @empty
                <option disabled value=""> Ei käyttäjiä</option>
                @endforelse
            </select>
        </div>

        <div class="form-group">

            {!!Form::label('leaders', 'Valitse ryhmänjohtajia:')!!}
            <select multiple="multiple" class="form-control sieve" name="leaders[]" id="leaders">
                @forelse($users as $user)
                <option value="{{ $user->id }}">{{ $user->username }}</option>             
                @empty
                <option disabled value=""> Ei käyttäjiä</option>
                @endforelse
            </select>
        </div>

        {!!Form::submit('Lisää ryhmä', ['class' => 'btn btn-default'])!!}
        {!!link_to_action('GroupController@index', $title = 'Peruuta', [], $attributes = array('class'=>'btn btn-default pull-right'))!!}
        {!! Form::close() !!}
    </div>
</div>
<script>
    $(document).ready(function() {
        $("select.sieve").sieve({ itemSelector: "option" });
    });
</script>
@endsection
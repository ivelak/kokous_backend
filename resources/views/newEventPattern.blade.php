
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
    
    <div class="well">
        {!! Form::open(array('action' => 'EventController@store', 'role' => 'form')) !!}

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
    </div>
</div>

<script>
    
//    function addActivitiesToList()
//    {
//        var nodes = document.getElementById('selector');
//        for(i=0; i<nodes.options.length; i++) {
//            var node = nodes.options[i];
//            if(node.selected === true)
//            {
//                var activityList = document.getElementById('activityList');
//                node.disabled = true;
//                node.selected = false;
//                activityList.insertAdjacentHTML('beforeend', '<li class="list-group-item" name=' + node.value + '>'+ node.text +'<span class="pull-right"><button class="btn btn-xs btn-warning" onclick="removeActivity(' + node.value +')" type="button"><span class="glyphicon glyphicon-trash"></span></button></span></li>');
//            }
//        }
//    }
//    function select_option(i) {
//        return $('span#span_id select option[value="' + i + '"]').html();
//    }
//    function removeActivity(activity) {
//        var node = document.getElementById(activity);
//        node.disabled = false;
//        node.selected = false;
//        return (elem=document.getElementsByName(activity)[0]).parentNode.removeChild(elem);
//    }
//    
//JQueried verions
    function addActivitiesToList()
    {
        $('#selector option:selected').each(function () {
            $(this).removeAttr("selected");
            $(this).attr('disabled', true);
            $('<li class="list-group-item" id=' + $(this).val() + '>'+ $(this).html() +'<span class="pull-right"><button class="btn btn-xs btn-warning" onclick="removeActivity(' + $(this).val() +')" type="button"><span class="glyphicon glyphicon-trash"></span></button></span></li>').appendTo('#activityList');
        });
    }
    
    function removeActivity(activity) {
        var elem = $("[value=" + activity + "]");
        elem.removeAttr("disabled selected");
        console.log("li #"+ activity);
        $("#"+ activity).remove();
    }
    
    $("#radio2").change(function () {
        if (!$("#radio2").attr("checked")) {
            $('#radio1').attr("checked", false);
            $('#field1').removeAttr('disabled');
            $('#field2').removeAttr('disabled');
            $('#date').attr('disabled', 'yes');
        }
    });
    
    $("#radio1").change(function () {
        if (!$("#radio1").attr("checked")) {
            $('#radio1').attr("checked", true);
            $('#radio2').attr("checked", false);
            $('#field1').attr('disabled', 'yes');
            $('#field2').attr('disabled', 'yes');
            $('#date').removeAttr('disabled');
        }
    });
    
    $(document).ready(function() {
        $("select.sieve").sieve({ itemSelector: "option" });
    });
</script>
@endsection
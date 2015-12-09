@extends('templates.master')

@section('title', 'Valitse tapahtumat')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <h3>Aktiviteetit</h3>
            <hr>
            <div class="well" style="max-height: 500px; overflow-y:scroll;">
                <ul class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)" ondragstart="drag(event)" style="min-height: 5em">
                    @foreach($activities as $activity)
                    <li class="list-group-item" draggable="true" id="activity-{{$activity->id}}">{{$activity->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Tapahtumapohjat</h3>
            <hr>
            <div class="well" id="patternsDiv" style="max-height: 500px; overflow-y:scroll;" ondrop="drop3(event)" ondragover="allowDrop(event)" ondragstart="drag(event)">
                @foreach($eventPatterns as $eventPattern)
                <ul class="list-group event-draggable" style="min-height: 5em" draggable="true" ondrop="drop(event)" id="pattern-{{$eventPattern->id}}" ondragover="allowDrop(event)" ondragstart="drag(event)">
                    <h4 class="list-group-item-heading">{{$eventPattern->name}}
                        <small>
                        @if(isset($eventPattern->endDate))
                        {{$eventPattern->date->format('d.m.Y')}} - {{$eventPattern->endDate->format('d.m.Y')}}
                        @else
                        {{$eventPattern->date->format('d.m.Y')}}
                        @endif
                        </small></h4>

                        @foreach($eventPattern->activities as $activity)
                        <li class="list-group-item" draggable="false">{{$activity->name}}<span class="glyphicon glyphicon-lock pull-right"></span></li>
                        @endforeach
                </ul>
                @endforeach
            </div>
        </div>
        <div class="col-sm-4">

            <h3>Toimintasuunnitelma<button type="button" class="btn btn-sm pull-right" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></h3>
            <hr>
            <div class="well" id="eventPlanner" style="max-height: 500px; overflow-y:scroll;" ondrop="drop2(event)" ondragover="allowDrop(event)" ondragstart="drag(event)">
                {{--@foreach($events as $event)
                <ul class="list-group event-draggable">
                    <h4 class="list-group-item-heading">{{$event->event->name}} <small>{{$event->date->format('d.m.Y')}}</small></h4>
                    <ul class="list-group" id="event-{{$event->id}}" ondragover="allowDrop(event)" ondragstart="drag(event)" ondrop="drop(event)">
                        @foreach($event->activities as $activity)
                        <li class="list-group-item" draggable="false">{{$activity->name}}<span class="glyphicon glyphicon-lock pull-right"></span></li>
                        @endforeach
                    </ul>
                </ul>
                @endforeach--}}
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
    <hr>
    <div class="btn-group pull-right" role="group">
        <button class="btn btn-default" onclick="confirm('Oletko varma?')">Nollaa valinnat</button>
        <input type="button" class="btn btn-primary" onclick="submit()" value="Seuraava"></button>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Uusi tapahtuma</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('action' => 'EventController@storeNoRedirect', 'role' => 'form', 'id' => 'create_event')) !!}

                    <div class="form-group">
                        {!!Form::label('name', 'Tapahtuman nimi:')!!}<br/>
                        {!!Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nimi tapahtumalle'])!!}
                    </div>
                    @if(isset($id))
                    {!!Form::hidden('groupId', $id)!!}
                    @else
                    <div class="form-group">

                        {!!Form::label('groups', 'Valitse ryhmä:')!!}
                        <select class="form-control sieve" name="groupId" id="groups">
                            @forelse($groups as $group2)
                            <option value="{{ $group2->id }}">{{ $group2->name }}</option>             
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

                        @foreach (array( 1 => 'Ma', 2 => 'Ti', 3 => 'Ke', 
                        4 => 'To', 5 => 'Pe', 6 => 'La', 7 => 'Su' )as $i => $weekday)

                        {!!Form::label($weekday, $weekday)!!}
                        <input type="checkbox" name="days[]" value="{{$i}}" id="{{$weekday}}" class="checkbox-inline"/>
                        @endforeach          
                    </div>

                    <div class="form-group">
                        {!!Form::label('interval', 'Toistoväli:')!!}           
                        {!!Form::select('interval', array(1=>'1',2=>'2',3=>'3',4=>'4'), ['class'=>'form-control'])!!}
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>
                    {!!Form::submit('Tallenna', ['class' => 'btn btn-primary'])!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }
    
    function checkDateValidity(date, originalDate)
    {
        var date_regex = /^(0[1-9]|1\d|2\d|3[01])\.(0[1-9]|1[0-2])\.(19|20)\d{2}$/ ;
        if(!(date_regex.test(date)))
        {
            return false;
        }
        
        var dates = originalDate.split(" - "); // 11.11.2015 - 10.12.2015
        
        var startDateComponents = dates[0].split(".");
        var endDateComponents = dates[1].split(".");
        var dateComponents = date.split(".");

        var from = new Date(startDateComponents[2], startDateComponents[1]-1, startDateComponents[0]);
        var to   = new Date(endDateComponents[2], endDateComponents[1]-1, endDateComponents[0]);
        var check = new Date(dateComponents[2], dateComponents[1]-1, dateComponents[0]);
        
        return (check > from && check < to);
    }
    
    function checkTimeValidity(time)
    {
        var timeRegEx = /^([01]?[0-9]|2[0-3]):[0-5][0-9]/;
        return timeRegEx.test(time);
    }


    function drop2(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var target = $(ev.target);
        var thisElement = document.getElementById(data);

        if (thisElement.tagName === "UL" && target)
        {
            var date = thisElement.getElementsByTagName('H4')[0].getElementsByTagName('SMALL')[0].innerHTML;
            var isValid = null;
            
            if(date.indexOf('-') != -1)
            {
                var originalDate = thisElement.getElementsByTagName('H4')[0].getElementsByTagName('SMALL')[0].innerHTML;
                var time = prompt("Anna päivämäärä:", "");
                isValid = checkDateValidity($.trim(time), $.trim(originalDate));
                if(isValid) {
                    var clockTime = prompt("Anna kellonaika:", "");
                    isValid = checkTimeValidity(clockTime);
                    
                    savedTimes[thisElement.id] = originalDate;
                    thisElement.getElementsByTagName('H4')[0].getElementsByTagName('SMALL')[0].innerHTML = (time + ' ' + clockTime);
                }
            }
            else
            {
                var originalDate = thisElement.getElementsByTagName('H4')[0].getElementsByTagName('SMALL')[0].innerHTML;
                var clockTime = prompt("Anna kellonaika:", "");
                isValid = checkTimeValidity(clockTime);
                    
                //savedTimes[thisElement.id] = originalDate;
                thisElement.getElementsByTagName('H4')[0].getElementsByTagName('SMALL')[0].innerHTML = (originalDate + ' ' + clockTime);
            }
            
            if(isValid == true || isValid == null)
            {
                if (target.is('li') || (target.is('ul') && target.parent('ul') !== null) || target.is('h4'))
                {
                    target.parent('ul').parent('div').append(document.getElementById(data));
                }
                else if (target.is('ul') && target.parent('ul') === null)
                {
                    target.parent('div').append(document.getElementById(data));
                }
                else
                {
                    target.append(document.getElementById(data));
                }
            }
        }
    }
    
    function drop3(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var target = $(ev.target);
        var thisElement = document.getElementById(data);

        if (thisElement.tagName === "UL" && target)
        {
            thisElement.getElementsByTagName('H4')[0].getElementsByTagName('SMALL')[0].innerHTML = savedTimes[thisElement.id]
            
            if (target.is('li') || (target.is('ul') && target.parent('ul') !== null) || target.is('h4'))
            {
                target.parent('ul').parent('div').append(document.getElementById(data));
            }
            else if (target.is('ul') && target.parent('ul') === null)
            {
                target.parent('div').append(document.getElementById(data));
            }
            else
            {
                target.append(document.getElementById(data));
            }
        }
    }
    
    function submit()
    {
        var data = {};
        data.occurrences = [];
        data.patterns = [];
        data.group = {!!$groupId!!};
        
        var uls = $('#eventPlanner').children('ul');
        $.each(uls,function()
        {
            if($(this).attr('id').search('event') != -1) // on eventOccurrence
            {
                var occurrence = {};
                occurrence.id = $(this).attr('id').slice($(this).attr('id').indexOf('-')+1);
                occurrence.activities = [];
                $.each($(this).children('li'),function()
                {
                    if($(this).attr('id') != null)
                    {
                        occurrence.activities.push($(this).attr('id').slice($(this).attr('id').indexOf('-')+1));
                    }
                    
                });
                data.occurrences.push(occurrence);
            }
            else // on eventPattern
            {
                var pattern = {};
                var date = $.trim($(this).children('h4').first().children('small').first().html());
                pattern.date = date;
                pattern.datePart = date.split(" ")[0];
                console.log(pattern.datePart);
                
                pattern.id = $(this).attr('id').slice($(this).attr('id').indexOf('-')+1);
                pattern.activities = [];
                $.each($(this).children('li'), function()
                {
                    if($(this).attr('id') != null)
                    {
                        pattern.activities.push($(this).attr('id').slice($(this).attr('id').indexOf('-')+1));
                    }
                });
                data.patterns.push(pattern);
            }
        });
        var json = JSON.stringify(data);
        var request = {
            url: "{!! action('ActivityPlanningController@handleActivityPlan')!!}",
            type: "POST",
            data: json,
            contentType: "application/json",
            accepts: {
                text: "application/json"
            },
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
                console.log(data);
                if(data == 2)
                {
                    window.location="{!! url('/') !!}";
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Fail");
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        };
        
        $.ajax(request);
        //$.post("{!! action('ActivityPlanningController@handleActivityPlan')!!}", json, function(returnData) { console.log(returnData);});
        
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var target = $(ev.target);
        var thisElement = document.getElementById(data);

        if (thisElement.tagName === 'LI')
        {
            if (!target.is('ul'))
            {
                target.parent('ul').append(document.getElementById(data));
            }
            else
            {
                target.append(document.getElementById(data));
            }
        }
    }
    
    $(document).ready(function() {
        var eventOccurrences = {!!$events->toJson()!!};
        window.savedTimes = {};
        var uls = $('#patternsDiv').children('ul');
        $.each(uls,function()
        {
            var date = $.trim($(this).children('h4').first().children('small').first().html());
            console.log($(this).attr('id'));
            savedTimes[$(this).attr('id')] = date;
        });
        
        for(var i = 0; i < eventOccurrences.length; i++)
        {
            var event = eventOccurrences[i];
            var ul = $("<ul></ul>").addClass("list-group").attr("id", "event-"+event.id).attr("ondragover", "allowDrop(event)")
                    .attr("ondragstart", "drag(event)").attr("ondrop", "drop(event)");
            
            var h4 = $("<h4></h4>").addClass("list-group-item-heading").text(event.event.name+" ");
            var date = new Date(event.date.date.substring(0,10));
            var small = $("<small></small>").text(date.getDay()+"."+date.getMonth()+"."+date.getFullYear());
            h4.append(small);
            ul.append(h4);
            
            for(var j = 0; j < event.activities.length; j++)
            {
                var activity = event.activities[j];
                var li = $("<li></li>").addClass("list-group-item").attr("draggable", "false").text(activity.name);
                var span = $("<span></span>").addClass("glyphicon glyphicon-lock pull-right");
                li.append(span);
                ul.append(li);
            }
            $('#eventPlanner').append(ul);
        }
    });
</script>
@endsection
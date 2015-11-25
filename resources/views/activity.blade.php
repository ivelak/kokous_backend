@extends('templates.master')
@section('title', 'Aktiviteetti')
@section('content')

<div class="container">
    <h1>{{ $singleActArray['title'] }}</h1>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Tiedot:</strong></div>
        <div class="panel-body">
            <ul>
                <li><strong>Ikäryhmä: </strong>{{ $singleActArray['agegroup'] }}</li>
                <li><strong>Pakollisuus: </strong>{{ $singleActArray['pakollisuus'] }}</li>
                <li><strong>Ryhmäkoko: </strong>{{ $singleActArray['ryhmakoko'] }}</li>
                <li><strong>Paikka: </strong>{{ $singleActArray['paikka'] }}</li>
                <li><strong>Suorituksen kesto: </strong>{{ $singleActArray['suoritus_kesto'] }}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Kuvaus:</strong></div>
        <div class="panel-body">
            {{ $singleActArray['content']}}
        </div>
    </div>
    
     <div class="panel panel-default">
        <div class="panel-heading"><strong>Kommentit:</strong></div>
        <div class="panel-body">
            <div>
                @foreach($activity->comments as $comment)
                <div class="well">
                    <p>
                        {{$comment->comment}}
                    </p>
                    <br>

                    {!! Form::open(['action' => ['CommentController@destroy'],'method'=>'delete'])!!}
                    {!! Form::submit('poista',['class'=>'btn-link pull-right'])!!}
                    {!! Form::hidden('id',$comment->id)!!}
                    {!! Form::close()!!}

                    <p>
                        {{$comment->user->firstname . ' ' . $comment->user->lastname . ' - ' . $comment->created_at->format('d.m.Y - H:i')}}
                    </p>
                </div>
                
                @endforeach

            </div>
        </div>
    </div>
    @include('newComment')
</div>
@endsection
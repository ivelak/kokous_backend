
@extends('templates.master')
@section('title', 'Ryhmät')
@section('scripts')
@include('templates.linkRow')
@endsection
@section('content')
<div class="container">
    <h1> Kaikki ryhmät </h1> <hr />
    <div class="panel">
        {!!link_to_action('GroupController@create', $title = 'Uusi ryhmä', [], $attributes = array('class'=>'btn btn-default'))!!}
    </div>
    <div class="panel">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Ryhmät:</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td><strong>Nimi</strong></td>
                        <td><strong>Lippukunta</strong></td>
                        <td><strong>Ikäryhmä</strong></td>
                    </tr>
                    @forelse($groups as $group)
                    <tr id="{{$group->id}}" class="tr-link">
                        <td>{{$group->name}}</td>
                        <td>{{$group->scout_group}}</td>
                        <td>{{$group->age_group}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Ei ryhmiä</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $groups->render() !!}

    </div>
</div>
@endsection
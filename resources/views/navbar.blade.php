<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            {!!link_to('/', $title = 'kokous_backend', $attributes = array('class'=>'navbar-brand'))!!}
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('events') ? 'active' : '' }}">{!!link_to('/events', $title = 'Tapahtumat')!!}</li>
                <li class="{{ Request::is('activities') ? 'active' : '' }}">{!!link_to('/activities', $title = 'Aktiviteetit')!!}</li> 
                <li class="{{ Request::is('users') ? 'active' : '' }}">{!!link_to('#', $title = 'Käyttäjät')!!}</li>    
                <li class="{{ Request::is('groups') ? 'active' : '' }}">{!!link_to('/groups', $title = 'Ryhmät')!!}</li>    

            </ul>
            @if(!Auth::check())
            {!!Form::open(array('url' => '/login', 'method'=>'post', 'class'=>'navbar-form navbar-right'))!!}
            {!!Form::submit('Kirjaudu', ['class' => 'btn btn-default'])!!}
            {!!Form::close()!!}
            @else
            {!!Form::open(array('url' => '/logout', 'method'=>'post', 'class'=>'navbar-form navbar-right'))!!}
            {!!Form::submit('Kirjaudu ulos', ['class' => 'btn btn-default'])!!}
            {!!Form::close()!!}
            @endif
        </div>
    </div>
</nav>


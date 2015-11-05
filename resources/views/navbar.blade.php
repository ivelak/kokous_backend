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
                <li class="{{ Request::is('event-occurrences') ? 'active' : '' }}">{!!link_to('/event-occurrences', $title = 'Kalenterinäkymä')!!}</li>
                <li class="{{ Request::is('activities') ? 'active' : '' }}">{!!link_to('/activities', $title = 'Aktiviteetit')!!}</li> 
                <li class="{{ Request::is('users') ? 'active' : '' }}">{!!link_to('#', $title = 'Käyttäjät')!!}</li>    
                <li class="{{ Request::is('groups') ? 'active' : '' }}">{!!link_to('/groups', $title = 'Ryhmät')!!}</li>    

            </ul>
            @if(!Request::session()->has('admin'))
            {!!Form::open(['action' => 'AdminController@login'])!!}
            <input type="hidden" id="password" name="password"/>
            {!!Form::close()!!}
            <button onclick="adminLogin()" class="btn btn-default navbar-btn navbar-right">Hallinnointi</button>
            @else
            {!!Form::open(array('action' => 'AdminController@logout', 'method'=>'post', 'class'=>'navbar-form navbar-right'))!!}
            {!!Form::submit('Kirjaudu ulos', ['class' => 'btn btn-default'])!!}
            {!!Form::close()!!}
            @endif
        </div>
    </div>
</nav>


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
			<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kirjautuminen<span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li>
				@if(Auth::check())
				<a href="/saml2/logout" >Kirjaudu ulos</a>
				@else
				<a href="/saml2/login">Kirjaudu sisään</a>
				@endif	
				</li>
				<li>	
				@if(!Request::session()->has('admin'))
				<a id="adminloginbutton">Hallinnointi</a>
				@else
				<a id="adminlogoutbutton">Lopeta Hallinnointi</a>
				@endif
				</li>
			  </ul>
			</li>
		  </ul>
            @if(!Request::session()->has('admin'))
            {!!Form::open(['id'=>'adminlogin', 'action' => 'AdminController@login'])!!}
            <input type="hidden" id="password" name="password"/>
            {!!Form::close()!!}

            @else
            {!!Form::open(['id'=>'adminlogout', 'action' => 'AdminController@logout', 'method'=>'post'])!!}
            {!!Form::close()!!}
            @endif
        </div>
    </div>
</nav>

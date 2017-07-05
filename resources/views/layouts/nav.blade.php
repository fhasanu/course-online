    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
			<a class="navbar-brand" href="{{url('/')}}">Kursusin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/')}}">Home</a></li>
			<li>
				<a href="{{url('/checkout')}}">Snap</a>
			</li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li>
			<div class='panel-custom'>
		        @if (Auth::guest() && !Auth::guard('provider')->check() && strpos(Route::currentRouteName(), 'provider') !== false)
                    <li><a href="{{ route('provider.login') }}">Login</a></li>
                    <li><a href="{{ route('provider.register') }}">Register</a></li>
                @elseif(Auth::guest() && !Auth::guard('provider')->check())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @elseif(Auth::guard('provider')->check())
                    <li>
                        <a href="{{ route('provider.logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('provider.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
			</div>
			</li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class='below-navbar-custom'>
    </div>

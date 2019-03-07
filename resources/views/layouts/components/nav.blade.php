<nav class="navbar navbar-expand-md navbar-dark bg-primary navbar-laravel">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            Little Angels Portal
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ">

      @can('isAlumni')
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('alumnidashboard') }}">{{ __('Dashboard') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('add.event') }}">{{ __('Add Event') }}</a>
        </li>
    @endcan


            <!-- Left Side Of Navbar -->


          </ul><!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if(Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                  @if(Auth::user())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="#">
                                {{ __('User Profile') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </li>
                    @endif
            </ul>
        </div>
    </div>
</nav>

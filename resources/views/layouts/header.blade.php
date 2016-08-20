<nav class="navbar navbar-default navbar-static-top" >
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Alumni Registry
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/signup') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->middle_name . ' ' .  Auth::user()->last_name}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.edit', Auth::user()->id) }}"><i class="fa fa-btn fa-user">
                                    </i>&nbsp;&nbsp;Account</a></li>
                            @if (Auth::user()->hasRole('admin'))
                                <li><a href="{{ route('users.approval', Auth::user()->id) }}"><i class="fa fa-check"></i>
                                        </i>Approvals</a></li>
                                <li><a href="{{ route('users.approval', Auth::user()->id) }}"><i class="fa fa-graduation-cap"></i>
                                        </i>Courses & Majors</a></li>
                                <li><a href="{{ route('users.index', Auth::user()->id) }}"><i class="fa fa-btn fa-users">
                                        </i>&nbsp;Users</a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
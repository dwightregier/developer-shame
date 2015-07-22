<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        {{-- Brand and toggle get grouped for better mobile display --}}
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img alt="Brand" src="{{ asset('/images/logo.png') }}" width="40"> DeveloperShame.com
            </a>
        </div>

        {{-- Authenticated links --}}
        @if(Auth::check())

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-code fa-fw"></i> Shames <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('shame.create') }}"><i class="fa fa-plus fa-fw"></i> Post a Shame</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> Profile <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('auth.getLogout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        {{-- Anonymous links --}}
        @else

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="{{ set_active('login') }}">
                        <a href="{{ route('auth.getLogin') }}"><i class="fa fa-user fa-fw"></i> Register / Login</a>
                    </li>
                </ul>
            </div>

        @endif


    </div>
</nav>
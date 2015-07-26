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
                            <li class="{{ set_active('shames/featured') }}">
                                <a href="{{ route('shames.featured') }}"><i class="fa fa-check-circle fa-fw"></i> Featured Shames</a>
                            </li>
                            <li class="{{ set_active('shames/top') }}">
                                <a href="{{ route('shames.top') }}"><i class="fa fa-arrow-up fa-fw"></i> Top Shames</a>
                            </li>
                            <li class="{{ set_active('shames/new') }}">
                                <a href="{{ route('shames.new') }}"><i class="fa fa-asterisk fa-fw"></i> New Shames</a>
                            </li>
                            <li class="{{ set_active('shames/random') }}">
                                <a href="{{ route('shames.random') }}"><i class="fa fa-random fa-fw"></i> Random Shames</a>
                            </li>
                            <li class="{{ set_active('shames/create') }}">
                                <a href="{{ route('shames.create') }}"><i class="fa fa-plus fa-fw"></i> Post a Shame</a>
                            </li>
                        </ul>
                    </li>

                    @include('shared.notifications')

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> Profile <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ set_active('badges') }}">
                                <a href="{{ route('badges.index') }}">
                                    <i class="fa fa-sign-out fa-fw"></i> Badges
                                </a>
                            </li>
                            <li class="{{ set_active('shames') }}">
                                <a href="{{ route('shames.index') }}">
                                    <i class="fa fa-check-circle fa-fw"></i> Posted Shames
                                </a>
                            </li>
                            <li class="{{ set_active('logout') }}">
                                <a href="{{ route('auth.getLogout') }}">
                                    <i class="fa fa-sign-out fa-fw"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        {{-- Anonymous links --}}
        @else

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-code fa-fw"></i> Shames <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ set_active('shames/featured') }}">
                                <a href="{{ route('shames.featured') }}"><i class="fa fa-check-circle fa-fw"></i> Featured Shames</a>
                            </li>
                            <li class="{{ set_active('shames/top') }}">
                                <a href="{{ route('shames.top') }}"><i class="fa fa-arrow-up fa-fw"></i> Top Shames</a>
                            </li>
                            <li class="{{ set_active('shames/new') }}">
                                <a href="{{ route('shames.new') }}"><i class="fa fa-asterisk fa-fw"></i> New Shames</a>
                            </li>
                            <li class="{{ set_active('shames/random') }}">
                                <a href="{{ route('shames.random') }}"><i class="fa fa-random fa-fw"></i> Random Shames</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ set_active('login') }}">
                        <a href="{{ route('auth.getLogin') }}"><i class="fa fa-user fa-fw"></i> Register / Login</a>
                    </li>
                </ul>
            </div>

        @endif


    </div>
</nav>
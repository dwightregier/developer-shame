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

        {{-- Collect the nav links, forms, and other content for toggling --}}
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ set_active("/login") }}">
                    <a href="{{ route('auth.getLogin') }}"><i class="fa fa-user fa-fw"></i> Register / Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
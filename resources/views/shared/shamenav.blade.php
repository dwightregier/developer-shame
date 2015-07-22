<div class="panel panel-default">
    <div class="panel-heading">Shames</div>
    <div class="list-group">
        <a href="{{ route('shames.featured') }}" class="list-group-item{{set_active('shames/featured', ' active') }}">
            <i class="fa fa-check-circle fa-fw"></i> Featured Shames
        </a>
        <a href="{{ route('shames.top') }}" class="list-group-item{{set_active('shames/top', ' active') }}">
            <i class="fa fa-arrow-up fa-fw"></i> Top Shames
        </a>
        <a href="{{ route('shames.new') }}" class="list-group-item{{set_active('shames/new', ' active') }}">
            <i class="fa fa-asterisk fa-fw"></i> New Shames
        </a>
        <a href="{{ route('shames.random') }}" class="list-group-item{{set_active('shames/random', ' active') }}">
            <i class="fa fa-random fa-fw"></i> Random Shames
        </a>

        @if (Auth::check())
            <a href="{{ route('shames.create') }}" class="list-group-item{{ set_active('shames/create', ' active') }}">
                <i class="fa fa-plus fa-fw"></i> Post a Shame
            </a>
        @endif
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Profile</div>
    <div class="list-group">
        <a href="{{ route('badges.index') }}" class="list-group-item{{set_active('badges', ' active') }}">
            <i class="fa fa-sign-out fa-fw"></i> Badges
        </a>
        <a href="{{ route('shames.index') }}" class="list-group-item{{set_active('shames', ' active') }}">
            <i class="fa fa-check-circle fa-fw"></i> Posted Shames
        </a>
        <a href="{{route('comments.index') }}" class="list-group-item{{set_active('comments', ' active') }}">
            <i class="fa fa-comments"></i> Posted Comments
        </a>
        <a href="{{ route('auth.getLogout') }}" class="list-group-item"">
        <i class="fa fa-sign-out fa-fw"></i> Logout
        </a>
    </div>
</div>
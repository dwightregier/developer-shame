<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-flag"></i> Notifications
        <span class="badge">{{ Auth::user()->notifications()->unread()->count() }}</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        @foreach (Auth::user()->notifications()->with('shame')->get() as $notification)
            <li>
                <a href="{{ $notification->url() }}" class="notification">
                    <strong><i class="fa {{ $notification->icon() }}"></i> {{ $notification->type }} Notification:</strong><br>
                    {!! $notification->body() !!}
                </a>
            </li>
        @endforeach
    </ul>
</li>
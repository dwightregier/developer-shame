<?php

namespace App\Http\Middleware;

use App\Notification;
use Auth;
use Closure;

class ClearNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $notification_id = $request->query('notification');
        if ($notification_id)
        {
            if (Auth::check())
            {
                $user = Auth::user();
                $notification = Notification::find($notification_id);

                if ($notification->user_id == $user->id)
                {
                    $notification->is_read = true;
                    $notification->save();
                }
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Listeners;

use App\Events\ShameWasUpdated;
use App\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendShameNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ShameWasUpdated  $event
     * @return void
     */
    public function handle(ShameWasUpdated $event)
    {
        $shame = $event->shame;
        $users = $shame->follows;

        foreach ($users as $user) {
            $notification = new Notification;
            $notification->type = "Shame";
            $notification->is_read = false;
            $notification->user_id = $user->id;
            $notification->shame_id = $shame->id;

            $notification->save();
        }
    }
}

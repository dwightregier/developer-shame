<?php

namespace App\Listeners;

use App\Events\CommentWasAdded;
use App\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentNotification
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
     * @param  CommentWasAdded  $event
     * @return void
     */
    public function handle(CommentWasAdded $event)
    {
        $comment = $event->comment;
        $shame = $comment->shame;
        $users = $shame->follows;

        foreach ($users as $user)
        {
            $notification = new Notification;
            $notification->type = "Comment";
            $notification->is_read = false;
            $notification->user_id = $user->id;
            $notification->shame_id = $shame->id;
            $notification->comment_id = $comment->id;

            $notification->save();
        }
    }
}

<?php

namespace App\Events;

use App\Events\Event;
use App\Shame;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShameWasUpdated extends Event
{
    use SerializesModels;

    public $shame;

    /**
     * Create a new event instance.
     *
     * @param Shame $shame
     */
    public function __construct(Shame $shame)
    {
        $this->shame = $shame;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}

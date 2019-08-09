<?php

namespace Modules\Icampaign\Events;

use Illuminate\Queue\SerializesModels;

class EmitNotifications
{
    use SerializesModels;

    public $recipient;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($recipient)
    {
      $this->recipient = $recipient;
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

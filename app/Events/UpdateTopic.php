<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateTopic
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var $topic
     */
    public $topic;

    /**
     * Create the event listener.
     *
     * @param $topic
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Pay
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $status;
    public $dataUser;
    public $dataAmount;

    /**
     * Create a new event instance.
     *
     * @param bool $status
     * @param $dataUser
     * @param $dataAmount
     */
    public function __construct($status, $dataUser, $dataAmount)
    {
        $this->status = $status;
        $this->dataUser = $dataUser;
        $this->dataAmount = $dataAmount;
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

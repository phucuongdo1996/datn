<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteSubUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var $mainUser
     */
    public $mainUser;

    /**
     * @var $subUser
     */
    public $subUser;

    /**
     * MailDeleteSubUser constructor.
     * @param $mainUser
     * @param $subUser
     */
    public function __construct($mainUser, $subUser)
    {
        $this->mainUser = $mainUser;
        $this->subUser = $subUser;
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

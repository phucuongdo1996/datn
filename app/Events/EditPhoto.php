<?php


namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EditPhoto
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var $articlePhoto
     */
    public $articlePhoto;

    /**
     * @var $profileUser
     */
    public $profileUser;

    /**
     * Create the event listener.
     *
     * @param $articlePhoto
     * @param $profileUser
     */
    public function __construct(
        $articlePhoto,
        $profileUser
    ) {
        $this->articlePhoto = $articlePhoto;
        $this->profileUser = $profileUser;
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

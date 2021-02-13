<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MoveSubUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var $dataMailFromUser
     */
    public $dataMailFromUser;

    /**
     * @var $dataMailToUser
     */
    public $dataMailToUser;

    /**
     * @var $propertyMoved
     */
    private $subUserMoved;

    /**
     * @var $userReceived
     */
    private $userReceived;

    /**
     * Set data for user
     *
     * @param $userReceived
     * @return $this
     */
    public function setUserReceived($userReceived)
    {
        $this->userReceived = $userReceived;

        return $this;
    }

    /**
     * Set house name for email send to user
     *
     * @param $subUserMoved
     * @return $this
     */
    public function setSubUserMoved($subUserMoved)
    {
        $this->subUserMoved = $subUserMoved;

        return $this;
    }

    /**
     * Set data user to
     *
     * @return $this
     */
    public function setDataMailToUser()
    {
        $this->dataMailToUser = [
            'person_charge_first_name_to' => optional($this->userReceived->profile)->person_charge_first_name,
            'person_charge_last_name_to' => optional($this->userReceived->profile)->person_charge_last_name,
            'person_charge_first_name_from' => request('person_charge_first_name_from'),
            'person_charge_last_name_from' => request('person_charge_last_name_from'),
            'email' => request('sub_user_email_to'),
            'sub_user_data' => $this->subUserMoved,
        ];

        return $this;
    }

    /**
     * Set data user from
     *
     * @return $this
     */
    public function setDataMailFromUser()
    {
        $this->dataMailFromUser = [
            'person_charge_first_name_to' => optional($this->userReceived->profile)->person_charge_first_name,
            'person_charge_last_name_to' => optional($this->userReceived->profile)->person_charge_last_name,
            'person_charge_first_name_from' => request('person_charge_first_name_from'),
            'person_charge_last_name_from' => request('person_charge_last_name_from'),
            'email' => request('email_from'),
            'sub_user_data' => $this->subUserMoved,
        ];

        return $this;
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

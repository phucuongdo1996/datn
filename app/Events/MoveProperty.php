<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MoveProperty
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
    private $propertyMoved;

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
     * @param $propertyMoved
     * @return $this
     */
    public function setPropertyMoved($propertyMoved)
    {
        $this->propertyMoved = $propertyMoved;

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
            'email' => request('email_to'),
            'house_name' => $this->propertyMoved,
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
            'house_name' => $this->propertyMoved,
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

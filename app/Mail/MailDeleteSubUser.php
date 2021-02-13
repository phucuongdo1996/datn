<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailDeleteSubUser extends Mailable
{
    use Queueable, SerializesModels;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.delete_sub_user')->subject(trans('messages.email.sub_user.subject'));
    }
}

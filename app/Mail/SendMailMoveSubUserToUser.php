<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailMoveSubUserToUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $data
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.move_sub_user_to_user')->subject(trans('mail-attributes.admin_move_sub_user.title_to'));
    }
}

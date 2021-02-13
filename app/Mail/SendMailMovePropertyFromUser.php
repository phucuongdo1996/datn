<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailMovePropertyFromUser extends Mailable
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
        return $this->view('email.move_property_from_user')->subject(trans('mail-attributes.admin_move_property.title_from'));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailToUserPayError extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $dataUser;
    public $dataAmount;

    /**
     * Create a new event instance.
     *
     * @param $dataUser
     * @param $dataAmount
     */
    public function __construct($dataUser, $dataAmount)
    {
        $this->dataUser = $dataUser;
        $this->dataAmount = $dataAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.pay_error_to_user')->subject(trans('messages.pay.error.subject_error'));
    }
}

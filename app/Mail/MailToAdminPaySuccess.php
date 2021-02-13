<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailToAdminPaySuccess extends Mailable
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
        return $this->view('email.pay_success_to_admin')->subject(trans('messages.pay.subject_email'));
    }
}

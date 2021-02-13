<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class ResetPasswordMail extends Mailable
{
    /**
     * Send Mail Reset Password
     *
     * @param array $infoSendMail
     */
    public function sendMailResetPassword(array $infoSendMail)
    {
        Mail::send('forgot_password.form_mail', ['link' => $infoSendMail['link_reset_password']],
            function ($message) use ($infoSendMail) {
                $message->to($infoSendMail['email'], 'CYARea!')->subject(trans('mail-attributes.title'));
            });
    }

}

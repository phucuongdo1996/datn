<?php

namespace App\Mail;

use Illuminate\Support\Facades\Mail;

class SendMailInviteUser
{
     /**
     * Send mail verified by admin
     *
     * @param  array  $infoSendMail
     */
    public function sendMailVerified(array $infoSendMail)
    {
        Mail::send('backend/admin/mail/form_invite_user', ['info' => $infoSendMail], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')->subject(trans('mail-attributes.title_admin_send'));
        });
    }
}

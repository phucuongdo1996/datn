<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class SendMailToSubUser extends Mailable
{
    /**
     * Send mail verified to sub user
     *
     * @param array $infoSendMail
     */
    public function sendMailVerifySubUser(array $infoSendMail)
    {
        Mail::send('backend/sub_user/form_mail', [
            'nameParentUser' => $infoSendMail['nameParentUser'],
            'lastName' => $infoSendMail['lastName'],
            'firstName' => $infoSendMail['firstName'],
            'link' => $infoSendMail['link'],
            'email' => $infoSendMail['email'],
            'password' => $infoSendMail['password'],
            'role' => $infoSendMail['role']
        ], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')
                ->subject(trans('attributes.sub_user.title_mail') . $infoSendMail['nameParentUser'] . trans('attributes.sub_user.title_mail_2'));
        });
    }
}

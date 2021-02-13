<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class ChangeMemberStatus extends Mailable
{
    /**
     * Send mail change member status to free
     *
     * @param array $infoSendMail
     */
    public function sendMailChangeToFree(array $infoSendMail)
    {
        Mail::send('email.change_member_status_to_free', [
            'lastName' => $infoSendMail['lastName'],
            'firstName' => $infoSendMail['firstName'],
        ], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')
                ->subject(trans('mail-attributes.change_member_status.subject_to_free'));
        });
    }

    /**
     * Send mail change member status to fee
     *
     * @param array $infoSendMail
     */
    public function sendMailChangeToFee(array $infoSendMail)
    {
        Mail::send('email.change_member_status_to_fee', [
            'lastName' => $infoSendMail['lastName'],
            'firstName' => $infoSendMail['firstName'],
        ], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')
                ->subject(trans('mail-attributes.change_member_status.subject_to_fee'));
        });
    }

    /**
     * Send mail change member status to premium
     *
     * @param array $infoSendMail
     */
    public function sendMailChangeToPremium(array $infoSendMail)
    {
        Mail::send('email.change_member_status_to_premium', [
            'lastName' => $infoSendMail['lastName'],
            'firstName' => $infoSendMail['firstName'],
        ], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')
                ->subject(trans('mail-attributes.change_member_status.subject_to_premium'));
        });
    }
}

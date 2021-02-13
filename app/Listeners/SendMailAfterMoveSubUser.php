<?php

namespace App\Listeners;

use App\Events\MoveSubUser;
use App\Mail\SendMailMoveSubUserFromUser;
use App\Mail\SendMailMoveSubUserToUser;
use Illuminate\Support\Facades\Mail;

class SendMailAfterMoveSubUser
{
    /**
     * Handle the event.
     *
     * @param  MoveSubUser  $event
     * @return void
     */
    public function handle(MoveSubUser $event)
    {
        Mail::to($event->dataMailFromUser['email'])->send(new SendMailMoveSubUserFromUser($event->dataMailFromUser));
        Mail::to($event->dataMailToUser['email'])->send(new SendMailMoveSubUserToUser($event->dataMailToUser));
    }
}

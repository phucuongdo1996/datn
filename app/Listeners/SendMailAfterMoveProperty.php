<?php

namespace App\Listeners;

use App\Events\MoveProperty;
use App\Mail\SendMailMovePropertyFromUser;
use App\Mail\SendMailMovePropertyToUser;
use Illuminate\Support\Facades\Mail;

class SendMailAfterMoveProperty
{
    /**
     * Handle the event.
     *
     * @param  MoveProperty  $event
     * @return void
     */
    public function handle(MoveProperty $event)
    {
        Mail::to($event->dataMailFromUser['email'])->send(new SendMailMovePropertyFromUser($event->dataMailFromUser));
        Mail::to($event->dataMailToUser['email'])->send(new SendMailMovePropertyToUser($event->dataMailToUser));
    }
}

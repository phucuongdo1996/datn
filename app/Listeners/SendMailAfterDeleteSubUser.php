<?php

namespace App\Listeners;

use App\Events\DeleteSubUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\MailDeleteSubUser;
use Illuminate\Support\Facades\Mail;

class SendMailAfterDeleteSubUser implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  MailDeleteSubUser  $event
     * @return void
     */
    public function handle(DeleteSubUser $event)
    {
        Mail::to($event->mainUser['email'])->send(new MailDeleteSubUser($event->mainUser, $event->subUser));
    }
}

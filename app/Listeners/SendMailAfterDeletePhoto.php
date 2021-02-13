<?php

namespace App\Listeners;

use App\Events\SendMailDeletePhoto;
use App\Mail\MailDeletePhoto;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterDeletePhoto implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  SendMailDeletePhoto  $event
     * @return void
     */
    public function handle(SendMailDeletePhoto $event)
    {
        Mail::to($event->photo->user->email)->send(new MailDeletePhoto($event->photo));
    }
}

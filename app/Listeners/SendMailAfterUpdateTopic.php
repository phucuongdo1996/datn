<?php

namespace App\Listeners;

use App\Events\UpdateTopic;
use App\Mail\SendMailUpdateTopic;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterUpdateTopic
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UpdateTopic  $event
     * @return void
     */
    public function handle(UpdateTopic $event)
    {
        Mail::to($event->topic['email'])->send(new SendMailUpdateTopic($event->topic));
    }
}

<?php

namespace App\Listeners;

use App\Events\EditProperty;
use App\Mail\MailEditProperty;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterEditProperty implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  EditProperty  $event
     * @return void
     */
    public function handle(EditProperty $event)
    {
        Mail::to($event->dataProperty['user']['email'])->send(new MailEditProperty($event->dataDirty, $event->dataProperty, $event->propertyOld));
    }
}

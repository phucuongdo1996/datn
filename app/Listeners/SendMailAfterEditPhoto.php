<?php


namespace App\Listeners;


use App\Events\EditPhoto;
use App\Mail\SendMailEditPhoto;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterEditPhoto
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  EditPhoto  $event
     * @return void
     */
    public function handle(EditPhoto $event)
    {
        Mail::to($event->profileUser['email'])->send(new SendMailEditPhoto(array_merge($event->articlePhoto, $event->profileUser)));
    }

}

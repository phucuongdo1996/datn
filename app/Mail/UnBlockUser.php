<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UnBlockUser extends Mailable
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var $user
     */
    public $user;

    /**
     *  Create a new message instance
     *
     * UnBlockUser constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $user = $this->user;
        Mail::send('email.unblock_user', ['user' => $user], function ($message) use ($user) {
            $message->to($user['email'], 'CYARea!')->subject(trans('mail-attributes.unblock_user.subject'));
        });
    }
}

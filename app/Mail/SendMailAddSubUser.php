<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailAddSubUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var $subUser
     */
    public $subUser;

    /**
     * @var $mainUser
     */
    public $mainUser;

    /**
     * Create a new message instance.
     *
     * @param $subUser
     * @param $mainUser
     *
     * @return void
     */
    public function __construct(
        $subUser,
        $mainUser
    ) {
        $this->subUser = $subUser;
        $this->mainUser = $mainUser;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $mainUser = $this->mainUser;
        Mail::send('backend/admin/mail/form_add_sub_user', ['subUser' => $this->subUser, 'mainUser' => $this->mainUser], function ($message) use ($mainUser) {
            $message->to($mainUser['email'], 'CYARea!')->subject(trans('mail-attributes.admin_add_sub_user.title'));
        });
    }
}

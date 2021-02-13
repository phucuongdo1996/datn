<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CreateSupport implements ShouldQueue
{
    use Queueable;
    use SerializesModels;
    use Dispatchable;
    use InteractsWithQueue;

    /**
     * @var $support
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function handle()
    {
        $data = $this->data;
        Mail::send('email.support_to_user', ['data' => $this->data], function ($message) use ($data) {
            $message->to($data['email'], 'CYARea!')->subject(trans('mail-attributes.support.subject_for_user'));
        });
        Mail::send('email.support_to_admin', ['data' => $this->data], function ($message) use ($data) {
            $message->to($data['mail_admin'], 'CYARea!')->subject(trans('mail-attributes.support.subject_for_admin'));
        });
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DestroyUser implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var array $data
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
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
        Mail::send('email.delete_user', [
            'last_name' => $this->user['profile']['person_charge_last_name'],
            'first_name' => $this->user['profile']['person_charge_first_name'],
        ], function ($message) use ($user) {
            $message->to($user['email'], 'CYARea!')->subject(trans('mail-attributes.delete_user.subject'));
        });
    }
}

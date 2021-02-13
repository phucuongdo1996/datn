<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailDeleteTopic extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var $data
     */
    public $data;

    /**
     * SendMailDeleteTopic constructor.
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
    public function build()
    {
        return $this->view('email.delete_topic')->subject(trans('messages.email.topic.subject1') .
            trans('mail-attributes.admin_edit_topic.customer_topics') . trans('messages.email.topic.subject2'));
    }
}

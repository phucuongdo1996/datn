<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUpdateTopic extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var $data
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
    public function build()
    {
        return $this->view('email.update_topic')->subject(trans('mail-attributes.admin_edit_topic.title_first') .
            trans('mail-attributes.admin_edit_topic.customer_topics') . trans('mail-attributes.admin_edit_topic.title_second'));
    }
}

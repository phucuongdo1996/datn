<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailEditProperty extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $dataDirty
     */
    public $dataDirty;

    /**
     * @var $dataProperty
     */
    public $dataProperty;

    /**
     * @var $propertyOld
     */
    public $propertyOld;

    /**
     * MailEditProperty constructor.
     * @param $dataDirty
     * @param $dataProperty
     * @param $propertyOld
     */
    public function __construct($dataDirty, $dataProperty, $propertyOld)
    {
        $this->dataDirty = $dataDirty;
        $this->dataProperty = $dataProperty;
        $this->propertyOld = $propertyOld;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.edit_property')->subject(trans('messages.email.edit_property.title'));
    }
}

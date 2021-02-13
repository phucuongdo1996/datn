<?php

namespace App\Listeners;

use App\Events\Pay;
use App\Mail\MailToAdminPaySuccess;
use App\Mail\MailToUserPayError;
use App\Mail\MailToUserPaySuccess;
use App\Repositories\PaymentError\PaymentErrorRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailPay implements ShouldQueue
{
    /**
     * @var PaymentErrorRepositoryInterface
     */
    private $paymentErrorRepository;

    /**
     * SendMailPay constructor.
     *
     * @param PaymentErrorRepositoryInterface $paymentErrorRepository
     */
    public function __construct(PaymentErrorRepositoryInterface $paymentErrorRepository)
    {
        $this->paymentErrorRepository = $paymentErrorRepository;
    }

    /**
     * Handle the event.
     *
     * @param  Pay  $event
     * @return void
     */
    public function handle(Pay $event)
    {
        if ($event->status) {
            Mail::to($event->dataUser['email'])->send(new MailToUserPaySuccess($event->dataUser, $event->dataAmount));
            Mail::to(config('mail.mail_admin'))->send(new MailToAdminPaySuccess($event->dataUser, $event->dataAmount));
        } else {
            Mail::to($event->dataUser['email'])->send(new MailToUserPayError($event->dataUser, $event->dataAmount));
            $this->paymentErrorRepository->create(['user_id' => $event->dataUser['id']]);
        }
    }
}

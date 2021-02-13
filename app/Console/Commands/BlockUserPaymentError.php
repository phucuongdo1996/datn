<?php

namespace App\Console\Commands;

use App\Repositories\PaymentError\PaymentErrorRepositoryInterface;
use Illuminate\Console\Command;

class BlockUserPaymentError extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'block-user:payment-error';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Block user payment error';

    /**
     * Execute the console command.
     *
     * @param PaymentErrorRepositoryInterface $paymentErrorRepository
     */
    public function handle(PaymentErrorRepositoryInterface $paymentErrorRepository)
    {
        $paymentErrorRepository->blockUserPaymentError();
    }
}

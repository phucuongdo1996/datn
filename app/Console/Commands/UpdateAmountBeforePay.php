<?php

namespace App\Console\Commands;

use App\Api\Pay\PayApi;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use Illuminate\Console\Command;

class UpdateAmountBeforePay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:update-amount-before-pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update amount before pay';

    /**
     * Execute the console command.
     *
     * @param UserSubscriptionRepositoryInterface $userTrialRepository
     * @param PayApi $payApi
     */
    public function handle(
        UserSubscriptionRepositoryInterface $userTrialRepository,
        PayApi $payApi
    ) {
        $payApi->updateAmountBeforePay($userTrialRepository->getDataBeforePay());
    }
}

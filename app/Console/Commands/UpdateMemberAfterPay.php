<?php

namespace App\Console\Commands;

use App\Api\Pay\PayApi;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use Illuminate\Console\Command;

class UpdateMemberAfterPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:update-member-after-pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update member after pay';

    /**
     * Execute the console command.
     *
     * @param UserSubscriptionRepositoryInterface $userSubscriptionRepository
     * @param PayApi $payApi
     */
    public function handle(
        UserSubscriptionRepositoryInterface $userSubscriptionRepository,
        PayApi $payApi
    ) {
        $payApi->updateMemberAfterPay($userSubscriptionRepository->getDataAfterPay());
    }
}

<?php

namespace App\Api\Pay;

use App\Repositories\PayDetail\PayDetailRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Payjp\Customer;
use Payjp\Subscription;
use Payjp\Payjp;

class PayApi implements PayApiInterface
{
    /**
     * PayApi constructor.
     */
    public function __construct()
    {
        Payjp::setApiKey(config('pay_jp.secret_key'));
    }

    /**
     * Create card
     *
     * @param $user
     * @param $payToken
     * @return bool
     */
    public function createCard($user, $payToken)
    {
        try {
            if (!$user->id_cus) {
                $this->createCustomer($user);
            }
            $cu = Customer::retrieve($user->id_cus);
            $cu->cards->create(array(
                "card" => $payToken
            ));
            return true;
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
            return false;
        }
    }

    /**
     * Create customer
     *
     * @param $user
     */
    public function createCustomer($user)
    {
        try {
            $record = Customer::create([
                'email' => $user->email
            ]);
            $user->id_cus = $record['id'];
            $user->save();
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
        }
    }

    /**
     * get data customer
     *
     * @param $idCus
     * @return \Payjp\Customer|null
     */
    public function getDataCustomer($idCus)
    {
        if ($idCus) {
            return Customer::retrieve($idCus);
        }
        return null;
    }

    /**
     * delete card
     *
     * @param $idCus
     * @param $idCar
     * @return bool
     */
    public function deleteCard($idCus, $idCar)
    {
        try {
            $card = Customer::retrieve($idCus)->cards->retrieve($idCar);
            $card->delete();
            return true;
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
            return false;
        }
    }

    /**
     * create plan
     *
     * @param $amounts
     * @param $billingDay
     * @param $trialName
     * @return \Payjp\Plan
     */
    public function createPlan($amounts, $billingDay, $trialName)
    {
        try {
            return \Payjp\Plan::create(array(
                "amount" => round($amounts),
                'billing_day' => $billingDay,
                "currency" => CURRENCY_UNIT,
                "interval" => "month",
                "trial_days" => $trialName == TRIAL_NAME ? TRIAL_DAYS : TRIAL_DAYS_DEFAULT,
                'name' => $trialName
            ));
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
        }
    }

    /**
     * Create trial
     *
     * @param $user
     * @param $typeChangeStatus
     * @return bool
     */
    public function createTrial($user, $typeChangeStatus)
    {
        try {
            $totalAmount = resolve(UserRepositoryInterface::class)->calculateAmountBySubUserAndAccount($user->id, $typeChangeStatus)['total_amount'];
            if ($totalAmount < AMOUNT_MIN_PAY) {
                $this->createTrialLowAmount($user, $typeChangeStatus);
            } else {
                $plan = $this->createPlan($totalAmount, date("d", time() + TRIAL_DAY_BY_SECONDS), TRIAL_NAME);
                $subscription = Subscription::create(
                    array(
                        "customer" => $user->id_cus,
                        "plan" => $plan['id']
                    )
                );
                resolve(UserSubscriptionRepositoryInterface::class)->createRecord([
                    'user_id' => $user->id,
                    'id_subscription' => $subscription['id'],
                    'status' => TRIALS,
                    'trial_status' => $typeChangeStatus,
                    'is_trial' => true,
                    'paused_status' => false,
                    'paused_type' => null
                ]);
            }
            return true;
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
            return false;
        }
    }

    /**
     * @param $user
     * @param $typeChangeStatus
     */
    public function createTrialLowAmount($user, $typeChangeStatus)
    {
        $plan = $this->createPlan(AMOUNT_MIN_PAY, date("d", time() + TRIAL_DAY_BY_SECONDS), TRIAL_NAME);
        $subscription = Subscription::create(
            array(
                "customer" => $user->id_cus,
                "plan" => $plan['id']
            )
        );
        $subscription->pause();
        resolve(UserSubscriptionRepositoryInterface::class)->createRecord([
            'user_id' => $user->id,
            'id_subscription' => $subscription['id'],
            'status' => TRIALS,
            'trial_status' => $typeChangeStatus,
            'is_trial' => true,
            'paused_status' => true,
            'paused_type' => PAUSED_BY_LOW_AMOUNT
        ]);
    }

    /**
     * Upgrade Plan
     *
     * @param $amountCurrently
     * @param $subscription
     * @param $typeUpgrade
     * @return bool
     */
    public function upgradePlan($amountCurrently, $subscription, $typeUpgrade)
    {
        $plan = $this->createPlan($amountCurrently, date("d", time()), PLAN_NAME[$typeUpgrade]);
        $subscription->plan = $plan;
        return true;
    }

    /**
     * Downgrade Plan
     *
     * @param $user
     * @param $subscription
     * @param $typeUpgrade
     * @return bool
     */
    public function downgradePlan($user, $subscription, $typeUpgrade)
    {
        $amount = resolve(UserRepositoryInterface::class)->calculateAmountBySubUserAndAccount($user->id, $typeUpgrade);
        $plan = $this->createPlan($amount['total_amount'], $subscription->plan->billing_day, PLAN_NAME[$typeUpgrade]);
        $subscription->trial_end = Carbon::now()->addHour()->getTimestamp();
        $subscription->plan = $plan;
        return true;
    }

    /**
     * Update time pay and discount plan
     *
     * @param $subscription
     * @param $data
     * @param $userId
     * @return bool
     */
    public function updateTimePlan($subscription, $data, $userId)
    {
        DB::beginTransaction();
        try {
            $user = resolve(UserRepositoryInterface::class)->find($userId);
            $subscription = $this->getSubscription($subscription->id_subscription);
            if ($subscription->status == 'paused' && ($user->userSubscription->paused_type != PAUSED_BY_LOW_AMOUNT)) {
                return true;
            }
            $amount = getAmountFee($user->role, $user->getMemberStatus(), $user->total_sub, $data['discount']);
            if ($amount['total_amount'] < AMOUNT_MIN_PAY) {
                if ($subscription->status != 'paused') {
                    $subscription->pause();
                }
                $user->userSubscription()->update([
                    'discount' => $data['discount'],
                    'paused_status' => true,
                    'paused_type' => PAUSED_BY_LOW_AMOUNT
                ]);
            } else {
                if ($subscription->status == 'paused' && $user->userSubscription->paused_type == PAUSED_BY_LOW_AMOUNT) {
                    $subscription->resume();
                }
                $plan = $this->createPlan($amount['total_amount'], date('d', strtotime($data['finish_date'])), $subscription->plan['name']);
                $subscription->plan = $plan;
                $subscription->trial_end = strtotime($data['finish_date']);
                $subscription->save();
                $user->userSubscription()->update([
                    'finish_date' => $data['finish_date'],
                    'discount' => $data['discount'],
                    'paused_status' => false,
                    'paused_type' => null
                ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * get subscription
     *
     * @param $id
     * @return Subscription
     */
    public function getSubscription($id)
    {
        return Subscription::retrieve($id);
    }

    /**
     * upgrade
     *
     * @param $user
     * @param $typeUpgrade
     * @return bool
     */
    public function upgrade($user, $typeUpgrade)
    {
        return $user->inTrial() ? $this->changeMemberStatusForTrial($user, $typeUpgrade) : $this->upgradeForNotTrial($user, $typeUpgrade);
    }

    /**
     * Upgrade for not Trial
     *
     * @param $user
     * @param $typeUpgrade
     * @return bool
     */
    public function upgradeForNotTrial($user, $typeUpgrade)
    {
        DB::beginTransaction();
        try {
            $subscription = $this->getSubscription($user->userSubscription->id_subscription);
            $amounts = resolve(UserRepositoryInterface::class)->calculateAmountBySubUserAndAccount($user->id, $typeUpgrade);
            if ($amounts['total_amount'] < AMOUNT_MIN_PAY) {
                $this->upgradeForNotTrialLowAmount($subscription, $user, $typeUpgrade, $amounts);
            } else {
                if ($subscription->status == 'paused') {
                    $subscription->resume();
                }
                $this->upgradePlan($amounts['total_amount'], $subscription, $typeUpgrade);
                $subscription->trial_end = 'now';
                $subscription->save();
                $subscriptionResult = $this->getSubscription($user->userSubscription->id_subscription);
                if ($subscriptionResult['status'] == 'active') {
                    // Update database
                    $user->userSubscription()->update([
                        'status' => $typeUpgrade,
                        'start_date' => date('Y-m-d', time()),
                        'finish_date' => getDayInNextMonth(date('Y-m-d', time())),
                        'is_trial' => false,
                        'paused_status' => false,
                        'paused_type' => null
                    ]);
                    $user->update(['member_status' => $typeUpgrade]);
                } else {
                    DB::rollBack();
                    return false;
                }
            }
            resolve(UserRepositoryInterface::class)->openCloseSubUser($user->id, OPEN);
            resolve(PayDetailRepositoryInterface::class)->createRecordChangePlan($user->id, $amounts, $typeUpgrade);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param $subscription
     * @param $user
     * @param $typeUpgrade
     * @param $amounts
     */
    public function upgradeForNotTrialLowAmount($subscription, $user, $typeUpgrade, $amounts)
    {
        if ($subscription->status != 'paused') {
            $subscription->pause();
        }
        $user->userSubscription()->update([
            'status' => $typeUpgrade,
            'start_date' => date('Y-m-d', time()),
            'finish_date' => getDayInNextMonth(date('Y-m-d', time())),
            'is_trial' => false,
            'paused_status' => true,
            'paused_type' => PAUSED_BY_LOW_AMOUNT
        ]);
        $user->update(['member_status' => $typeUpgrade]);
    }

    /**
     * Update amount before pay
     *
     * @param $datas
     */
    public function updateAmountBeforePay($datas)
    {
        foreach ($datas as $data) {
            try {
                $isTrial = $data['is_trial'] == true;
                $subscription = $this->getSubscription($data['id_subscription']);
                if ($isTrial && $data['trial_status'] == FREE) {
                    if ($subscription->status != 'paused') {
                        $subscription->pause();
                    }
                    resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                        'paused_status' => true,
                        'paused_type' => PAUSED_BY_USER
                    ]);
                } else {
                    $amount = $isTrial ? resolve(UserRepositoryInterface::class)->calculateAmountBySubUserAndAccount($data['user_id'], $data['trial_status'])
                        : resolve(UserRepositoryInterface::class)->calculateAmountBySubUserAndAccount($data['user_id']);
                    resolve(PayDetailRepositoryInterface::class)->createRecordBeforePay($data['user_id'], $amount, $isTrial ? $data['trial_status'] : $data['status']);
                    if ($amount['total_amount'] < AMOUNT_MIN_PAY) {
                        if ($subscription->status != 'paused') {
                            $subscription->pause();
                        }
                        resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                            'paused_status' => true,
                            'paused_type' => PAUSED_BY_LOW_AMOUNT
                        ]);
                    } else {
                        if ($subscription['status'] == 'paused') {
                            $subscription->resume();
                        }
                        if ($amount['total_amount'] == $subscription['plan']['amount']) {
                            continue;
                        }
                        $subscription->trial_end = Carbon::now()->addHour()->getTimestamp();
                        $subscription->plan = $isTrial ? $this->createPlan($amount['total_amount'], date("d", strtotime($data['finish_date'])), PLAN_NAME[$data['trial_status']])
                            : $this->createPlan($amount['total_amount'], date("d", strtotime($data['finish_date'])), PLAN_NAME[$data['status']]);
                        $subscription->save();
                        resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                            'paused_status' => false,
                            'paused_type' => null
                        ]);
                    }
                }
            } catch (\Exception $exception) {
                report($exception);
                continue;
            }
        }
    }

    /**
     * Change default card
     *
     * @param $idCus
     * @param $idCar
     * @return bool
     */
    public function changeDefaultCard($idCus, $idCar)
    {
        try {
            $customer = $this->getDataCustomer($idCus);
            $customer->default_card = $idCar;
            $customer->save();
            return true;
        } catch (\Exception $exception) {
            Log::channel('api_pay')->info($exception);
            return false;
        }
    }

    /**
     * downgrade
     *
     * @param $user
     * @param $typeDowngrade
     * @return bool
     */
    public function downgrade($user, $typeDowngrade)
    {
        return $user->inTrial() ? $this->changeMemberStatusForTrial($user, $typeDowngrade) : $this->downgradeForNotTrial($user, $typeDowngrade);
    }

    /**
     *  Downgrade for Trial
     *
     * @param $user
     * @param $type
     * @return bool
     */
    public function changeMemberStatusForTrial($user, $type)
    {
        DB::beginTransaction();
        try {
            if ($type == FREE) {
                resolve(UserRepositoryInterface::class)->openCloseSubUser($user->id, CLOSE);
            } else {
                resolve(UserRepositoryInterface::class)->openCloseSubUser($user->id, OPEN);
            }
            $user->userSubscription()->update([
                'trial_status' => $type
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Downgrade for not Trial
     *
     * @param $user
     * @param $typeDowngrade
     * @return bool
     */
    public function downgradeForNotTrial($user, $typeDowngrade)
    {
        DB::beginTransaction();
        try {
            $subscription = $this->getSubscription($user->userSubscription->id_subscription);
            if ($typeDowngrade == FREE) {
                // Down to Free member
                if ($subscription->status != 'paused') {
                    $subscription->pause(); // Pause Pay.jp
                }
                $user->userSubscription()->update([
                    'status' => $typeDowngrade,
                    'is_trial' => false,
                    'paused_status' => true,
                    'paused_type' => PAUSED_BY_USER
                ]);
                $user->update(['member_status' => FREE]);
                resolve(UserRepositoryInterface::class)->openCloseSubUser($user->id, CLOSE);
                resolve(PayDetailRepositoryInterface::class)->updateFinishDateOldRecord($user->id, date('Y-m-d'));
            } elseif ($typeDowngrade == BASIC) {
                // Down to Basic member
                $amount = resolve(UserRepositoryInterface::class)->calculateAmountBySubUserAndAccount($user->id, BASIC);
                if ($amount['total_amount'] < AMOUNT_MIN_PAY) {
                    // Resolve amount < 50 yen.
                    if ($subscription->status != 'paused') {
                        $subscription->pause();
                    }
                    $user->userSubscription()->update([
                        'status' => $typeDowngrade,
                        'is_trial' => false,
                        'paused_status' => true,
                        'paused_type' => PAUSED_BY_LOW_AMOUNT
                    ]);
                    $user->update(['member_status' => BASIC]);
                } else {
                    if ($subscription->status == 'paused') {
                        $subscription->resume();
                    }
                    $plan = $this->createPlan($amount['total_amount'], $subscription->plan->billing_day, PLAN_NAME[BASIC]);
                    $subscription->trial_end = Carbon::now()->addHour()->getTimestamp();
                    $subscription->plan = $plan;
                    $subscription->save();
                    $user->userSubscription()->update([
                        'status' => $typeDowngrade,
                        'is_trial' => false,
                        'paused_status' => false,
                        'paused_type' => null
                    ]);
                    $user->update(['member_status' => BASIC]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Update member after trial period
     *
     * @param $datas
     */
    public function updateMemberAfterPay($datas)
    {
        foreach ($datas as $item) {
            try {
                DB::beginTransaction();
                $subscription = $this->getSubscription($item['id_subscription']);
                if ($item['is_trial'] == true) {
                    $this->updateMemberAfterPayTrial($subscription, $item);
                } else {
                    $this->updateMemberAfterPayNotTrial($subscription, $item);
                }
                DB::commit();
            } catch (\Exception $exception) {
                report($exception);
                DB::rollBack();
                continue;
            }
        }
    }

    /**
     * Update member after pay trial
     *
     * @param $subscription
     * @param $data
     */
    public function updateMemberAfterPayTrial($subscription, $data)
    {
        if ($subscription['status'] == 'active' || ($data['paused_status'] == true && $data['paused_type'] == PAUSED_BY_LOW_AMOUNT)) {
            resolve(UserRepositoryInterface::class)->update($data['user_id'], [
                'member_status' => $data['trial_status']
            ]);
            resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                'status' => $data['trial_status'],
                'is_trial' => false,
                'start_date' => date('yy-m-d', time()),
                'finish_date' => checkDayExitsInMonth($subscription->plan['billing_day']),
            ]);
            resolve(PayDetailRepositoryInterface::class)->updateLastRecord($data['user_id']);
            $user = resolve(UserRepositoryInterface::class)->find($data['user_id']);
            resolve(UserRepositoryInterface::class)->sendMailChangeMemberStatus($user, $data['trial_status']);
        } elseif ($subscription['status'] == 'paused' && $data['paused_type'] != PAUSED_BY_LOW_AMOUNT) {
            resolve(UserRepositoryInterface::class)->update($data['user_id'], [
                'member_status' => FREE
            ]);
            resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                'status' => FREE,
                'is_trial' => false,
                'start_date' => date('yy-m-d', time()),
                'finish_date' => checkDayExitsInMonth($subscription->plan['billing_day']),
                'paused_status' => true,
                'paused_type' => PAUSED_BY_PAY_ERROR
            ]);
            resolve(PayDetailRepositoryInterface::class)->removeLastRecord($data['user_id']);
            $user = resolve(UserRepositoryInterface::class)->find($data['user_id']);
            resolve(UserRepositoryInterface::class)->sendMailChangeMemberStatus($user, FREE);
        }
    }

    /**
     * Update member after pay not trial
     *
     * @param $subscription
     * @param $data
     */
    public function updateMemberAfterPayNotTrial($subscription, $data)
    {
        if ($subscription['status'] == 'active' || ($data['paused_status'] == true && $data['paused_type'] == PAUSED_BY_LOW_AMOUNT)) {
            resolve(PayDetailRepositoryInterface::class)->updateLastRecord($data['user_id']);
            resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                'finish_date' => checkDayExitsInMonth($subscription->plan['billing_day']),
            ]);
        } else {
            resolve(UserRepositoryInterface::class)->update($data['user_id'], [
                'member_status' => FREE
            ]);
            resolve(UserSubscriptionRepositoryInterface::class)->update($data['id'], [
                'status' => FREE,
                'is_trial' => false,
                'start_date' => date('yy-m-d', time()),
                'finish_date' => checkDayExitsInMonth($subscription->plan['billing_day']),
                'paused_status' => true,
                'paused_type' => PAUSED_BY_PAY_ERROR
            ]);
            resolve(PayDetailRepositoryInterface::class)->removeLastRecord($data['user_id']);
            $user = resolve(UserRepositoryInterface::class)->find($data['user_id']);
            resolve(UserRepositoryInterface::class)->sendMailChangeMemberStatus($user, FREE);
        }
    }
}

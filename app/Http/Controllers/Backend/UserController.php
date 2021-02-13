<?php

namespace App\Http\Controllers\Backend;

use App\Api\Pay\PayApiInterface;
use App\Events\Pay;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SupportRequest;
use App\Mail\CreateSupport;
use App\Mail\DestroyUser;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Repositories\PayDetail\PayDetailRepositoryInterface;
use App\Repositories\Support\SupportEloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * @var \App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var \App\Repositories\Support\SupportEloquentRepository
     */
    private $supportRepository;

    /**
     * @var UserSubscriptionRepositoryInterface
     */
    private $userSubscriptionRepository;

    /**
     * @var \App\Api\Pay\PayApi
     */
    private $payApi;

    /**
     * @var \App\Repositories\PayDetail\PayDetailEloquentRepository
     */
    private $payDetailRepository;

    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param SupportEloquentRepository $supportRepository
     * @param UserSubscriptionRepositoryInterface $userSubscriptionRepository
     * @param PayApiInterface $payApi
     * @param PayDetailRepositoryInterface $payDetailRepository
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        SupportEloquentRepository $supportRepository,
        UserSubscriptionRepositoryInterface $userSubscriptionRepository,
        PayApiInterface $payApi,
        PayDetailRepositoryInterface $payDetailRepository,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->userRepository = $userRepository;
        $this->supportRepository = $supportRepository;
        $this->userSubscriptionRepository = $userSubscriptionRepository;
        $this->payApi = $payApi;
        $this->payDetailRepository = $payDetailRepository;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Show view setting user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting()
    {
        $userProxy = Auth::user()->userProxy(CHANGE_SUB_USER, CHANGE_PLAN);
        return view('backend.users.setting')->with([
            'userProxy' => $userProxy,
            'amount' => $userProxy->amount_fee,
            'userSubscription' => $this->userSubscriptionRepository->getDataForUser($userProxy->id),
            'customer' => $this->payApi->getDataCustomer($userProxy->id_cus),
            'listSubUser' => $this->userRepository->getDataSubUsersById($userProxy->id)->toArray()
        ]);
    }

    /**
     * create card payment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createCardPay()
    {
        return view('backend.users.pay.create_card')->with([
            'publicKey' => config('pay_jp.public_key')
        ]);
    }

    /**
     * Store card pay
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCardPay(Request $request)
    {
        if ($this->payApi->createCard(Auth::user()->userProxy(CHANGE_PLAN), $request->all()['pay_token'])) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.pay_api.create.success'));
            return response()->json(['save' => true]);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('messages.pay_api.create.fail'));
            return response()->json(['save' => false]);
        }
    }

    /**
     * delete card pay
     *
     * @param Request $request
     */
    public function deleteCardPay(Request $request)
    {
        if ($this->payApi->deleteCard(Auth::user()->userProxy(CHANGE_PLAN)->id_cus, $request->get('id_car'))) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.pay_api.delete.success'));
        } else {
            Session::flash(STR_ERROR_FLASH, trans('messages.pay_api.delete.fail'));
        }
    }

    /**
     * Change default card
     *
     * @param Request $request
     */
    public function changeDefaultCard(Request $request)
    {
        if ($this->payApi->changeDefaultCard(Auth::user()->userProxy(CHANGE_PLAN)->id_cus, $request->get('id_car'))) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.pay_api.change_default.success'));
        } else {
            Session::flash(STR_ERROR_FLASH, trans('messages.pay_api.change_default.fail'));
        }
    }

    /**
     * Check out payment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        $userProxy = Auth::user()->userProxy(CHANGE_PLAN);
        $memberStatus = request()->route()->getName() == USER_SETTING_PAY_BASIC_CHECKOUT ? BASIC : PREMIUM;
        return view('backend.users.pay.checkout')->with([
            'amount' => $this->userRepository->calculateAmountBySubUserAndAccount($userProxy->id, $memberStatus),
            'userProxy' => $userProxy,
            'userSubscription' => $this->userSubscriptionRepository->getDataForUser($userProxy->id),
            'customer' => $this->payApi->getDataCustomer($userProxy->id_cus)
        ]);
    }

    /**
     * Check card
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkCard()
    {
        $user = Auth::user()->userProxy(CHANGE_PLAN);
        if ($this->payApi->getDataCustomer($user->id_cus)) {
            return response()->json(['check' => true]);
        }
        return response()->json(['check' => false]);
    }

    /**
     * Change Basic member
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function changeBasic(Request $request)
    {
        $user = Auth::user()->userProxy(CHANGE_PLAN);
        if (!request()->ajax()) {
            $this->payApi->changeDefaultCard($user->id_cus, $request->get('use_card'));
        }
        if ($user->canTrial()) {
            if ($this->payApi->createTrial($user, BASIC)) {
                $this->userRepository->sendMailChangeMemberStatus($user, BASIC);
                Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.update_member_status_success'));
                return request()->ajax() ? response()->json(['save' => true]) : redirect()->route(USER_SETTING_INDEX);
            };
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return request()->ajax() ? response()->json(['save' => false]) : redirect()->back();
        }
        if ($this->payApi->upgrade($user, BASIC)) {
            $this->userRepository->handleSendEmailAfterPay($user, BASIC);
            Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.update_member_status_success'));
            return request()->ajax() ? response()->json(['save' => true]) : redirect()->route(USER_SETTING_INDEX);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        event(new Pay(false, $this->userRepository->getDataUserChangeStatusFail($user->id, BASIC), $this->userRepository->calculateAmountBySubUserAndAccount($user->id, BASIC)));
        return request()->ajax() ? response()->json(['save' => false]) : redirect()->back();
    }

    /**
     * Change Premium member
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function changePremium(Request $request)
    {
        $user = Auth::user()->userProxy(CHANGE_PLAN);
        if (!request()->ajax()) {
            $this->payApi->changeDefaultCard($user->id_cus, $request->get('use_card'));
        }
        if ($user->canTrial()) {
            if ($this->payApi->createTrial($user, PREMIUM)) {
                $this->userRepository->sendMailChangeMemberStatus($user, PREMIUM);
                Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.update_member_status_success'));
                return request()->ajax() ? response()->json(['save' => true]) : redirect()->route(USER_SETTING_INDEX);
            };
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return request()->ajax() ? response()->json(['save' => false]) : redirect()->back();
        }
        if ($this->payApi->upgrade($user, PREMIUM)) {
            $this->userRepository->handleSendEmailAfterPay($user, PREMIUM);
            Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.update_member_status_success'));
            return request()->ajax() ? response()->json(['save' => true]) : redirect()->route(USER_SETTING_INDEX);
        }
        event(new Pay(false, $this->userRepository->getDataUserChangeStatusFail($user->id, PREMIUM), $this->userRepository->calculateAmountBySubUserAndAccount($user->id, PREMIUM)));
        Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        return request()->ajax() ? response()->json(['save' => false]) : redirect()->back();
    }

    /**
     * Show view delete user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete()
    {
        abort_if(Auth::user()->member_status != FREE, 403);
        return view('backend.users.delete_account');
    }

    /**
     * Delete user with id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Exception
     */
    public function destroy()
    {
        abort_if(Auth::user()->member_status != FREE, 403);
        $userId = Auth::user()->id;
        if ($this->userRepository->deleteById($userId)) {
            dispatch(new DestroyUser($this->userRepository->getDataUser($userId)));
            return redirect(route(USER_HOME));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * Downgrade
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function downgrade(Request $request)
    {
        $user = Auth::user()->userProxy(CHANGE_PLAN);
        $type = $request->type;
        if ($this->payApi->downgrade($user, $type)) {
            $this->userRepository->sendMailChangeMemberStatus($user, $type);
            Session::flash(STR_SUCCESS_FLASH, MEMBER_STATUS[$type] . trans('messages.pay_api.downgrade.success'));
            return response()->json(['save' => true]);
        }
        Session::flash(STR_ERROR_FLASH, MEMBER_STATUS[$type] . trans('messages.pay_api.downgrade.fail'));
        return response()->json(['save' => true]);
    }

    /**
     * Show support view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportCreate()
    {
        return view('backend.support.support_me')->with([
            'user' => $this->userRepository->getDataUserByIdToSupport(Auth::user()->id),
        ]);
    }

    /**
     * Support store
     *
     * @param SupportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function supportStore(SupportRequest $request)
    {
        $data = $request->all();
        $data['mail_admin'] = config('mail.mail_admin');

        if ($this->supportRepository->create($data)) {
            dispatch(new CreateSupport($data));
            Session::flash(STR_SUCCESS_FLASH, trans('attributes.support.send_mail_success'));
            return redirect()->back();
        }

        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return redirect()->back();
    }

    /**
     * Payment info
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentInfo()
    {
        $userProxy = Auth::user()->userProxy(CHANGE_PLAN);
        abort_if(!$userProxy->userSubscription, 404);
        $amount = $this->userRepository->calculateAmountBySubUserAndAccount($userProxy->id);
        $history = $this->payDetailRepository->getHistoryPay($userProxy->id);
        return view('backend.users.pay.info_billing', compact('userProxy', 'amount', 'history'));
    }

    /**
     * Detail payment info
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentInfoDetail($id)
    {
        $data = $this->payDetailRepository->find($id);
        abort_if(!$data, 404);
        return view('backend.users.pay.payment_receipt')->with(['data' => $data->toArray()]);
    }
}

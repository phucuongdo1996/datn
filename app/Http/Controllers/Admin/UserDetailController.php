<?php

namespace App\Http\Controllers\Admin;

use App\Api\Pay\PayApiInterface;
use App\Events\MoveProperty;
use App\Events\MoveSubUser;
use App\Events\SendMailDeleteUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinishDateRequest;
use App\Http\Requests\MovePropertyRequest;
use App\Http\Requests\MoveSubUserRequest;
use App\Http\Requests\ProfileRequest;
use App\Mail\UnBlockUser;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\Specialty\SpecialtyRepositoryInterface;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserDetailController extends Controller
{
    /**
     * @var \App\Repositories\User\UserEloquentRepository
     */
    protected $userRepository;

    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository
     */
    protected $propertyRepository;

    /**
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository;
     */
    private $articlePhotoRepository;

    /**
     * @var \App\Repositories\Topic\TopicEloquentRepository
     */
    private $topicRepository;

    /**
     * @var \App\Repositories\Profile\ProfileEloquentRepository
     */
    private $profileRepository;

    /**
     * @var UserSubscriptionRepositoryInterface
     */
    private $userSubscriptionRepository;

    /**
     * @var PayApiInterface
     */
    private $payApi;

    /**
     * UserDetailController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     * @param TopicRepositoryInterface $topicRepository
     * @param PropertyRepositoryInterface $propertyRepository
     * @param ProfileRepositoryInterface $profileRepository
     * @param PayApiInterface $payApi
     * @param UserSubscriptionRepositoryInterface $userSubscriptionRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ArticlePhotoRepositoryInterface $articlePhotoRepository,
        TopicRepositoryInterface $topicRepository,
        PropertyRepositoryInterface $propertyRepository,
        ProfileRepositoryInterface $profileRepository,
        PayApiInterface $payApi,
        UserSubscriptionRepositoryInterface $userSubscriptionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->articlePhotoRepository = $articlePhotoRepository;
        $this->topicRepository = $topicRepository;
        $this->propertyRepository = $propertyRepository;
        $this->profileRepository = $profileRepository;
        $this->payApi = $payApi;
        $this->userSubscriptionRepository = $userSubscriptionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $userId
     *
     * @return mixed
     */
    public function index($userId)
    {
        abort_if(!$this->userRepository->isRoleUser($userId), 404);
        $user = $this->userRepository->getDataUserById($userId);
        return view('backend.admin.user_detail.index')->with([
            'user' => $user,
            'subUsers' => $this->userRepository->getDataSubUsersById($userId)->toArray(),
            'specialties' => $this->getDataSpecialties($user['role']),
            'listProperty' => $this->propertyRepository->getAllByUserIdAndRole($userId)->toArray(),
            'totalSubUserNotPaid' =>  $this->userRepository->countSubUserNotPaid($userId),
            'dataSubscription' => $this->userSubscriptionRepository->getDataByUserId($userId)
        ]);
    }

    /**
     * Redirect create profile view
     *
     * @param $role
     * @return array|void
     */
    public function getDataSpecialties($role)
    {
        switch ($role) {
            case INVESTOR:
                return [];
            case BROKER:
                return resolve(SpecialtyRepositoryInterface::class)->getAllFromType(SPECIALTIES_BROKER);
            case EXPERT:
                return resolve(SpecialtyRepositoryInterface::class)->getAllFromType(SPECIALTIES_EXPERT);
            default:
                return abort(404);
        }
    }

    /**
     * Display a listing property of the resource.
     *
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getProperty($userId)
    {
        if (!request()->ajax()) {
            abort(403);
        }
        return response()->json([
            'html' => view(
                'backend.admin.user_detail.property_results',
                [
                    'property' => $this->propertyRepository->getByUserIdAndRole($userId),
                    'totalPage' => ceil($this->propertyRepository->countByUserIdAndRole($userId) / LIMIT_RECORD_PROPERTY_USER_DETAIL)
                ]
            )->render()
        ]);
    }

    /**
     * get article photo
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getArticlePhoto(Request $request, $userId)
    {
        abort_if(!$request->ajax(), 403);
        return response()->json(['html' => view(
            'backend.admin.user_detail.article_photo_results',
            [
                'photos' => $this->articlePhotoRepository->getListByCondition($userId, null, LIMIT_RECORD_PHOTO_USER_DETAIL)
            ]
        )->render()
        ]);
    }

    /**
     * get topics
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getTopics(Request $request, $userId)
    {
        abort_if(!$request->ajax(), 403);
        return response()->json(['html' => view(
            'backend.admin.user_detail.topic_results',
            [
                'topics' => $this->topicRepository->getListByCondition($userId)
            ]
        )->render()
        ]);
    }

    /**
     * Function block user
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function blockUser(Request $request, $userId)
    {
        $dataUser = $this->userRepository->find($userId);
        abort_if(!$dataUser || $dataUser->isAdmin(), 404);
        if ($this->userRepository->blockUserById($request->all(), $userId)) {
            event(new SendMailDeleteUser($this->userRepository->getDataUser($userId)));
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.email.block_user_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * Function unblock user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblockUser($id)
    {
        if ($this->userRepository->unblockUser($id)) {
            dispatch(new UnBlockUser($this->userRepository->getDataUser($id)));
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.unblock.success'));
        } else {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('messages.unblock.fail'));
        }
    }

    /**
     * Move property
     *
     * @param MovePropertyRequest $request
     * @param MoveProperty $moveProperty
     * @return \Illuminate\Http\JsonResponse
     */
    public function moveProperty(MovePropertyRequest $request, MoveProperty $moveProperty)
    {
        $params = $request->all();
        if ($this->userRepository->findOrFail($params['parent_user'])->isTrial()) {
            Session::flash(STR_ERROR_FLASH, trans('messages.admin.move_property_fail'));
            return response()->json(['save' => false]);
        }

        $user = $this->userRepository->findByEmail($params['email_to']);
        $propertyMoved = $this->propertyRepository->moveProperty($user, $params['property']);

        if ($propertyMoved === false) {
            Session::flash(STR_ERROR_FLASH, trans('messages.admin.move_property_fail'));
            return response()->json(['save' => false]);
        }

        $moveProperty->setUserReceived($user)->setPropertyMoved($propertyMoved)->setDataMailFromUser()->setDataMailToUser();
        event($moveProperty);
        Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.move_property_success'));
        return response()->json(['save' => true]);
    }

    /**
     * Move sub user
     *
     * @param MoveSubUserRequest $request
     * @param MoveSubUser $moveSubUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function moveSubUser(MoveSubUserRequest $request, MoveSubUser $moveSubUser)
    {
        $params = $request->all();
        if ($this->userRepository->findOrFail($params['parent_user'])->isTrial()) {
            Session::flash(STR_ERROR_FLASH, trans('messages.admin.move_sub_user_fail'));
            return response()->json(['save' => false]);
        }

        $user = $this->userRepository->findByEmail($params['sub_user_email_to']);
        $subUserMoved = $this->userRepository->moveSubUser($user, $params['sub_user']);

        if ($subUserMoved === false) {
            Session::flash(STR_ERROR_FLASH, trans('messages.admin.move_sub_user_fail'));
            return response()->json(['save' => false]);
        }

        $moveSubUser->setUserReceived($user)->setSubUserMoved($subUserMoved)->setDataMailFromUser()->setDataMailToUser();
        event($moveSubUser);
        Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.move_sub_user_success'));
        return response()->json(['save' => true]);
    }

    /**
     * Update profile User
     *
     * @param $userId
     * @param ProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile($userId, ProfileRequest $request)
    {
        $profile = $this->profileRepository->findByAttribute('user_id', $userId, true);
        if (date_format($profile['updated_at'], 'Y/m/d H:i:s') > $request['time_open_page']) {
            Session::flash(STR_ERROR_FLASH, trans('messages.admin.update_profile_fail'));
            return response()->json(['save' => false]);
        }
        $dataReturn = $this->profileRepository->updateProfile($profile, $request->all());
        if ($dataReturn['save'] == false) {
            Session::flash(STR_ERROR_FLASH, trans('messages.admin.update_profile_fail'));
            return response()->json(['save' => false]);
        }
        Session::flash(STR_SUCCESS_FLASH, trans('messages.admin.update_profile_success'));
        return response()->json(['save' => true]);
    }

    /**
     * Update member status by admin
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function updateMemberStatus(Request $request, $userId)
    {
        $timeUpdate = $this->userRepository->getDataTimeUpdated($userId);
        if (!$timeUpdate) {
            return abort(404);
        }
        if (strtotime($timeUpdate['updated_at']) > strtotime($request->get('time_open_page'))) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
        if ($this->userRepository->updateMemberStatus($userId, $request->get('member_status'))) {
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.admin.update_member_status_success'));
        }
        if (!$this->userRepository->find($userId)->id_cus) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.error_messages_no_card'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * Update future date
     *
     * @param FinishDateRequest $request
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function updateFutureDate(FinishDateRequest $request, $userId)
    {
        $dataSubscription = $this->userSubscriptionRepository->getDataByUserId($userId);
        if (!$dataSubscription) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
        $data = $request->all();
        if (strtotime($dataSubscription['updated_at']) > strtotime($data['time_open_page'])) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
        if ($this->payApi->updateTimePlan($dataSubscription, $data, $userId)) {
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.admin.update_future_date_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }
}

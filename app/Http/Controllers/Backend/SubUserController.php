<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileSubUserRequest;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\SubUserProperty\SubUserPropertyEloquentRepository;
use App\Repositories\SubUserPermission\SubUserPermissionRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubUserController extends Controller
{
    /**
     * @var ProfileRepositoryInterface
     */
    private $profileRepository;

    /**
     * @var VerifiedRegisterRepositoryInterface
     */
    private $verifiedRegisterRepository;

    /**
     * @var PropertyRepositoryInterface
     */
    private $propertyRepository;

    /**
     * @var UserRepositoryInterface | \App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var SubUserPropertyEloquentRepository
     */
    private $subUserPropertyRepository;

    /**
     * @var SubUserPermissionRepositoryInterface | \App\Repositories\SubUserPermission\SubUserPermissionEloquentRepository
     */
    private $subUserPermissionRepository;

    /**
     * SubUserController constructor.
     *
     * @param ProfileRepositoryInterface $profileRepository
     * @param PropertyRepositoryInterface $propertyRepository
     * @param UserRepositoryInterface $userRepository
     * @param SubUserPropertyEloquentRepository $subUserPropertyEloquentRepository
     * @param VerifiedRegisterRepositoryInterface $verifiedRegisterRepository
     * @param SubUserPermissionRepositoryInterface $subUserPermissionRepository

     */
    public function __construct(
        ProfileRepositoryInterface $profileRepository,
        PropertyRepositoryInterface $propertyRepository,
        UserRepositoryInterface $userRepository,
        SubUserPropertyEloquentRepository $subUserPropertyEloquentRepository,
        VerifiedRegisterRepositoryInterface $verifiedRegisterRepository,
        SubUserPermissionRepositoryInterface $subUserPermissionRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->propertyRepository = $propertyRepository;
        $this->userRepository = $userRepository;
        $this->subUserPropertyRepository = $subUserPropertyEloquentRepository;
        $this->verifiedRegisterRepository = $verifiedRegisterRepository;
        $this->subUserPermissionRepository = $subUserPermissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index()
    {
        $parentUser = Auth::user()->userProxy(CHANGE_SUB_USER);
        if ($parentUser->isAdmin() || $parentUser->isSubUser()) {
            return abort(404);
        }
        return view('backend.sub_user.index')->with([
            'infoSubUser' => $this->userRepository->getDataSubUsersById($parentUser->id),
            'typeShowListSubUser' => $this->getTypeShowListSubUser()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create()
    {
        $parentUser = Auth::user()->userProxy(CHANGE_SUB_USER);
        if ($parentUser->isAdmin() || $parentUser->isSubUser() || $parentUser->member_status == FREE) {
            return abort(404);
        }
        return view('backend.sub_user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfileSubUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProfileSubUserRequest $request)
    {
        $data = $request->all();
        if ($this->userRepository->createSubUser($data, Auth::user()->userProxy(CHANGE_SUB_USER))) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.change_sub_user_role.success'));
            return response()->json(['save' => true]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['save' => false]);
    }

    /**
     * Show set password sub user
     *
     * @param $verifiedToken
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSetPasswordScreen($verifiedToken)
    {
        $subUser = $this->verifiedRegisterRepository->getSubUser($verifiedToken);
        abort_if(!$subUser, 404);
        return view('backend.sub_user.create_password', compact('subUser'));
    }

    /**
     * Set sub user password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createPassword(Request $request)
    {
        $params = $request->all();
        if ($this->verifiedRegisterRepository->createSubUserPassword($params)) {
            Auth::logout();
            return redirect()->route(SHOW_LOGIN);
        };
        abort(404);
    }

    /**
     * Show edit profile sub-user screen
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit($id)
    {
        $subUser = $this->userRepository->findOrFail($id);
        $currentUserId = Auth::user()->id;
        if ($currentUserId != $id && $currentUserId != $subUser->parent_id) {
            return abort(404);
        }
        return view('backend.sub_user.edit_profile')->with([
            'profile' => $this->profileRepository->findByAttribute('user_id', $id)
        ]);
    }

    /**
     * Update profile user
     *
     * @param ProfileSubUserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileSubUserRequest $request, $id)
    {
        $profile = $this->profileRepository->findByAttribute('user_id', $id);
        if (strtotime($profile['updated_at']) > strtotime($request['time_open_page'])) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['save' => false]);
        }
        $isSubUser = Auth::user()->isSubUser();
        if ($this->profileRepository->updateProfileSubUser($profile, $isSubUser, $request->all())) {
            return response()->json(['save' => true, 'isSubUser' => $isSubUser]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['save' => false]);
    }

    /**
     * Delete sub user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        if ($this->userRepository->deleteOneSubUserOfMainUser($id, Auth::user()->userProxy(CHANGE_SUB_USER)->id)) {
            return redirect(route(SUB_USER_INDEX))->with(STR_SUCCESS_FLASH, trans('messages.email.edit_property.deleted'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * Change permission SubUser
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePermissionSubUser(Request $request)
    {
        $data = $request->all();
        if (!isset($data['change']) || $this->subUserPermissionRepository->changePermissionSubUser($data['role'], $data['change'])) {
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.change_sub_user_role.success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * create subUser property
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createSubUserProperty(Request $request)
    {
        $userId = Auth::user()->id;
        return view('backend.sub_user.power_property')->with([
            'listData' => $this->subUserPropertyRepository->getAllData(),
            'listProperty' => $this->propertyRepository->getListPropertyNameByUserId($userId),
            'totalProperty' => $this->propertyRepository->getTotalPropertyByUserId($userId),
            'listUser' => $this->userRepository->getListSubUserByParentId($userId),
            'totalUser' => $this->userRepository->countSubUserNotPaid($userId),
        ]);
    }

    /**
     * store subUser property
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSubUserProperty(Request $request)
    {
        if ($this->subUserPropertyRepository->saveData($request->all())) {
            Session::flash(STR_SUCCESS_FLASH, trans('messages.sub_user_property.success'));
        } else {
            Session::flash(STR_ERROR_FLASH, trans('messages.sub_user_property.fail'));
        }
        return redirect()->back();
    }

    /**
     * Get type show list SubUser
     *
     * @return int
     */
    public function getTypeShowListSubUser()
    {
        $user = Auth::user();
        if ($user->isSubUser()) {
            return SHOW_BY_SUB_USER;
        }
        if ($user->member_status == FREE) {
            return SHOW_BY_FREE_MAIN_USER;
        }
        return SHOW_BY_FEE_MAIN_USER;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Events\DeleteSubUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileSubUserRequest;
use App\Mail\SendMailAddSubUser;
use App\Mail\SendMailEditSubUser;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubUserController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var \App\Repositories\Profile\ProfileEloquentRepository
     */
    private $profileRepository;

    /**
     * @var VerifiedRegisterRepositoryInterface
     */
    private $verifiedRegisterRepository;

    /**
     * subUserController constructor.
     * @param  UserRepositoryInterface  $userRepository
     * @param  ProfileRepositoryInterface $profileRepository
     * @param  VerifiedRegisterRepositoryInterface $verifiedRegisterRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ProfileRepositoryInterface $profileRepository,
        VerifiedRegisterRepositoryInterface $verifiedRegisterRepository
    ) {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->verifiedRegisterRepository = $verifiedRegisterRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $userId
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        $user = $this->userRepository->findOrFail($userId);
        if ($user->isAdmin() || $user->isSubUser() || $user->member_status == FREE) {
            return abort(404);
        }
        return view('backend.admin.sub_user.add', ['userId' => $userId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileSubUserRequest  $request
     * @param int $userId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProfileSubUserRequest $request, $userId)
    {
        $params = $request->all();
        $parentUser = $this->userRepository->getDataUserWithProfile($userId);
        if ($this->userRepository->createSubUser($params, $parentUser)) {
            unset($params['avatar']);
            dispatch(new SendMailAddSubUser($params, $parentUser->toArray()));
            return response()->json(['save' => true]);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['save' => false]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $parentId
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($parentId, $id)
    {
        $parentUser = $this->userRepository->findOrFail($parentId);
        if ($parentUser->isAdmin() || $parentUser->isSubUser() || $parentUser->member_status == FREE) {
            return abort(404);
        }
        $subUser = $this->userRepository->findOrFail($id);
        if ($parentId != $id && $parentId != $subUser->parent_id) {
            return abort(404);
        }
        return view('backend.admin.sub_user.edit', [
            'profile' => $this->profileRepository->findByAttribute('user_id', $id),
            'parentId' => $parentId
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileSubUserRequest  $request
     * @param int $parentId
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileSubUserRequest $request, $parentId, $id)
    {
        $params = $request->all();
        $profileSub = $this->profileRepository->findByAttribute('user_id', $id);
        if (strtotime($profileSub['updated_at']) > strtotime($request['time_open_page'])) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['save' => false]);
        }
        if ($this->profileRepository->updateProfileSubUser($profileSub, false, $params)) {
            unset($params['avatar']);
            dispatch(new SendMailEditSubUser($params, $this->profileRepository->findByAttribute('user_id', $parentId)->toArray()));
            return response()->json(['save' => true]);
        }
        Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        return response()->json(['save' => false]);
    }

    /**
     * @param Request $request
     * @param $subUserId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $subUserId)
    {
        $user = $this->userRepository->findOrFail($subUserId);
        abort_if($user->isAdmin() || !$user->isSubUser(),404);
        $this->userRepository->findOrFail($user->parent_id);

        if ($this->userRepository->deleteUserById($request->all(), $subUserId)) {
            event(new DeleteSubUser($this->userRepository->getDataUser($user->parent_id), $this->userRepository->getDataUser($subUserId)));
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.email.block_user_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }
}

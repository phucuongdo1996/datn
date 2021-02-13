<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminInviteUserRequest;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;

class InviteUserController extends Controller
{
    /**
     * @var VerifiedRegisterRepositoryInterface || App/Repositories/VerifiedRegister/VerifiedRegisterEloquentRepository
     */
    private $verifiedRegisterRepository;

    /**
     * InviteUserController constructor.
     *
     * @param  VerifiedRegisterRepositoryInterface  $verifiedRegisterRepository
     */
    public function __construct(
        VerifiedRegisterRepositoryInterface $verifiedRegisterRepository
    ) {
        $this->verifiedRegisterRepository = $verifiedRegisterRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/invite_user', [
            'verifiedToken' => $this->verifiedRegisterRepository->createVerifiedToken(),
            'password' => rand(10000000, 99999999)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminInviteUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminInviteUserRequest $request)
    {
        if ($this->verifiedRegisterRepository->addRecordVerifiedTableByAdmin($request->all())) {
            return redirect()->back()->with(STR_SUCCESS_FLASH, trans('attributes.invite_user.send_mail_success'));
        } else {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\ResetPassword\ResetPasswordRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /**
     * @var ResetPasswordRepositoryInterface
     */
    protected $resetPassword;

    /**
     * @var UserRepositoryInterface
     */
    protected $user;

    /**
     * ResetPasswordController constructor.
     *
     * @param ResetPasswordRepositoryInterface $resetPassword
     * @param UserRepositoryInterface $user
     */
    public function __construct(ResetPasswordRepositoryInterface $resetPassword, UserRepositoryInterface $user)
    {
        $this->resetPassword = $resetPassword;
        $this->user = $user;
    }

    /**
     * Return Screen Reset Password (Input email)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect(route(USER_HOME));
        }
        return view('forgot_password.index');
    }

    /**
     * Return Screen Reset Password (Input password)
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showstep3(Request $request)
    {
        return view('forgot_password.change-password');
    }

    /**
     * Send Mail Reset Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMailResetPassword(Request $request)
    {
        $request->validate($this->resetPassword->rules('email', $request->all()['email_forgot']),
            $this->resetPassword->validationErrorMessages());
        if ($this->resetPassword->addRecordIntoPasswordResetTable($request->all())) {
            return response()->json(['status' => true, 'data' => $request->all()]);
        }
        return response()->json(['status' => false]);
    }

    /**
     * Show Screen Confirm Password (Step 3)
     *
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|void
     */
    public function showScreenConfirmPassword($token)
    {
        $record = $this->resetPassword->findByAttribute('token', $token);
        if (!$record) {
            return abort('404');
        }
        if ($record->used == FLAG_ONE || !$this->resetPassword->checkExpiryTimeActive($record->updated_at)) {
            return redirect(route(TOP));
        }
        return view('forgot_password.change-password', compact('token'));
    }

    /**
     * Update Change Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateChangePassword(Request $request)
    {
        $request->validate(
            $this->resetPassword->rules('password', null),
            $this->resetPassword->validationErrorMessages()
        );
        return response()->json(['save' => $this->user->updatePassword($request->all())]);
    }
}

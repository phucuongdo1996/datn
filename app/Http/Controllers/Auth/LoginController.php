<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DateTime;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * LoginController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
//        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $remember = $request->has('remember') ? true : false;

        if (
            method_exists($this, 'hasTooManyLoginAttempts')
            && $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->guard()->validate($this->credentials($request))) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $remember)) {
                Session::flash(
                    STR_FLASH_SUCCESS,
                    trans('messages.login.success')
                );
                $this->userRepository->update(Auth::user()->id, ['last_login' => new DateTime()]);
                return response()->json(['login' => true]);
            } else {
                $this->incrementLoginAttempts($request);
                if ($this->userRepository->checkSubUserBlocked($request->email)) {
                    Session::flash(
                        STR_FLASH_ERROR,
                        trans('messages.login.main_user_free')
                    );
                } else {
                    Session::flash(
                        STR_FLASH_ERROR,
                        trans('messages.login.account_block')
                    );
                }
            }
        } else {
            $this->incrementLoginAttempts($request);
            Session::flash(
                STR_FLASH_ERROR,
                trans('messages.login.failed')
            );
            return response()->json(['userLogin' => false]);
        }

        $this->incrementLoginAttempts($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * Show Login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('login');
    }
}

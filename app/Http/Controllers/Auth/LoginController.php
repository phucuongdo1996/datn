<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserEloquentRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
     * @var \App\Repositories\UserEloquentRepository
     */
    private $userRepository;

    /**
     * LoginController constructor.
     * @param UserEloquentRepository $userRepository
     */
    public function __construct(UserEloquentRepository $userRepository)
    {
//        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $remember = $request->has('remember') ? true : false;

        if (
            method_exists($this, 'hasTooManyLoginAttempts')
            && $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            Session::flash(
                STR_FLASH_SUCCESS,
                trans('message.login.success')
            );
            return response()->json(['login' => true]);
        } else {
            Session::flash(
                STR_FLASH_ERROR,
                trans('message.login.fail')
            );
            return response()->json(['login' => false]);
        }
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

        return $this->loggedOut($request) ?: redirect()->route(SHOW_LOGIN);
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

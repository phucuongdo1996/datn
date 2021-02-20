<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var VerifiedRegisterRepositoryInterface || App/Repositories/VerifiedRegister/VerifiedRegisterEloquentRepository
     */
    private $verifiedRegisterRepository;

    /**
     * RegisterController constructor.
     *
     * @param VerifiedRegisterRepositoryInterface $verifiedRegisterRepository
     */
    public function __construct(VerifiedRegisterRepositoryInterface $verifiedRegisterRepository)
    {
        $this->middleware('guest', ['except' => ['verifiedRegister', 'completeRegistration']]);
        $this->verifiedRegisterRepository = $verifiedRegisterRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * To redirect to view register
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showScreenRegister()
    {
        $this->removeSession();
        return view('register.main');
    }

    /**
     * Remove Session of Register
     */
    public function removeSession()
    {
        if (session()->exists('data_register')) {
            session()->remove('data_register');
        }
        if (session()->exists('step_index')) {
            session()->remove('step_index');
        }
        if (session()->exists('step4_status')) {
            session()->remove('step4_status');
        }
    }

    /**
     * Set data into Session Step1
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setDataStep1(Request $request)
    {
        session(['data_register' => ['role' => $request->role]]);
        session(['step_index' => FLAG_ONE]);
        return redirect(route(REGISTER_SHOW_REGISTRATION_FORM));
    }

    /**
     * Show the application registration form [Step 1].
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|void
     */
    public function showRegistrationForm()
    {
        return $this->checkStepAndRedirect(FLAG_ONE);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        session([
            'data_register' =>
                [
                    'role' => $request->role,
                    'email' => $request->email,
                    'password' => $request->password,
                ]
        ]);
        session(['step_index' => FLAG_TWO]);
        return response()->json(['data' => $request->all()]);
    }

    /**
     * Show confirm register screen [Step 2]
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|void
     */
    public function showConfirmRegister()
    {
        return $this->checkStepAndRedirect(FLAG_TWO);
    }

    /**
     * Add verified register and send Mail
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addVerifiedRegisterAndSendMail(Request $request)
    {
        $this->verifiedRegisterRepository
            ->addRecordIntoVerifiedRegisterTable(session('data_register'));
        session(['step_index' => FLAG_THREE]);
        return redirect(route(REGISTER_STEP3_SHOW_EMAIL));
    }

    /**
     * Show Address Email [Step 3]
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|void
     */
    public function getAddressEmail()
    {
        return $this->checkStepAndRedirect(FLAG_THREE);
    }

    /**
     * Verified register
     *
     * @param $verifiedToken
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifiedRegister($verifiedToken)
    {
        $this->verifiedRegisterRepository->verifiedUser($verifiedToken);
        $checkProfile = session('step4_status');
        if ($checkProfile == REDIRECT_TO_HOME) {
            return redirect(route(TOP));
        } elseif ($checkProfile == REDIRECT_TO_LOGIN) {
            return redirect(route(SHOW_LOGIN));
        }
        session(['step_index' => FLAG_FOUR]);
        return redirect(route(REGISTER_STEP4_COMPLETE_REGISTRATION));
    }

    /**
     * Complete registration [Step 4]
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|void
     */
    public function completeRegistration()
    {
        if (!session()->exists('step4_status')) {
            return $this->checkStepAndRedirect(FLAG_FOUR);
        }
        $statusStep4 = session('step4_status');
        if ($statusStep4 == ACTIVE_ERROR_EXPIRY_TIME) {
            $this->removeSession();
            return redirect()->route(TOP);
        }
        if ($statusStep4 == ACTIVE_FAIL) {
            session(['step_index' => FLAG_THREE]);
            return redirect(route(REGISTER_STEP3_SHOW_EMAIL));
        }
        return $this->checkStepAndRedirect(FLAG_FOUR);
    }

    /**
     * Check step index and redirect view
     *
     * @param $stepIndex
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|void
     */
    public function checkStepAndRedirect($stepIndex)
    {
        if (!session()->exists('step_index')) {
            return abort('404');
        }
        $stepSession = session('step_index');
        if ($stepSession == $stepIndex) {
            return view('register/' . STEP_NAME[$stepIndex]);
        }
        if ($stepIndex == FLAG_ONE && $stepSession == FLAG_TWO) {
            session(['step_index' => FLAG_ONE]);
            return view('register/' . STEP_NAME[$stepIndex]);
        }
        return redirect('register/' . STEP_NAME[$stepSession]);
    }
}

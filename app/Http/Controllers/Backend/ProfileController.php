<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Repositories\AccuracyEmailChange\AccuracyEmailChangeRepositoryInterface;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Qualification\QualificationRepositoryInterface;
use App\Repositories\Specialty\SpecialtyRepositoryInterface;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * @var ProfileRepositoryInterface|\App\Repositories\Profile\ProfileEloquentRepository
     */
    private $profileRepository;

    /**
     * @var \App\Repositories\AccuracyEmailChange\AccuracyEmailChangeEloquentRepository
     */
    private $accuracyEmailChangeRepository;

    /**
     * @var VerifiedRegisterRepositoryInterface
     */
    private $verifiedRegisterRepository;

    /**
     * ProfileController constructor.
     *
     * @param ProfileRepositoryInterface $profileRepository
     * @param AccuracyEmailChangeRepositoryInterface $accuracyEmailChangeRepository
     */
    public function __construct(
        ProfileRepositoryInterface $profileRepository,
        AccuracyEmailChangeRepositoryInterface $accuracyEmailChangeRepository,
        VerifiedRegisterRepositoryInterface $verifiedRegisterRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->accuracyEmailChangeRepository = $accuracyEmailChangeRepository;
        $this->verifiedRegisterRepository = $verifiedRegisterRepository;
    }

    /**
     * Redirect create profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create()
    {
        $user = Auth::user();
        if (!isset($user) || ROLES[$user->role] != explode('/', request()->path(), FLAG_THREE)[FLAG_TWO]) {
            return abort(404);
        }
        return $this->redirectProfileView($user->role);
    }

    /**
     * Redirect create profile view
     *
     * @param array $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function redirectProfileView($role)
    {
        switch ($role) {
            case 0:
                return view('profiles.investor');
            case 1:
                return view('profiles.broker', ['specialties' => resolve(SpecialtyRepositoryInterface::class)->getAllFromType(SPECIALTIES_BROKER)]);
            case 2:
                return view('profiles.expert', ['specialties' => resolve(SpecialtyRepositoryInterface::class)->getAllFromType(SPECIALTIES_EXPERT)]);
            default:
                return abort(404);
        }
    }

    /**
     * Save Record
     *
     * @param ProfileRequest $request
     * @return array
     */
    public function store(ProfileRequest $request)
    {
        $dataReturn = $this->profileRepository->saveProfile($request);
        if ($dataReturn['save'] == false) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
        return response()->json($dataReturn);
    }

    /**
     * Show edit profile screen
     *
     * @param $role
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit($role, $id)
    {
        $user = Auth::user();
        if ($user->id != $id || ROLES[$user->role] != $role) {
            return abort(404);
        }
        return $this->redirectEditProfileView($user->role, $this->profileRepository->getSpecialties(
            $this->profileRepository->findByAttribute('user_id', $id)
        ));
    }

    /**
     * Redirect edit profile screen
     *
     * @param $role
     * @param $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function redirectEditProfileView($role, $profile)
    {
        switch ($role) {
            case 0:
                return view('profiles.edit_investor', compact('profile'));
            case 1:
                return view('profiles.edit_broker', ['specialties' => resolve(SpecialtyRepositoryInterface::class)->getAllFromType(SPECIALTIES_BROKER), 'profile' => $profile]);
            case 2:
                return view('profiles.edit_expert', ['specialties' => resolve(SpecialtyRepositoryInterface::class)->getAllFromType(SPECIALTIES_EXPERT), 'profile' => $profile]);
            default:
                return abort(404);
        }
    }

    /**
     * Update profile user
     *
     * @param $profileId
     * @param ProfileRequest $request
     * @return array
     */
    public function update($profileId, ProfileRequest $request)
    {
        $profile = $this->profileRepository->find($profileId);
        if (date_format($profile['updated_at'], 'Y/m/d H:i:s') > $request['time_open_page']) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
            return response()->json(['save' => false]);
        }
        $dataReturn = $this->profileRepository->updateProfile($profile, $request->all());
        if ($dataReturn['save'] == false) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
        if (isset($dataReturn['updateEmail']) && $dataReturn['updateEmail'] == true) {
            Auth::logout();
        }
        return response()->json($dataReturn);
    }

    /**
     * Update email
     *
     * @param $verifiedToken
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function updateEmail($verifiedToken)
    {
        $record = $this->accuracyEmailChangeRepository->findByAttribute('verified_token', $verifiedToken);
        if (!$record) {
            abort('404');
        }
        if ($record->status == EMAIL_VERIFIED) {
            return redirect()->route(TOP);
        }
        if ($this->accuracyEmailChangeRepository->updateEmailChange($record)) {
            Auth::logout();
            return view('profiles.edit-mail-done');
        }
        abort('404');
    }
}

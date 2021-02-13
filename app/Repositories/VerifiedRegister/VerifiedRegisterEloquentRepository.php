<?php

namespace App\Repositories\VerifiedRegister;

use App\Mail\SendMailInviteUser;
use App\Mail\SendMailToSubUser;
use App\Repositories\BaseRepository;
use App\Models\VerifiedRegister;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerifiedRegisterEloquentRepository extends BaseRepository implements VerifiedRegisterRepositoryInterface
{
    /**
     * @return string
     */
    public function model()
    {
        return VerifiedRegister::class;
    }

    /**
     * Add a record into VerifiedRegister table
     *
     * @param array $data
     * @return array|int
     */
    public function addRecordIntoVerifiedRegisterTable(array $data)
    {
        try {
            if ($user = resolve(UserRepositoryInterface::class)->findByEmail($data['email'])) {
                session(['step3_status' => EMAIL_USER_VERIFIED]);
            }
            $checkEmail = $this->findByAttribute('email', $data['email']);
            $checkEmail = $this->removeRecordExpiry($checkEmail);
            if ($checkEmail == null) {
                $verifiedToken = $this->createVerifiedToken();
                $this->sendMailVerified([
                    'email' => $data['email'],
                    'link_verified' => $this->createLinkVerifiedRegister($verifiedToken)
                ]);
                $this->create([
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => $data['role'],
                    'verified_token' => $verifiedToken,
                    'expiry_time' => date('Y-m-d H:i:s', strtotime('+1 day', time()))
                ]);
                session(['step3_status' => EMAIL_SEND_SUSSCESS]);
            } else {
                session(['step3_status' => EMAIL_SENDED]);
            }
        } catch (\Exception $exception) {
            report($exception);
            session(['step3_status' => EMAIL_SEND_FAIL]);
        }
    }

    /**
     * Add a record into VerifiedRegister table by admin
     *
     * @param array $params
     * @return bool
     */
    public function addRecordVerifiedTableByAdmin($params)
    {
        DB::beginTransaction();
        try {
            $checkEmail = $this->findByAttribute('email', $params['email']);
            if ($checkEmail) {
                $this->deleteById($checkEmail->id);
            }
            $params['link_verified'] = $this->createLinkVerifiedRegister($params['verified_token']);
            $params['expiry_time'] = date('Y-m-d H:i:s', strtotime('+1 day', time()));
            resolve(SendMailInviteUser::class)->sendMailVerified($params);
            $params['password'] = Hash::make($params['password']);
            $this->create($params);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Remove record expiry
     *
     * @param $record
     * @return |null
     * @throws \Exception
     */
    public function removeRecordExpiry($record)
    {
        if ($record && $record->expiry_time < date('Y-m-d H:i:s')) {
            $this->deleteById($record->id);
            return null;
        }
        return $record;
    }

    /**
     * Send mail verified
     *
     * @param array $infoSendMail
     */
    public function sendMailVerified(array $infoSendMail)
    {
        Mail::send('register/form-mail', ['link' => $infoSendMail['link_verified']], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')->subject(trans('mail-attributes.title'));
        });
    }

    /**
     * Check User exited
     *
     * @param array $email
     * @return bool
     */
    public function checkUserExited($email)
    {
        $user = resolve(UserRepositoryInterface::class)->findByEmail($email);
        if ($user) {
            return true;
        }
        return false;
    }

    /**
     * Verified User
     *
     * @param $verifiedToken
     * @return mixed
     */
    public function verifiedUser($verifiedToken)
    {
        $recordVerifiedRegister = $this->findByAttribute('verified_token', $verifiedToken);
        if (!$recordVerifiedRegister) {
            return session(['step4_status' => ACTIVE_FAIL]);
        } else {
            $recordVerifiedRegister = $recordVerifiedRegister->toArray();
        }
        $user = resolve(UserRepositoryInterface::class)->findByEmail($recordVerifiedRegister['email']);
        if ($user && !$this->checkExpiryTimeActive($recordVerifiedRegister['expiry_time'])) {
            return $this->checkProfileUser($user);
        }
        if ($user) {
            Auth::loginUsingId($user->id);
            return session(['step4_status' => ACTIVE_ERROR_USER_ACHIEVED]);
        }
        if ($this->checkExpiryTimeActive($recordVerifiedRegister['expiry_time'])) {
            return session(['step4_status' => $this->registerUser($recordVerifiedRegister)]);
        }
        session()->put('email_expiry', $recordVerifiedRegister['email']);
        return session(['step4_status' => ACTIVE_ERROR_EXPIRY_TIME]);
    }

    /**
     * Check profile user and redirect
     *
     * @param $user
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function checkProfileUser($user)
    {
        if ($user->profile) {
            Auth::loginUsingId($user->id);
            return session(['step4_status' => REDIRECT_TO_HOME]);
        }
        $user->forceDelete();
        return session(['step4_status' => REDIRECT_TO_LOGIN]);
    }

    /**
     * Check expiry time active
     *
     * @param array $expiryTime
     * @return bool
     */
    public function checkExpiryTimeActive($expiryTime)
    {
        if ($expiryTime > date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

    /**
     * Register User
     *
     * @param array $register
     * @return int
     */
    public function registerUser(array $register)
    {
        try {
            $userRepository = resolve(UserRepositoryInterface::class);
            $code = $userRepository->makeUserCode($register['role']);
            $addUser = $userRepository->create([
                'user_code' => $code,
                'email' => $register['email'],
                'password' => $register['password'],
                'role' => $register['role'],
                'status' => STATUS_ACTIVE,
                'group_code' => $code,
            ]);
            if ($addUser) {
                Auth::loginUsingId($addUser->id);
                return ACTIVE_SUCCESS;
            }
            return ACTIVE_FAIL;
        } catch (\Exception $exception) {
            report($exception);
            return ACTIVE_FAIL;
        }
    }

    /**
     * create Link VerifiedRegister
     *
     * @param $verifiedToken
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function createLinkVerifiedRegister($verifiedToken)
    {
        return url('register/authentication/' . $verifiedToken);
    }

    /**
     * Create VerifiedToken
     *
     * @return false|string
     */
    public function createVerifiedToken()
    {
        do {
            $verifiedToken = substr(md5(rand()), 0, 25);
        } while ($this->findByAttribute('verified_token', $verifiedToken) != null);
         return $verifiedToken;
    }

    /**
     * Find by a attribute
     *
     * @param string $attribute
     * @param string $value
     * @return |null
     */
    public function findByAttribute(string $attribute, string $value)
    {
        $record = $this->model->where($attribute, $value)->first();
        if ($record) {
            return $record;
        }
        return null;
    }

    /**
     * Delete record by email
     *
     * @param $email
     * @return void
     */
    public function deleteRecordByEmail($email)
    {
        $this->model->where('email', $email)->delete();
    }

    /**
     * Create record verify sub user
     *
     * @param array $data
     * @param $role
     * @return bool
     * @throws \Exception
     */
    public function createVerifySubUser(array $data, $parentUser)
    {
        $checkEmail = $this->removeRecordExpiry($this->findByAttribute('email', $data['email']));
        if ($checkEmail == null) {
            $verifiedToken = $this->createVerifiedToken();
            resolve(SendMailToSubUser::class)->sendMailVerifySubUser([
                'nameParentUser' => $parentUser->profile->person_charge_last_name . $parentUser->profile->person_charge_first_name,
                'lastName' => $data['person_charge_last_name'],
                'firstName' => $data['person_charge_first_name'],
                'link' => $this->createLinkVerifiedSubUser($verifiedToken),
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => ROLES_TEXT_JA[$parentUser->role],
            ]);
            $this->create([
                'email' => $data['email'],
                'password' => $data['hash_password'],
                'role' => $parentUser->role,
                'verified_token' => $verifiedToken,
                'expiry_time' => date('Y-m-d H:i:s', strtotime('+1 day', time()))
            ]);
        }
    }

    /**
     * Create link verified sub user
     *
     * @param $verifiedToken
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function createLinkVerifiedSubUser($verifiedToken)
    {
        return url('/sub-user/set-password/' . $verifiedToken);
    }

    /**
     * Verified Sub User
     *
     * @param $verifiedToken
     * @return mixed
     */
    public function getSubUser($verifiedToken)
    {
        $recordVerifiedRegister = $this->findByAttribute('verified_token', $verifiedToken);
        if ($recordVerifiedRegister) {
            $recordVerifiedRegister = $recordVerifiedRegister->toArray();
            $user = resolve(UserRepositoryInterface::class)->findByEmail($recordVerifiedRegister['email']);
            if ($user && $this->checkExpiryTimeActive($recordVerifiedRegister['expiry_time']) && $this->checkParentSubUser($user) && $user->verified_status == CLOSE) {
                return $user;
            }
        }
        return null;
    }

    /**
     * Create Sub User Password
     *
     * @param $params
     * @return bool
     */
    public function createSubUserPassword($params)
    {
        $user = resolve(UserRepositoryInterface::class)->findByEmail($params['email']);
        if ($user || $user->verified_status == CLOSE) {
            $user->update([
                'password' => Hash::make($params['password']),
                'verified_status' => OPEN
            ]);
            return true;
        }
        return false;
    }

    /**
     * Check parent SubUser
     *
     * @param $subUser
     * @return bool
     */
    public function checkParentSubUser($subUser)
    {
        $user = resolve(UserRepositoryInterface::class)->find($subUser->parent_id);
        if ($user && $user->member_status != FREE) {
            return true;
        }
        return false;
    }
}

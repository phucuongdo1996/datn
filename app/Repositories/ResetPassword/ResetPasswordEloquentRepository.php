<?php

namespace App\Repositories\ResetPassword;

use App\Mail\ResetPasswordMail;
use App\Repositories\BaseRepository;
use App\Models\ResetPassword;
use App\Rules\PasswordValidationRule;

class ResetPasswordEloquentRepository extends BaseRepository implements ResetPasswordRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ResetPassword::class;
    }

    /**
     * Get the password reset validation rules.
     *
     * @param $type
     * @param $data
     * @return array
     */
    public function rules($type, $data)
    {
        if ($type == 'email') {
            return [
                'email_forgot' => ['required', 'exists:users,email,deleted_at,NULL'],
            ];
        }
        return [
            'password' => ['required', 'min:8', 'max:30', new PasswordValidationRule()],
            'password_confirm' => ['required', 'same:password'],
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    public function validationErrorMessages()
    {
        return [
            'email_forgot.exists' => [
                trans('validation.reset_password.exists_1'),
                trans('validation.reset_password.exists_2')
            ],
            'email_forgot.required' => trans('validation.register.email.required'),
            'password.required' => trans('validation.register.password.required'),
            'password.min' => trans('validation.register.password.min_max'),
            'password.max' => trans('validation.register.password.min_max'),
            'password_confirm.required' => trans('validation.register.password.required'),
            'password_confirm.same' => [
                trans('validation.reset_password.pw_confirm.same_1'),
                trans('validation.reset_password.pw_confirm.same_2'),
                ],
        ];
    }

    /**
     * Add Record Into Password Reset Table
     *
     * @param array $data
     * @return bool
     */
    public function addRecordIntoPasswordResetTable(array $data)
    {
        try {
            $token = $this->createResetPasswordToken();
            resolve(ResetPasswordMail::class)->sendMailResetPassword([
                'email' => $data['email_forgot'],
                'link_reset_password' => $this->createLinkResetPassword($token)
            ]);
            $this->updateOrCreate(
                [
                    'email' => $data['email_forgot'],
                ],
                [
                    'token' => $token,
                    'used' => FLAG_ZERO,
                ]);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Update or Create an entity in repository
     *
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * Create Reset Password Token
     *
     * @return false|string
     */
    public function createResetPasswordToken()
    {
        do {
            $token = substr(md5(rand()), 0, 25);
        } while ($this->findByAttribute('token', $token) != null);
        return $token;
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
     * Create Link Reset Password
     *
     * @param string $token
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function createLinkResetPassword($token)
    {
        return url('pass-reminder/changepass/' . $token);
    }

    /**
     * Check expiry time active
     *
     * @param array $expiryTime
     * @return bool
     */
    public function checkExpiryTimeActive($expiryTime)
    {
        if ($expiryTime->modify('+1 day') > date('Y-m-d H:i:s')) {
            return true;
        }
        return false;
    }

}

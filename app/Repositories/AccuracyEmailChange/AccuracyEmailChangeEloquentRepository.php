<?php

namespace App\Repositories\AccuracyEmailChange;

use App\Models\AccuracyEmailChange;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AccuracyEmailChangeEloquentRepository  extends BaseRepository implements AccuracyEmailChangeRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return AccuracyEmailChange::class;
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
     * @return mixed
     */
    public function findByAttribute(string $attribute, string $value)
    {
        return $this->model->where($attribute, $value)->first();
    }

    /**
     * Create record and send mail
     *
     * @param $userId
     * @param $email
     * @return bool
     */
    public function createRecordAndSendMail($userId, $email)
    {
        try {
            $verifiedToken = $this->createVerifiedToken();
            $this->model->where([
                'user_id' => $userId
            ])->delete();
            $this->create([
                'user_id' => $userId,
                'email' => $email,
                'verified_token' => $verifiedToken,
                'status' => EMAIL_WATTING_ACCURACY
            ]);
            $this->sendMailVerified([
                'email' => $email,
                'link_verified' => $this->createLinkVerifiedEdit($verifiedToken)
            ]);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Create link verified edit
     *
     * @param $verifiedToken
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function createLinkVerifiedEdit($verifiedToken)
    {
        return url('edit/authentication/'.$verifiedToken);
    }

    /**
     * Send mail verified
     *
     * @param array $infoSendMail
     */
    public function sendMailVerified(array $infoSendMail)
    {
        Mail::send('profiles/form-mail-edit', ['link' => $infoSendMail['link_verified']], function ($message) use ($infoSendMail) {
            $message->to($infoSendMail['email'], 'CYARea!')->subject(trans('mail-attributes.title'));
        });
    }

    /**
     * Update email change
     *
     * @param $record
     * @return bool
     */
    public function updateEmailChange($record)
    {
        DB::beginTransaction();
        try {
            if (resolve(UserRepositoryInterface::class)->findByEmail($record->email)) {
                DB::rollBack();
                return false;
            }
            resolve(VerifiedRegisterRepositoryInterface::class)->deleteRecordByEmail($record->user->email);
            $record->user()->update(['email' => $record->email]);
            $record->profile()->update(['email' => $record->email]);
            $record->status = EMAIL_VERIFIED;
            $record->save();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }
}

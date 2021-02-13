<?php

namespace App\Repositories\SubUserPermission;

use App\Models\SubUserPermission;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SubUserPermissionEloquentRepository extends BaseRepository implements SubUserPermissionRepositoryInterface
{
    /**
     * @return string
     */
    public function model()
    {
        return SubUserPermission::class;
    }

    /**
     * Change permission SubUser
     *
     * @param $arrayRole
     * @param $arrayChange
     * @return bool
     */
    public function changePermissionSubUser($arrayRole, $arrayChange)
    {
        DB::beginTransaction();
        try {
            foreach ($arrayChange as $value) {
                $this->model->updateOrCreate(['id_sub_user' => $value], $this->makeDataForm($arrayRole[$value], $value));
                resolve(UserRepositoryInterface::class)->changeStatusUser($value, $arrayRole[$value]['status'] == CLOSE ? DISABLE : OPEN);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Make data form
     *
     * @param $array
     * @param $idSubuser
     * @return array
     */
    public function makeDataForm($array, $idSubuser)
    {
        return [
            'id_sub_user' => $idSubuser,
            'change_property' => isset($array['change_property']) ? true : false,
            'change_sub_user' => isset($array['change_sub_user']) ? true : false,
            'change_plan' => isset($array['change_plan']) ? true : false,
            'change_mypage' => isset($array['change_mypage']) ? true : false,
            'status' => $array['status'],
        ];
    }

    /**
     * Delete permission by $subUser
     *
     * @param $subUsers
     */
    public function deleteSubUserPermission($subUsers)
    {
        $this->whereIn('id_sub_user', $subUsers)->delete();
    }
}

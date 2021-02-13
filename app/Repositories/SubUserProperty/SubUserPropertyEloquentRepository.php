<?php

namespace App\Repositories\SubUserProperty;

use App\Models\SubUserProperty;
use App\Repositories\BaseRepository;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\Property\PropertyEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubUserPropertyEloquentRepository extends BaseRepository implements SubUserPropertyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return SubUserProperty::class;
    }

    /**
     * get all
     *
     * @return mixed
     */
    public function getAllData()
    {
        return $this->model->get()->groupBy('property_id')->toArray();
    }

    /**
     * delete by subUser property id
     *
     * @param $id
     * @return bool
     */
    public function deleteByIdSubUserProperty($id)
    {
        $this->model->where('id', $id)->delete();
    }

    /**
     * processing data
     *
     * @param $params
     * @return array
     */
    public function processingData($params)
    {
        $arrData = [];
        foreach ($params['permission'] as $key => $value) {
            $this->deleteByIdSubUserProperty($params['id'][$key]);
            if ((int)$value == FLAG_ZERO) {
                continue;
            }
            array_push($arrData, [
                'property_id' => $params['property_id'],
                'user_id' => $params['user_id'][$key],
                'permission' => $value
            ]);
        }

        return $arrData;
    }

    /**
     * save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params)
    {
        DB::beginTransaction();
        try {
            $property = resolve(PropertyRepositoryInterface::class)->find($params['property_id']);
            $property->subUserProperty()->createMany($this->processingData($params));
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return false;
        }
    }

    /**
     * get property of sub user
     *
     * @param $userId
     * @return array
     */
    public function getDataPropertyForUser($userId)
    {
        return $this->model->select('property_id')->where('user_id', $userId)->pluck('property_id')->toArray();
    }

    /**
     * get property permission report of sub user
     *
     * @param $userId
     * @return array
     */
    public function getDataPropertyReportForUser($userId)
    {
        return $this->model->select('property_id')->where('user_id', $userId)->whereIn('permission', ARRAY_REPORT_PERMISSION)->pluck('property_id')->toArray();
    }

    /**
     * get property permission report of sub user
     *
     * @param $userId
     * @return array
     */
    public function getDataPropertyEditForUser($userId)
    {
        return $this->model->select('property_id')->where('user_id', $userId)->whereIn('permission', ARRAY_EDIT_PERMISSION)->pluck('property_id')->toArray();
    }

    /**
     * get data permission for user
     *
     * @param $userId
     * @param $propertyId
     * @param $screen
     * @return bool
     */
    public function checkPermissionForUser($userId, $propertyId, $screen)
    {
        $data = $this->model
            ->where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->first();
        if (!$data) {
            return false;
        }

        switch ($screen) {
            case EDIT_SCREEN:
                if (in_array($data->permission, ARRAY_EDIT_PERMISSION)) {
                    return true;
                }
                return false;
                break;
            case DELETE_SCREEN:
                if (in_array($data->permission, ARRAY_DELETE_PERMISSION)) {
                    return true;
                }
                return false;
                break;
            case REPORT_SCREEN:
                if (in_array($data->permission, ARRAY_REPORT_PERMISSION)) {
                    return true;
                }
                return false;
                break;
            default:
                return false;
        }
    }

    /**
     * function handel Check Permission
     *
     * @param $propertyId
     * @param $screen
     * @return bool
     */
    public function handleCheckPermission($propertyId, $screen)
    {
        $user = Auth::user();
        $dataProperty = resolve(PropertyEloquentRepository::class)->getDataByIdOfUser($propertyId, $user['id']);
        if ($dataProperty) {
            return $dataProperty;
        }

        if ($user->isSubUser()) {
            return $this->checkPermissionForUser($user->id, $propertyId, $screen);
        }

        return false;
    }

    /**
     * unset relation ship after move property
     *
     * @param array $properties
     * @return mixed
     */
    public function deleteRelationshipAfterMoveProperty($properties)
    {
        return $this->model->whereIn('property_id', $properties)->delete();
    }

    /**
     * unset relation ship after move sub user
     *
     * @param int $subUserId
     * @return mixed
     */
    public function deleteRelationshipAfterMoveSubUser($subUserId)
    {
        return $this->model->whereIn('user_id', $subUserId)->delete();
    }

    /**
     * Get list property permission
     *
     * @param $subUserId
     * @param $permission
     * @return mixed
     */
    public function getListPropertyPermission($subUserId, $permission = [])
    {
        return $this->model->where('user_id', $subUserId)->when(!empty($permission), function ($query) use ($permission) {
            return $query->whereIn('permission', $permission);
        })->pluck('property_id')->toArray();
    }
}

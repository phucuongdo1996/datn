<?php

namespace App\Repositories\SimpleAssessment;

use App\Models\SimpleAssessment;
use App\Repositories\BaseRepository;

class SimpleAssessmentEloquentRepository extends BaseRepository implements SimpleAssessmentRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return SimpleAssessment::class;
    }

    /**
     * Get data simple assessment with id
     *
     * @param integer $simpleAssessmentId
     * @return mixed
     */
    public function getObjectSimpleAssessmentById($simpleAssessmentId)
    {
        $data = $this->model->where('property_id', $simpleAssessmentId)
            ->first();
        if ($data) {
            return $data;
        }
        return null;
    }

    /**
     * Save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params)
    {
        try {
            SimpleAssessment::updateOrCreate(
                [
                'property_id' => $params['property_id'],
                ],
                [
                    'year' => isset($params['year']) ? $params['year'] : null,
                    'net_profit' => $params['net_profit'],
                    'amount_assessed_taxing' => $params['amount_assessed_taxing']
                ]
            );
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Get list property reports
     *
     * @param integer $userId User current Id
     * @param integer $perPage Option paginate
     *
     * @return mixed
     */
    public function getListSimpleAssessmentUpdatedAt($userId, $perPage)
    {
        return $this->model->where('user_id', $userId)
            ->select(['id', 'house_name', 'updated_at'])
            ->with(['generalInfo'])
            ->simplePaginate($perPage);
    }

    /**
     * @param $option
     * @param $data
     */
    public function updateOrCreate($option, $data)
    {
        $this->model->updateOrCreate($option, $data);
    }
}

<?php

namespace App\Repositories\BusinessPlan;

use App\Models\BusinessPlan;
use App\Repositories\BaseRepository;

class BusinessPlanEloquentRepository extends BaseRepository implements BusinessPlanRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return BusinessPlan::class;
    }

    /**
     * save data
     *
     * @param array $params
     * @return bool
     */
    public function saveData($params)
    {
        try {
            $this->model->updateOrCreate(
                [
                'property_id' => $params['property_id'],
                ],
                [
                'input_date' => $params['input_date'],
                'year' => isset($params['year']) ? $params['year'] : null,
                'destination_bank' => $params['destination_bank'],
                'destination_address' => $params['destination_address'],
                'destination_name' => $params['destination_name'],
                'material_creator_name' => $params['material_creator_name'],
                'expected_borrowing_date' => $params['expected_borrowing_date'],
                'expected_borrowing_amount' => $params['expected_borrowing_amount'],
                'initial_borrowing_period' => $params['initial_borrowing_period'],
                'expected_interest' => $params['expected_interest'],
                'date_of_confirmation' => $params['date_of_confirmation'],
                'note_confirmation_procedure' => $params['note_confirmation_procedure'],
                'addendum' => $params['addendum'],
                ]
            );
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * check data exists by property id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function checkDataExistsByPropertyId($propertyId)
    {
        return $this->model->where('property_id', $propertyId)
            ->exists();
    }

    /**
     * Get data business plan  with property_id
     *
     * @param integer $propertyId
     * @return mixed
     */
    public function getObjectBusinessPlanByPropertyId($propertyId)
    {
        $data =  $this->model->where('property_id', $propertyId)
            ->first();

        if ($data) {
            return $data->toArray();
        }
        return [];
    }
}

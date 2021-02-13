<?php

namespace App\Repositories\TaxProperty;

use App\Models\TaxProperty;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class TaxPropertyEloquentRepository extends BaseRepository implements TaxPropertyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return TaxProperty::class;
    }

    /**
     * Get records need auto update
     *
     * @param $propertyId
     * @param $year
     * @param $month
     * @return mixed
     */
    public function getRecordsUpdate($propertyId, $year, $month)
    {
        return $this->model->join('taxes', 'taxes.id', 'tax_property.tax_id')
            ->where('property_id', $propertyId)
            ->where('year', $year)
            ->where('month', $month)
            ->where('taxes.deleted_at', null)
            ->get()->toArray();
    }

    /**
     * Delete record with conditions
     *
     * @param $taxId
     * @param $oldData
     *
     * @throws \Exception
     */
    public function deleteDataByConditions($taxId, $propertyId)
    {
        $this->where('property_id', $propertyId)
             ->where('tax_id', $taxId)
             ->first()
             ->delete();
    }

    /**
     * Remove records when move property
     *
     * @param $properties
     */
    public function removeRecordsWhenMoveProperty($properties)
    {
        $this->model->whereIn('property_id', $properties)->forceDelete();
    }
}

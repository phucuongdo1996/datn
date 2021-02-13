<?php

namespace App\Repositories\Specialty;

use App\Models\Specialty;
use App\Repositories\BaseRepository;

class SpecialtyEloquentRepository extends BaseRepository implements SpecialtyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Specialty::class;
    }

    /**
     * Get all record from type
     *
     * @param bool|int $type
     * @return array
     */
    public function getAllFromType($type = SPECIALTIES_EXPERT)
    {
        if ($list = $this->model->where('type', $type)->get()) {
            return $list->toArray();
        }
        return [];
    }
}

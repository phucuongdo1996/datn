<?php

namespace App\Repositories\ProfileSpecialty;

use App\Models\ProfileSpecialty;
use App\Repositories\BaseRepository;

class ProfileSpecialtyEloquentRepository extends BaseRepository implements ProfileSpecialtyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ProfileSpecialty::class;
    }
}

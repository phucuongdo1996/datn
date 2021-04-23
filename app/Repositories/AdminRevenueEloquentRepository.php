<?php

namespace App\Repositories;

use App\Models\AdminRevenue;

class AdminRevenueEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return AdminRevenue::class;
    }
}

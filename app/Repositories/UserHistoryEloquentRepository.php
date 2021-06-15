<?php

namespace App\Repositories;

use App\Models\UserHistory;

class UserHistoryEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return UserHistory::class;
    }
}

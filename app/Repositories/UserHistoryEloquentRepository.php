<?php

namespace App\Repositories;

use App\Models\UserHistory;
use Illuminate\Support\Facades\Auth;

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

    public function getHistories()
    {
        $userId = Auth::user()->id;
        return $this->model->where('user_id', $userId)->orWhere('partner_id', $userId)->orderBy('created_at', 'DESC')->get();
    }
}

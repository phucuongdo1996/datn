<?php

namespace App\Repositories;

use App\Models\SteamCode;

class SteamCodeEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return SteamCode::class;
    }

    public function getStatusSteamCode()
    {
        return $this->model->selectRaw('type, count(*) as count_record')->where('status', STEAM_CODE_READY)->groupBy('type')->get()->keyBy('type')->toArray();
    }
}

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

    /**
     * Lấy tình trạng tồn kho thẻ Steam Code.
     *
     * @return mixed
     */
    public function getStatusSteamCode()
    {
        return $this->model->selectRaw('type, count(*) as count_record')->where('status', STEAM_CODE_READY)->groupBy('type')->get()->keyBy('type')->toArray();
    }

    /**
     * Mua một mã thẻ.
     *
     * @param $type
     * @return |null
     */
    public function buySteamCode($type)
    {
        $record = $this->model->where([
            'type' => $type,
            'status' => STEAM_CODE_READY
        ])->first();
        if ($record) {
            $record->status = STEAM_CODE_USED;
            $record->save();
            return $record;
        }
        return null;
    }

    public function getData($params)
    {
        return $this->model->where('status', STEAM_CODE_READY)
            ->when(isset($params['steam_code']), function ($query) use ($params) {
                return $query->where('steam_code', 'like', $params['steam_code'] . '%')->orWhere('steam_seri', 'like', $params['steam_code'] . '%');
            })
            ->when(isset($params['type']), function ($query) use ($params) {
                return $query->where('type', $params['type']);
            })
            ->orderBy('type')->orderBy('created_at', 'DESC')->paginate(20);
    }
}

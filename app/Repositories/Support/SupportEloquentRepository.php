<?php

namespace App\Repositories\Support;

use App\Models\Support;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SupportEloquentRepository extends BaseRepository implements SupportRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Support::class;
    }

    /**
     * Get data for support
     *
     * @param $params
     * @param $perPage
     * @return mixed
     */
    public function getDataForSupport($params, $perPage)
    {
        return $this->model
            ->join('users', 'supports.user_id', 'users.id')
            ->join('profiles', 'supports.user_id', 'profiles.user_id')
            ->select(['supports.*', 'role', 'member_status', 'profiles.person_charge_first_name', 'profiles.person_charge_last_name'])
            ->whenOption('users.role', $params['role'] ?? null)
            ->whenOption('users.member_status', $params['member_status'] ?? null)
            ->whenOption('state', $params['support_status'] ?? null)
            ->when(isset($params['nick_name']), function ($query) use ($params) {
                return $query->whereRaw("(CONCAT(profiles.person_charge_last_name, profiles.person_charge_first_name) like '%" . $params['nick_name'] . "%')");
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage);
    }

    /**
     * Update support
     *
     * @param $params
     * @return bool
     */
    public function updateSupport($params)
    {
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($params['id']); $i++) {
                $this->update($params['id'][$i], [
                        'person_in_charge' => $params['person_in_charge'][$i],
                        'state' => $params['state'][$i],
                        'estimated_amount' => $params['estimated_amount'][$i],
                    ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }
}

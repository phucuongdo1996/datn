<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ContactEloquentRepository extends BaseRepository implements ContactRepositoryInterface
{
    /**
     * @return mixed|string
     */
    public function model()
    {
        return Contact::class;
    }

    /**
     * Get data contact Admin
     *
     * @param $params
     * @param $perPage
     * @return mixed
     */
    public function getDataContactAdmin($params, $perPage)
    {
        return $this->model
            ->when(isset($params['user_name']), function ($query) use ($params) {
                return $query->whereRaw("user_name like '%" . $params['user_name'] . "%'");
            })
            ->when(isset($params['contact_status']), function ($query) use ($params) {
                return $query->where('state', $params['contact_status']);
            })->orderBy('id', 'asc')
            ->paginate($perPage);
    }

    /**
     * Update contact
     *
     * @param $params
     * @return bool
     */
    public function updateContact($params)
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

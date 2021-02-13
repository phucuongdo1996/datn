<?php

namespace App\Repositories\Information;

use App\Models\Information;
use App\Repositories\BaseRepository;

class InformationEloquentRepository extends BaseRepository implements InformationRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Information::class;
    }

    /**
     * Get new information
     *
     * @return mixed
     */
    public function getNewInformation()
    {
        return $this->model->orderBy('created_at', 'DESC')->take(FLAG_THREE)->get()->toArray();
    }

    /**
     * Get information
     *
     * @param $params
     * @return mixed
     */
    public function getInformation($params)
    {
        return $this->model->when(isset($params['category']) && in_array($params['category'], INFORMATION_CATEGORIES), function ($query) use ($params) {
                return $query->where('category', $params['category']);
        })
            ->when(isset($params['title']), function ($query) use ($params) {
                return $query->whereRaw("title like '%" . $params['title'] . "%'");
            })
            ->orderBy('created_at', 'DESC')->paginate(FLAG_FIFTY);
    }

    /**
     * Delete record
     *
     * @param $id
     * @return bool
     */
    public function deleteRecord($id): bool
    {
        try {
            return $this->deleteById($id);
        } catch (\Exception $exception) {
            return false;
        }
    }
}

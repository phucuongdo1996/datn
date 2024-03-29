<?php

namespace App\Repositories;

use App\Models\Hero;

class HeroEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Hero::class;
    }

    /**
     * Lấy [Danh sách các tướng]
     *
     * @return mixed
     */
    public function getListHero()
    {
        return $this->model->orderBy('name')->get()->toArray(); // TODO: Change the autogenerated stub
    }
}

<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryEloquentRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Category::class;
    }
}

<?php


namespace App\Repositories\Category;


use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryEloquentRepository extends BaseRepository implements CategoryRepositoryInterface
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

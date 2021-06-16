<?php

namespace App\Traits;

trait ShowProduct
{
    /**
     * @return mixed
     */
    public function getIdsItems()
    {
        return $this->get()->pluck('product_base_id')->toArray();
    }

    /**
     * @param $productBaseId
     * @return mixed
     */
    public function addRecord($productBaseId)
    {
        return $this->model->updateOrCreate([
            'product_base_id' => $productBaseId
        ]);
    }
}

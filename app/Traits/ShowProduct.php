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
}

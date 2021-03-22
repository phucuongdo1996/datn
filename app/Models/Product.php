<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_base_id',
        'user_id',
        'price',
    ];
}

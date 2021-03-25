<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Market
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'market';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller_id',
        'buyer_id',
        'product_id',
        'price',
        'status',
    ];
}

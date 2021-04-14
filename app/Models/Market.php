<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model
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

    /**
     * Relationship to product table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

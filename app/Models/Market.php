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
        'price_real',
        'status',
    ];

    protected $appends = [
        'product_name',
        'product_image',
        'hero_image',
        'hero_name'
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

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function getSellerNameAttribute()
    {
        return $this->seller->nick_name;
    }

    public function getProductNameAttribute()
    {
        return $this->product->product_name;
    }

    public function getProductImageAttribute()
    {
        return $this->product->product_image;
    }

    public function getHeroImageAttribute()
    {
        return $this->product->hero_image;
    }

    public function getHeroNameAttribute()
    {
        return $this->product->hero_name;
    }
}

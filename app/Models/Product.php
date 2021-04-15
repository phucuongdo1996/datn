<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productBase()
    {
        return $this->belongsTo(ProductBase::class, 'product_base_id', 'id');
    }

    public function getProductNameAttribute()
    {
        return $this->productBase->name;
    }

    public function getProductImageAttribute()
    {
        return $this->productBase->image;
    }

    public function getHeroNameAttribute()
    {
        return isset($this->productBase->hero) ? $this->productBase->hero->name : null;
    }

    public function getHeroImageAttribute()
    {
        return isset($this->productBase->hero) ? $this->productBase->hero->image : null;
    }
}

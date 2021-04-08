<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRemarkable extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'products_remarkable';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_base_id'
    ];

    public function productBase()
    {
        return $this->belongsTo(ProductBase::class, 'product_base_id', 'id');
    }
}

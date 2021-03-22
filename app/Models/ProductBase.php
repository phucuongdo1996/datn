<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBase
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'products_base';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hero_id',
        'category_id',
        'type',
    ];
}

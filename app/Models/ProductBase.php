<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBase extends Model
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

    public function hero()
    {
        return $this->belongsTo(Hero::class, 'hero_id', 'id');
    }
}

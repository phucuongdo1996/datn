<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Hero
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'heros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}

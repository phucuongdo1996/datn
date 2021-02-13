<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'type'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileSpecialty extends Model
{
    use SoftDeletes;
    protected $table = 'profile_specialty';

    /**
     * @var array
     */
    protected $fillable = [
        'profile_id', 'specialty_id'
    ];
}

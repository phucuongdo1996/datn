<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileQualification extends Model
{
    use SoftDeletes;
    protected $table = 'profile_qualification';

    /**
     * @var array
     */
    protected $fillable = [
        'profile_id', 'qualification_id'
    ];
}

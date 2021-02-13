<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubUserPermission extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'id_sub_user','change_property', 'change_sub_user', 'change_plan', 'change_mypage', 'status'
    ];
}

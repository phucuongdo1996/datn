<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_code',
        'name',
        'email',
        'role',
        'password',
        'status',
        'verified_status',
        'member_status',
        'last_login',
        'parent_id',
        'reason_delete',
        'group_code',
        'sub_user_deleted',
        'unblock_status',
        'deleted_at'
    ];
}

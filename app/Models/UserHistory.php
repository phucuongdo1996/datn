<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHistory extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'user_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'steam_code_id',
        'purchase_money',
        'type',
    ];
}

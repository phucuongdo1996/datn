<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SteamCode extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'steam_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'steam_code',
        'steam_seri',
        'type',
        'status',
    ];
}

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
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'nick_name',
        'steam_url',
        'money_own',
    ];

    /**
     * Relationship to product table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    /**
     * Relationship to market [Seller]
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketSeller()
    {
        return $this->hasMany(Market::class, 'seller_id', 'id');
    }

    /**
     * Relationship to market [Buyer]
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketBuyer()
    {
        return $this->hasMany(Market::class, 'buyer_id', 'id');
    }

    /**
     *  Relationship to user_history table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userHistory()
    {
        return $this->hasMany(UserHistory::class, 'user_id', 'id');
    }
}

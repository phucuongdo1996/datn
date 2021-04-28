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
        'partner_id',
        'product_id',
        'steam_code_id',
        'purchase_money',
        'type',
    ];

    /**
     * Relationship to product table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Relationship to user table [Partner]
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id', 'id');
    }

    /**
     * Lấy tên sản phẩm.
     *
     * @return string
     */
    public function getProductNameAttribute()
    {
        return isset($this->product->productBase->name) ? $this->product->productBase->name : '';
    }

    /**
     * Lấy tên đối tác.
     *
     * @return string
     */
    public function getPartnerNameAttribute()
    {
        return isset($this->partner) ? $this->partner->nick_name : '';
    }

    /**
     * Relationship to steam code table [Partner]
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function steamCode()
    {
        return $this->belongsTo(SteamCode::class, 'steam_code_id', 'id');
    }
}

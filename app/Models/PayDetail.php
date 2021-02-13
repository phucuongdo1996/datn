<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayDetail extends Model
{
    protected $table = 'pay_detail';
    protected $fillable = [
        'user_id',
        'pay_code',
        'captured_at',
        'start_date',
        'finish_date',
        'member_status',
        'amounts_by_member',
        'total_sub',
        'amounts_by_sub_user',
        'amount_basic',
        'discount',
        'discount_value',
        'tax',
        'total_amount',
        'check_done',
    ];
    protected $dates = ['captured_at', 'start_date', 'finish_date', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Relationship with user table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    /**
     * Relationship with profile table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }
}

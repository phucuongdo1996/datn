<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepairHistory extends Model
{
    use SoftDeletes;

    protected $table = 'repair_history';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classify',
        'property_id',
        'describe',
        'order_repair_date',
        'construction_completion_date',
        'payment_excluding_tax',
        'payment_date',
        'payment_side',
        'unblock_status',
        'deleted_at'
    ];

    /**
     * The attributes auto set time stamps
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Relationship with property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'property_id');
    }
}

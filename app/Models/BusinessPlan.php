<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessPlan extends Model
{
    use SoftDeletes;

    protected $table = 'business_plans';

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
        'property_id',
        'year',
        'input_date',
        'destination_bank',
        'destination_address',
        'destination_name',
        'material_creator_name',
        'expected_borrowing_date',
        'expected_borrowing_amount',
        'initial_borrowing_period',
        'expected_interest',
        'date_of_confirmation',
        'note_confirmation_procedure',
        'addendum',
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
     * Relation with table property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'property_id', 'id');
    }
}

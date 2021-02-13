<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnualPerformance extends Model
{
    use SoftDeletes;

    protected $table = 'annual_performances';

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
        'id',
        'property_id',
        'year',
        'revenue_land_taxes',
        'rent_income',
        'general_services',
        'utilities_revenue',
        'parking_revenue',
        'income_input_money',
        'income_update_house_contract',
        'other_income',
        'bad_debt_losses',
        'sum_income',
        'management_fee',
        'utilities_fee',
        'repair_fee',
        'intact_reply_fee',
        'asset_management_fee',
        'tenant_recruitment_fee',
        'taxes_dues',
        'insurance_premium',
        'land_tax',
        'other_fee',
        'sum_fee',
        'sum_difference',
        'crop_yield',
        'dscr',
        'total_tenants',
        'area_may_rent',
        'deposits',
        'area_rental_operating',
        'synthetic_point',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}

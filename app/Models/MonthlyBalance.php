<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyBalance extends Model
{
    use SoftDeletes;

    protected $table = 'monthly_balances';

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
        'date_year_registration',
        'date_month_registration',
        'revenue_land_taxes',
        'revenue_room_rentals',
        'revenue_service_charges',
        'revenue_utilities',
        'revenue_car_deposits',
        'turnover_revenue',
        'revenue_contract_update_fee',
        'revenue_other',
        'bad_debt',
        'total_operating_revenue',
        'maintenance_management_fee',
        'electricity_gas_charges',
        'repair_fee',
        'recovery_costs',
        'property_management_fee',
        'find_tenant_fee',
        'tax',
        'loss_insurance',
        'land_rental_fee',
        'other_costs',
        'total_operating_costs',
        'operating_expenses',
        'rental_percentage',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    protected $table = 'taxes';
    protected $fillable = [
        'id',
        'rent',
        'key_money',
        'total_income',
        'taxes_dues',
        'non_life_insurance_premiums',
        'repair_costs',
        'depreciation',
        'borrowing_interest',
        'payment_rent',
        'salary_wage',
        'other_expenses',
        'total_required_expenses',
        'balance',
        'user_id',
        'year',
        'month',
        'proprietor',
        'other_income',
        'maintenance_management_fee',
        'utilities_expenses',
        'management_fee',
        'commission_paid',
        'loan_loss',
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
     * relationship with property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function property()
    {
        return $this->belongsToMany(Property::class, 'tax_property', 'tax_id', 'property_id');
    }

    /**
     * relationship with taxProperty table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxProperty()
    {
        return $this->hasMany(TaxProperty::class, 'tax_id', 'id');
    }

    /**
     * relationship with property and taxProperty table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function propertyTax()
    {
        return $this->hasManyThrough(Property::class, TaxProperty::class, 'tax_id', 'id', 'id', 'property_id');
    }
}

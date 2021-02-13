<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $table = 'property';

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
        'property_code',
        'order',
        'user_id',
        'avatar',
        'avatar_thumbnail',
        'proprietor',
        'status',
        'receive_house_date',
        'loan_date',
        'loan_bank_name',
        'bank_branch_name',
        'money_receive_house',
        'loan',
        'contract_loan_period',
        'interest_rate',
        'house_name',
        'zip_code',
        'address_city',
        'address_district',
        'address_town',
        'apartment_number',
        'room_number',
        'real_estate_type_id',
        'detail_real_estate_type_id',
        'house_material_id',
        'house_roof_type_id',
        'basement',
        'storeys',
        'ground_area',
        'total_area_floors',
        'construction_time',
        'land_right_id',
        'building_right_id',
        'total_tenants',
        'area_may_rent',
        'deposits',
        'type_rental_id',
        'area_rent',
        'rental_period_from',
        'rental_period_to',
        'date_lease',
        'deposit_host',
        'prize_money',
        'room_cede_fee',
        'fee_rebuild_rented_house',
        'contract_update_fee',
        'notes',
        'date_month_registration_revenue',
        'date_year_registration_revenue',
        'revenue_land_taxes',
        'revenue_room_rentals',
        'revenue_service_charges',
        'revenue_utilities',
        'revenue_car_deposits',
        'turnover_revenue',
        'revenue_contract_update_fee',
        'revenue_other',
        'bad_debt',
        'total_revenue',
        'maintenance_management_fee',
        'electricity_gas_charges',
        'property_management_fee',
        'find_tenant_fee',
        'tax',
        'loss_insurance',
        'land_rental_fee',
        'other_costs',
        'total_cost',
        'operating_expenses',
        'area_rental_operating',
        'rental_percentage',
        'repair_fee',
        'recovery_costs',
        'net_profit',
        'synthetic_point',
        'main_application',
        'unblock_status',
        'deleted_at'
    ];

    protected $appends = [
        'net_profit',
    ];

    /**
     * The attributes auto set time stamps
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Relation with table detail_realty
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detailRealEstateType()
    {
        return $this->belongsTo(DetailRealEstateType::class, 'detail_real_estate_type_id', 'id');
    }

    /**
     * Relation with table RealEstateType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realEstateType()
    {
        return $this->belongsTo(RealEstateType::class, 'real_estate_type_id', 'id');
    }

    /**
     * Relation with table building_rights
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buildingRight()
    {
        return $this->belongsTo(BuildingRight::class, 'building_right_id', 'id');
    }

    /**
     * Relation with table land_rights
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function landRight()
    {
        return $this->belongsTo(LandRight::class, 'land_right_id', 'id');
    }

    /**
     * Relation with table house_material
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function houseMaterial()
    {
        return $this->belongsTo(HouseMaterial::class, 'house_material_id', 'id');
    }

    /**
     * Relation with table house_roof_type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function houseRoofType()
    {
        return $this->belongsTo(HouseRoofType::class, 'house_roof_type_id', 'id');
    }

    /**
     * Relation with table type_rental
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeRental()
    {
        return $this->belongsTo(TypeRental::class, 'type_rental_id', 'id');
    }

    /**
     * Relation with table user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relation with table portfolioAnalysis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function portfolioAnalysis()
    {
        return $this->hasOne(PortfolioAnalysis::class, 'property_id');
    }

    /**
     * Relation with table GeneralInfoProperty
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function generalInfo()
    {
        return $this->hasOne(GeneralInfoProperty::class, 'property_id');
    }

    /**
     * Relation with table GeneralImagesProperty
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function generalImagesProperty()
    {
        return $this->hasMany(GeneralImagesProperty::class, 'property_id');
    }

    /**
     * Relation with table businessPlan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function businessPlan()
    {
        return $this->hasOne(BusinessPlan::class, 'property_id');
    }

    /**
     * Relationship with simpleAssessment table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function simpleAssessment()
    {
        return $this->hasOne(SimpleAssessment::class, 'property_id');
    }

    /**
     * Relationship with repairHistory table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repairHistory()
    {
        return $this->hasMany(RepairHistory::class, 'property_id', 'id');
    }

    /**
     * Relationship with rentRoll table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rentRolls()
    {
        return $this->hasMany(RentRoll::class, 'property_id', 'id');
    }

    /**
     * Relationship with monthlyBalance table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function monthlyBalances()
    {
        return $this->hasMany(MonthlyBalance::class, 'property_id', 'id');
    }

    /**
     * Relationship with annualPerformance table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annualPerformances()
    {
        return $this->hasMany(AnnualPerformance::class, 'property_id', 'id');
    }

    /**
     * Relationship with tax_property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxProperty()
    {
        return $this->hasMany(TaxProperty::class, 'property_id', 'id');
    }

    /**
     * Relationship with tax table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tax()
    {
        return $this->belongsToMany(Tax::class, 'tax_property', 'property_id', 'tax_id');
    }

    /**
     * Relationship with subUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subUser()
    {
        return $this->belongsToMany(SubUserProperty::class, 'sub_user_properties', 'property_id', 'user_id');
    }

    /**
     * scope query for sub user
     *
     * @param $query
     * @param array $properties
     * @param bool $flag
     * @return mixed
     */
    public function scopeSubUser($query, $properties, $flag)
    {
        return $query->when($flag, function ($query) use ($properties) {
            $query->whereIn('id', $properties);
        });
    }

    /**
     * scope query for main user
     *
     * @param $query
     * @param $userId
     * @param $flag
     * @return mixed
     */
    public function scopeMainUser($query, $userId, $flag)
    {
        return $query->when($flag, function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }

    /**
     * Scope compete chart
     *
     * @param $query
     * @return mixed
     */
    public function scopeCompeteChart($query)
    {
        return $query->selectRaw('*, ROUND((total_revenue - total_cost) / total_area_floors) as operating_balance, ROUND(area_may_rent / total_area_floors * 100, 2) as rentable_ratio, ROUND(total_cost * 100 / total_revenue, 2) as expense_ratio,
                ROUND(total_revenue / total_area_floors) as operating_revenue, ROUND(repair_fee / total_area_floors) as repair_cost, ROUND(maintenance_management_fee / total_area_floors / 12) as maintenance_management_cost,
                ROUND(loss_insurance / total_area_floors) as insurance_premium,
                ROUND(total_cost / total_area_floors) - (ROUND(maintenance_management_fee / total_area_floors / 12) + ROUND(repair_fee / total_area_floors) + ROUND(loss_insurance / total_area_floors)) as other_expense_items');
    }

    /**
     * Relationship with subUserProperty table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subUserProperty()
    {
        return $this->hasMany(SubUserProperty::class, 'property_id', 'id');
    }

    /**
     * @return mixed
     */
    public function getOperatingRevenueExpenditureAttribute()
    {
        return $this->total_revenue - $this->total_cost;
    }

    /**
     * @return mixed
     */
    public function getAmountAssessedTaxingAttribute()
    {
        if (!isset($this->simpleAssessment->amount_assessed_taxing)) {
            return FLAG_ZERO;
        }
        return $this->simpleAssessment->amount_assessed_taxing;
    }

    /**
     * @return int
     */
    public function getNetProfitAttribute()
    {
        if (!isset($this->simpleAssessment->net_profit)) {
            return FLAG_ZERO;
        }
        return $this->simpleAssessment->net_profit;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioAnalysis extends Model
{
    use SoftDeletes;

    protected $table = 'portfolio_analysis';

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
        'user_id',
        'property_id',
        'route_price',
        'land_tax_assessment',
        'estimate_inheritance_tax_valuation',
        'land_evaluation_note',
        'tax_valuation',
        'building_selection',
        'correction_factor',
        'noi_yield',
        'noi',
        'tax_land_price',
        'inheritance_tax_valuation',
        'debt_balance',
        'inheritance_tax_debt_balance',
        'assessed_amount',
        'assessed_amount_debt_balance',
        'comprehensive_balance_evaluation',
        'acquisition_price_yield',
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
     * Relation with table user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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

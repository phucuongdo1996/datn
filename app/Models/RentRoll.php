<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class RentRoll extends Model
{
    use SoftDeletes;

    protected $table = 'rent_rolls';

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
        'floor_code',
        'room_code',
        'room_status',
        'tenant',
        'monthly_service',
        'contract_area',
        'monthly_rent',
        'deposit',
        'monthly_service',
        'deposit_monthly',
        'real_estate_type_id',
        'contract_type',
        'key_money',
        'key_money_monthly',
        'contract_signing_date',
        'contract_start_date',
        'contract_end_date',
        'money_update',
        'cancellation_notice',
        'note',
        'unblock_status',
        'deleted_at'
    ];

    /**
     * Relation with table property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    /**
     * scope contract date
     * @param $query
     * @param $params
     * @return mixed
     */
    public function scopeContractDate($query, $params)
    {
        return $query->when($params, function (Builder $query) use ($params) {
            return $query->where(function (Builder $query) use ($params) {
                return $query->where('contract_start_date', '<=', $params['date_year'] . '-' . $params['date_month'] . '-01')
                    ->where('contract_end_date', '>=', $params['date_year'] . '-' . $params['date_month'] . '-01');
            });
        })
            ->when(!$params, function (Builder $query) {
                $date = now()->firstOfMonth()->format('Y-m-d');
                return $query->where(function (Builder $query) use ($date) {
                    return $query->where('contract_start_date', '<=', $date)->where('contract_end_date', '>=', $date);
                });
            });
    }
}

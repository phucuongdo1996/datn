<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndexFormulas extends Model
{
    protected $table = 'index_formulas';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'formula',
        'real_estate_type_id',
        'region_acreage_year',
        'amount',
        'medium',
        'first_quarter',
        'average_number',
        'third_quarter',
        'standard_deviation',
        'property_target',
    ];
}

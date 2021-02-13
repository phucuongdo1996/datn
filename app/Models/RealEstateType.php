<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealEstateType extends Model
{
    protected $table = 'real_estate_types';

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
        'name'
    ];

    /**
     * Relationship with detail_real_estate_types table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailRealEstateTypes()
    {
        return $this->hasMany(DetailRealEstateType::class, 'real_estate_type_id', 'id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRealEstateType extends Model
{
    protected $table = 'detail_real_estate_types';

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
        'name', 'real_estate_type_id'
    ];

    /**
     * Relation with table realty
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realEstateTypes()
    {
        return $this->belongsTo(RealEstateType::class, 'real_estate_type_id', 'id');
    }

    /**
     * Relationship with property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property()
    {
        return $this->hasMany(Property::class, 'detail_real_estate_type_id', 'id');
    }
}

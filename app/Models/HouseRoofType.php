<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseRoofType extends Model
{
    protected $table = 'house_roof_types';

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
     * Relationship with property table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property()
    {
        return $this->hasMany(Property::class, 'house_roof_type_id', 'id');
    }
}

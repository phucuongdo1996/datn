<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandRight extends Model
{
    protected $table = 'land_rights';

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
        return $this->hasMany(Property::class, 'land_right_id', 'id');
    }
}

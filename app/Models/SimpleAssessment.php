<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimpleAssessment extends Model
{
    use SoftDeletes;

    protected $table = 'simple_assessments';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id',
        'year',
        'net_profit',
        'amount_assessed_taxing',
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
     * Relationship with table property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'property_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxProperty extends Model
{
    use SoftDeletes;
    protected $table = 'tax_property';
    protected $fillable = ['property_id', 'tax_id'];


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
     * relationship with tax table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class, 'id', 'tax_id');
    }
}

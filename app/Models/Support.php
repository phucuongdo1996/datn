<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'supports';

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
        'user_name',
        'user_address',
        'content_of_inquiry',
        'content',
        'person_in_charge',
        'state',
        'estimated_amount',
    ];

    /**
     * Relationship with support table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    /**
     * scope when option
     *
     * @param $query
     * @param $option
     * @param $params
     * @return mixed
     */
    public function scopeWhenOption($query, $option, $params)
    {
        return $query->when(isset($params), function ($query) use ($params, $option) {
            return $query->where($option, $params);
        });
    }
}

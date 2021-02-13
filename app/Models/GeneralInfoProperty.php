<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInfoProperty extends Model
{
    use SoftDeletes;

    protected $table = 'general_info_property';

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
        'year',
        'status_confirm',
        'traffic',
        'price',
        'details_of_each_floor_area',
        'near_road',
        'area_used',
        'notes',
        'memo_broker',
        'display_house_name',
        'display_address',
        'display_apartment_number',
        'display_room_number',
        'display_ground_area',
        'display_total_area_floors',
        'display_details_of_each_floor_area',
        'display_area_rent',
        'display_area_may_rent',
        'display_area_rental_operating',
        'display_near_road',
        'display_area_used',
        'display_notes',
        'display_synthetic_point',
        'map_image_1',
        'map_image_2',
        'unblock_status',
        'deleted_at'
    ];

    /**
     * The attributes auto set time stamps
     *
     * @var bool
     */
    public $timestamps = true;
}

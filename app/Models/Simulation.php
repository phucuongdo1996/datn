<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    /**
     * The attributes that should be match to table.
     *
     * @var string
     */
    protected $table='simulations';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'zipcode',
        'province',
        'address',
        'uses',
        'construction_time',
        'ground_area',
        'total_area_floors',
        'revenue_room_rentals',
        'revenue_general_services',
        'revenue_utilities',
        'revenue_parking',
        'income_input_money',
        'income_update_house_contract',
        'other_revenue',
        'bad_debt',
        'maintenance_management_fee',
        'fee_utilities',
        'repair_fee',
        'fee_intact_reply',
        'fee_property_management',
        'fee_recruitment_rental',
        'tax',
        'loss_insurance',
        'other_fees',
        'house_price',
        'personal_money_spent',
        'interest',
        'year',
        'user_id',
        'synthetic_point'
    ];
}

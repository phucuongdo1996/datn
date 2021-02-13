<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('avatar')->nullable();
            $table->string('avatar_thumbnail')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('receive_house_date')->nullable();
            $table->date('loan_date')->nullable();
            $table->string('loan_bank_name')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->unsignedInteger('money_receive_house')->nullable();
            $table->unsignedInteger('loan')->nullable();
            $table->unsignedInteger('contract_loan_period')->nullable();
            $table->unsignedDecimal('interest_rate', 5, 2)->nullable();
            $table->string('house_name')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_town')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('room_number')->nullable();
            $table->integer('detail_real_estate_type_id');
            $table->string('house_material_id')->nullable();
            $table->string('house_roof_type_id')->nullable();
            $table->string('basement')->nullable();
            $table->string('storeys')->nullable();
            $table->string('ground_area')->nullable();
            $table->string('total_area_floors')->nullable();
            $table->date('construction_time')->nullable();
            $table->string('land_right_id')->nullable();
            $table->string('building_right_id')->nullable();
            $table->integer('total_tenants')->nullable();
            $table->string('area_may_rent')->nullable();
            $table->string('deposits')->nullable();
            $table->string('type_rental_id')->nullable();
            $table->string('area_rent')->nullable();
            $table->date('rental_period_from')->nullable();
            $table->date('rental_period_to')->nullable();
            $table->date('date_lease')->nullable();
            $table->string('deposit_host')->nullable();
            $table->string('prize_money')->nullable();
            $table->string('room_cede_fee')->nullable();
            $table->string('fee_rebuild_rented_house')->nullable();
            $table->string('contract_update_fee')->nullable();
            $table->string('notes')->nullable(); // luu y
            $table->date('date_registration_revenue')->nullable();
            $table->integer('revenue_land_taxes')->nullable();
            $table->integer('revenue_room_rentals')->nullable();
            $table->integer('revenue_service_charges')->nullable();
            $table->integer('revenue_utilities')->nullable();
            $table->integer('revenue_car_deposits')->nullable();
            $table->integer('turnover_revenue')->nullable();
            $table->integer('revenue_contract_update_fee')->nullable();
            $table->integer('revenue_other')->nullable();
            $table->integer('bad_debt')->nullable();
            $table->integer('total_revenue')->nullable();
            $table->integer('maintenance_management_fee')->nullable();
            $table->integer('electricity_gas_charges')->nullable();
            $table->integer('property_management_fee')->nullable();
            $table->integer('find_tenant_fee')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('loss_insurance')->nullable();
            $table->integer('land_rental_fee')->nullable();
            $table->integer('other_costs')->nullable();
            $table->integer('total_cost')->nullable();
            $table->integer('operating_expenses')->nullable();
            $table->integer('net_profit')->nullable();
            $table->integer('area_rental_operating')->nullable();
            $table->integer('rental_percentage')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnStringToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->text('traffic')->nullable()->change();
            $table->text('details_of_each_floor_area')->nullable()->change();
            $table->text('near_road')->nullable()->change();
            $table->text('area_used')->nullable()->change();
            $table->text('notes')->nullable()->change();
            $table->text('memo_broker')->nullable()->change();
            $table->bigInteger('price')->default(FLAG_ZERO)->change();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->text('person_charge_first_name')->nullable()->change();
            $table->text('person_charge_first_name_kana')->nullable()->change();
            $table->text('address_building')->nullable()->change();
            $table->text('company_name')->nullable()->change();
            $table->text('company_representative_first_name')->nullable()->change();
            $table->text('business_name')->nullable()->change();
            $table->text('website_business_name')->nullable()->change();
            $table->text('website_business_name_other')->nullable()->change();
            $table->text('person_charge_last_name')->nullable()->change();
            $table->text('person_charge_last_name_kana')->nullable()->change();
            $table->text('division')->nullable()->change();
            $table->text('company_representative_last_name')->nullable()->change();
        });

        Schema::table('property', function (Blueprint $table) {
            $table->unsignedBigInteger('money_receive_house')->default(FLAG_ZERO)->change();
            $table->unsignedBigInteger('loan')->default(FLAG_ZERO)->change();
            $table->unsignedBigInteger('contract_loan_period')->default(FLAG_ZERO)->change();
            $table->unsignedDecimal('interest_rate', 5, 2)->default(FLAG_ZERO)->change();
            $table->bigInteger('deposit_host')->charset('')->default(FLAG_ZERO)->change();
            $table->bigInteger('prize_money')->charset('')->default(FLAG_ZERO)->change();
            $table->bigInteger('room_cede_fee')->charset('')->default(FLAG_ZERO)->change();
            $table->bigInteger('fee_rebuild_rented_house')->charset('')->default(FLAG_ZERO)->change();
            $table->bigInteger('contract_update_fee')->charset('')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_land_taxes')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_room_rentals')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_service_charges')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_utilities')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_car_deposits')->default(FLAG_ZERO)->change();
            $table->bigInteger('turnover_revenue')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_contract_update_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('revenue_other')->default(FLAG_ZERO)->change();
            $table->bigInteger('bad_debt')->default(FLAG_ZERO)->change();
            $table->bigInteger('total_revenue')->default(FLAG_ZERO)->change();
            $table->bigInteger('maintenance_management_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('electricity_gas_charges')->default(FLAG_ZERO)->change();
            $table->bigInteger('property_management_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('find_tenant_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('tax')->default(FLAG_ZERO)->change();
            $table->bigInteger('loss_insurance')->default(FLAG_ZERO)->change();
            $table->bigInteger('land_rental_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('other_costs')->default(FLAG_ZERO)->change();
            $table->bigInteger('total_cost')->default(FLAG_ZERO)->change();
            $table->bigInteger('operating_expenses')->default(FLAG_ZERO)->change();
            $table->bigInteger('net_profit')->default(FLAG_ZERO)->change();
            $table->bigInteger('area_rental_operating')->default(FLAG_ZERO)->change();
            $table->unsignedDecimal('rental_percentage', 5, 2)->default(FLAG_ZERO)->change();
            $table->text('house_name')->nullable()->change();
            $table->text('apartment_number')->nullable()->change();
            $table->text('room_number')->nullable()->change();
            $table->text('notes')->nullable()->change();
            $table->integer('ground_area')->charset('')->default(FLAG_ZERO)->change();
            $table->integer('total_area_floors')->charset('')->default(FLAG_ZERO)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->string('traffic')->nullable()->change();
            $table->string('details_of_each_floor_area')->nullable()->change();
            $table->string('near_road')->nullable()->change();
            $table->string('area_used')->nullable()->change();
            $table->string('notes', 1000)->nullable()->change();
            $table->string('memo_broker', 1000)->nullable()->change();
            $table->integer('price')->nullable()->default(FLAG_ZERO)->change();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->string('person_charge_first_name')->nullable()->change();
            $table->string('person_charge_first_name_kana')->nullable()->change();
            $table->string('address_building')->nullable()->change();
            $table->string('company_name')->nullable()->change();
            $table->string('company_representative_first_name')->nullable()->change();
            $table->string('business_name')->nullable()->change();
            $table->string('website_business_name')->nullable()->change();
            $table->string('website_business_name_other')->nullable()->change();
            $table->string('person_charge_last_name')->nullable()->change();
            $table->string('person_charge_last_name_kana')->nullable()->change();
            $table->string('division')->nullable()->change();
            $table->string('company_representative_last_name')->nullable()->change();
        });

        Schema::table('property', function (Blueprint $table) {
            $table->unsignedInteger('money_receive_house')->nullable()->change();
            $table->unsignedInteger('loan')->nullable()->change();
            $table->unsignedInteger('contract_loan_period')->nullable()->change();
            $table->unsignedDecimal('interest_rate', 5, 2)->nullable()->change();
            $table->string('deposit_host')->nullable()->change();
            $table->string('prize_money')->nullable()->change();
            $table->string('room_cede_fee')->nullable()->change();
            $table->string('fee_rebuild_rented_house')->nullable()->change();
            $table->string('contract_update_fee')->nullable()->change();
            $table->integer('revenue_land_taxes')->nullable()->change();
            $table->integer('revenue_room_rentals')->nullable()->change();
            $table->integer('revenue_service_charges')->nullable()->change();
            $table->integer('revenue_utilities')->nullable()->change();
            $table->integer('revenue_car_deposits')->nullable()->change();
            $table->integer('turnover_revenue')->nullable()->change();
            $table->integer('revenue_contract_update_fee')->nullable()->change();
            $table->integer('revenue_other')->nullable()->change();
            $table->integer('bad_debt')->nullable()->change();
            $table->integer('total_revenue')->nullable()->change();
            $table->integer('maintenance_management_fee')->nullable()->change();
            $table->integer('electricity_gas_charges')->nullable()->change();
            $table->integer('property_management_fee')->nullable()->change();
            $table->integer('find_tenant_fee')->nullable()->change();
            $table->integer('tax')->nullable()->change();
            $table->integer('loss_insurance')->nullable()->change();
            $table->integer('land_rental_fee')->nullable()->change();
            $table->integer('other_costs')->nullable()->change();
            $table->integer('total_cost')->nullable()->change();
            $table->integer('operating_expenses')->nullable()->change();
            $table->integer('net_profit')->nullable()->change();
            $table->integer('area_rental_operating')->nullable()->change();
            $table->integer('rental_percentage')->nullable()->change();
            $table->string('house_name')->nullable()->change();
            $table->string('apartment_number')->nullable()->change();
            $table->string('room_number')->nullable()->change();
            $table->string('notes')->nullable()->change();
            $table->string('ground_area')->nullable()->change();
            $table->string('total_area_floors')->nullable()->change();
        });
    }
}

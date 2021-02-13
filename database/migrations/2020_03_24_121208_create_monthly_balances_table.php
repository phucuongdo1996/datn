<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('date_year_registration');
            $table->integer('date_month_registration');
            $table->bigInteger('revenue_room_rentals')->default(FLAG_ZERO);
            $table->bigInteger('revenue_service_charges')->default(FLAG_ZERO);
            $table->bigInteger('revenue_utilities')->default(FLAG_ZERO);
            $table->bigInteger('revenue_car_deposits')->default(FLAG_ZERO);
            $table->bigInteger('turnover_revenue')->default(FLAG_ZERO);
            $table->bigInteger('revenue_contract_update_fee')->default(FLAG_ZERO);
            $table->bigInteger('revenue_other')->default(FLAG_ZERO);
            $table->bigInteger('bad_debt')->default(FLAG_ZERO);
            $table->bigInteger('total_operating_revenue')->default(FLAG_ZERO);
            $table->bigInteger('maintenance_management_fee')->default(FLAG_ZERO);
            $table->bigInteger('electricity_gas_charges')->default(FLAG_ZERO);
            $table->bigInteger('repair_fee')->default(FLAG_ZERO);
            $table->bigInteger('recovery_costs')->default(FLAG_ZERO);
            $table->bigInteger('property_management_fee')->default(FLAG_ZERO);
            $table->bigInteger('find_tenant_fee')->default(FLAG_ZERO);
            $table->bigInteger('tax')->default(FLAG_ZERO);
            $table->bigInteger('loss_insurance')->default(FLAG_ZERO);
            $table->bigInteger('land_rental_fee')->default(FLAG_ZERO);
            $table->bigInteger('other_costs')->default(FLAG_ZERO);
            $table->bigInteger('total_operating_costs')->default(FLAG_ZERO);
            $table->bigInteger('operating_expenses')->default(FLAG_ZERO);
            $table->decimal('rental_percentage', FLAG_FOUR, FLAG_ONE)->default(0.0);
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
        Schema::dropIfExists('monthly_balances');
    }
}

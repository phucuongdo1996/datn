<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnualPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_performances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('property_id');
            $table->integer('year');
            $table->bigInteger('rent_income');
            $table->bigInteger('general_services');
            $table->bigInteger('utilities_revenue');
            $table->bigInteger('parking_revenue');
            $table->bigInteger('income_input_money');
            $table->bigInteger('income_update_house_contract');
            $table->bigInteger('other_income');
            $table->bigInteger('bad_debt_losses');
            $table->bigInteger('sum_income');
            $table->bigInteger('management_fee');
            $table->bigInteger('utilities_fee');
            $table->bigInteger('repair_fee');
            $table->bigInteger('intact_reply_fee');
            $table->bigInteger('asset_management_fee');
            $table->bigInteger('tenant_recruitment_fee');
            $table->bigInteger('taxes_dues');
            $table->bigInteger('insurance_premium');
            $table->bigInteger('land_tax');
            $table->bigInteger('other_fee');
            $table->bigInteger('sum_fee');
            $table->bigInteger('sum_difference');
            $table->bigInteger('crop_yield');
            $table->bigInteger('dscr');
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
        Schema::dropIfExists('annual_performances');
    }
}

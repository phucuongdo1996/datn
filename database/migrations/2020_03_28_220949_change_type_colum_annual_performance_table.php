<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumAnnualPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->float('crop_yield')->default(FLAG_ZERO)->change();
            $table->float('dscr')->default(FLAG_ZERO)->change();
            $table->bigInteger('rent_income')->default(FLAG_ZERO)->change();
            $table->bigInteger('general_services')->default(FLAG_ZERO)->change();
            $table->bigInteger('utilities_revenue')->default(FLAG_ZERO)->change();
            $table->bigInteger('parking_revenue')->default(FLAG_ZERO)->change();
            $table->bigInteger('income_input_money')->default(FLAG_ZERO)->change();
            $table->bigInteger('income_update_house_contract')->default(FLAG_ZERO)->change();
            $table->bigInteger('other_income')->default(FLAG_ZERO)->change();
            $table->bigInteger('bad_debt_losses')->default(FLAG_ZERO)->change();
            $table->bigInteger('sum_income')->default(FLAG_ZERO)->change();
            $table->bigInteger('management_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('utilities_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('repair_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('intact_reply_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('asset_management_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('tenant_recruitment_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('taxes_dues')->default(FLAG_ZERO)->change();
            $table->bigInteger('insurance_premium')->default(FLAG_ZERO)->change();
            $table->bigInteger('land_tax')->default(FLAG_ZERO)->change();
            $table->bigInteger('other_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('sum_fee')->default(FLAG_ZERO)->change();
            $table->bigInteger('sum_difference')->default(FLAG_ZERO)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->bigInteger('rent_income')->change();
            $table->bigInteger('general_services')->change();
            $table->bigInteger('utilities_revenue')->change();
            $table->bigInteger('parking_revenue')->change();
            $table->bigInteger('income_input_money')->change();
            $table->bigInteger('income_update_house_contract')->change();
            $table->bigInteger('other_income')->change();
            $table->bigInteger('bad_debt_losses')->change();
            $table->bigInteger('sum_income')->change();
            $table->bigInteger('management_fee')->change();
            $table->bigInteger('utilities_fee')->change();
            $table->bigInteger('repair_fee')->change();
            $table->bigInteger('intact_reply_fee')->change();
            $table->bigInteger('asset_management_fee')->change();
            $table->bigInteger('tenant_recruitment_fee')->change();
            $table->bigInteger('taxes_dues')->change();
            $table->bigInteger('insurance_premium')->change();
            $table->bigInteger('land_tax')->change();
            $table->bigInteger('other_fee')->change();
            $table->bigInteger('sum_fee')->change();
            $table->bigInteger('sum_difference')->change();
            $table->bigInteger('crop_yield')->change();
            $table->bigInteger('dscr')->change();
        });
    }
}

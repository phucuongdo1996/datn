<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRevenueLandTaxesInTableMonthlyBalances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_balances', function (Blueprint $table) {
            $table->bigInteger('revenue_land_taxes')->after('date_month_registration')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monthly_balances', function (Blueprint $table) {
            $table->dropColumn('revenue_land_taxes');
        });
    }
}

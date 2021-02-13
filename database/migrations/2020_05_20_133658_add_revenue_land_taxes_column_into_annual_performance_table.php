<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRevenueLandTaxesColumnIntoAnnualPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->bigInteger('revenue_land_taxes')->default(FLAG_ZERO)->nullable()->after('year');
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
            $table->dropColumn('revenue_land_taxes');
        });
    }
}

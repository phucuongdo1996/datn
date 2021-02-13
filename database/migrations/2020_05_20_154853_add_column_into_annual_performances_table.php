<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIntoAnnualPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->bigInteger('total_tenants')->default(0)->after('dscr');
            $table->bigInteger('area_may_rent')->default(0)->after('total_tenants');
            $table->bigInteger('deposits')->default(0)->after('area_may_rent');
            $table->bigInteger('area_rental_operating')->default(0)->after('deposits');
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
            $table->dropColumn('total_tenants');
            $table->dropColumn('area_may_rent');
            $table->dropColumn('deposits');
            $table->dropColumn('area_rental_operating');
        });
    }
}

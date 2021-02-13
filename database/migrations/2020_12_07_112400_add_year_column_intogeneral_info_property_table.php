<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearColumnIntogeneralInfoPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->integer('year')->after('property_id')->nullable();
        });

        Schema::table('annual_performances', function (Blueprint $table) {
            $table->float('synthetic_point')->after('area_rental_operating')->default(FLAG_ZERO);
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
            $table->dropColumn('year');
        });

        Schema::table('annual_performances', function (Blueprint $table) {
            $table->dropColumn('synthetic_point');
        });
    }
}

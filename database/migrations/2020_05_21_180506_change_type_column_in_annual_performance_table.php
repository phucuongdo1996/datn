<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnInAnnualPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->decimal('area_rental_operating', FLAG_TWENTY, FLAG_TWO)->default(0.00)->change();
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
            $table->bigInteger('area_rental_operating')->default(FLAG_ZERO)->change();
        });
    }
}

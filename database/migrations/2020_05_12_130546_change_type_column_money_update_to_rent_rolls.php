<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnMoneyUpdateToRentRolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_rolls', function (Blueprint $table) {
            $table->decimal('money_update', 20, 1)->default(0.0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_rolls', function (Blueprint $table) {
            $table->bigInteger('money_update')->default(0)->change();
        });
    }
}

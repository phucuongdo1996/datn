<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfColumnInPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->string('deposit_host', 255)->nullable()->change();
            $table->string('prize_money', 255)->nullable()->change();
            $table->string('room_cede_fee', 255)->nullable()->change();
            $table->string('fee_rebuild_rented_house', 255)->nullable()->change();
            $table->string('contract_update_fee', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->bigInteger('deposit_host')->default(0)->change();
            $table->bigInteger('prize_money')->default(0)->change();
            $table->bigInteger('room_cede_fee')->default(0)->change();
            $table->bigInteger('fee_rebuild_rented_house')->default(0)->change();
            $table->bigInteger('contract_update_fee')->default(0)->change();
        });
    }
}

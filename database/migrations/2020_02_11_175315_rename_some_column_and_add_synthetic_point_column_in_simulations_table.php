<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSomeColumnAndAddSyntheticPointColumnInSimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simulations', function (Blueprint $table) {
            $table->integer('synthetic_point')->after('user_id')->nullable();
            $table->integer('uses')->charset('')->change();
            $table->renameColumn('total_floor_area', 'total_area_floors');
            $table->renameColumn('damage_insurance', 'loss_insurance');
            $table->renameColumn('fee_repair', 'repair_fee');
            $table->renameColumn('fee_maintenance_management', 'maintenance_management_fee');
            $table->renameColumn('date_of_construction', 'construction_time');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simulations', function (Blueprint $table) {
            $table->dropColumn('synthetic_point');
            $table->string('uses')->change();
            $table->renameColumn('total_area_floors', 'total_floor_area');
            $table->renameColumn('loss_insurance', 'damage_insurance');
            $table->renameColumn('repair_fee', 'fee_repair');
            $table->renameColumn('maintenance_management_fee', 'fee_maintenance_management');
            $table->renameColumn('construction_time', 'date_of_construction');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToGeneralInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->dropColumn('status_confirm')->nullable();
            $table->text('traffic')->nullable()->change();
            $table->text('details_of_each_floor_area')->nullable()->change();
            $table->text('near_road')->nullable()->change();
            $table->text('area_used')->nullable()->change();
            $table->text('notes')->nullable()->change();
            $table->text('memo_broker')->nullable()->change();
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
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->boolean('status_confirm')->default(false);
            $table->string('traffic')->nullable()->change();
            $table->string('details_of_each_floor_area')->nullable()->change();
            $table->string('near_road')->nullable()->change();
            $table->string('area_used')->nullable()->change();
            $table->string('notes', 1000)->nullable()->change();
            $table->string('memo_broker', 1000)->nullable()->change();
        });
    }
}

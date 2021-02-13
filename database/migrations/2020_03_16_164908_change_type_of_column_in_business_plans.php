<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfColumnInBusinessPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_plans', function (Blueprint $table) {
            $table->text('destination_bank')->nullable()->change();
            $table->text('material_creator_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_plans', function (Blueprint $table) {
            $table->string('destination_bank')->nullable()->change();
            $table->string('material_creator_name')->nullable()->change();
        });
    }
}

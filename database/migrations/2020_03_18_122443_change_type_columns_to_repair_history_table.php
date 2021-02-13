<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnsToRepairHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repair_history', function (Blueprint $table) {
            $table->text('describe')->nullable()->change();
            $table->bigInteger('payment_excluding_tax')->default(0)->change();
            $table->text('payment_side')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repair_history', function (Blueprint $table) {
            $table->string('describe')->nullable()->change();
            $table->integer('payment_excluding_tax')->default(0)->change();
            $table->string('payment_side')->nullable()->change();
        });
    }
}

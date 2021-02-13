<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->string('classify');
            $table->string('describe')->nullable();
            $table->date('order_repair_date')->nullable();
            $table->date('construction_completion_date')->nullable();
            $table->integer('payment_excluding_tax')->default(0);
            $table->date('payment_date')->nullable();
            $table->string('payment_side')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_history');
    }
}

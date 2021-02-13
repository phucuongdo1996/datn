<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->date('input_date')->nullable();
            $table->string('destination_bank')->nullable();
            $table->string('material_creator_name')->nullable();
            $table->date('expected_borrowing_date')->nullable();
            $table->bigInteger('expected_borrowing_amount')->default(FLAG_ZERO);
            $table->integer('initial_borrowing_period');
            $table->unsignedDecimal('expected_interest', 5, 2)->default(0.00);
            $table->text('date_of_confirmation')->nullable();
            $table->text('note_confirmation_procedure')->nullable();
            $table->text('addendum')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('business_plans');
    }
}

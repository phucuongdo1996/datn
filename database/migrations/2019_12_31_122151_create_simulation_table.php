<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('zipcode')->nullable();
            $table->string('province');
            $table->string('address');
            $table->string('uses');
            $table->date('date_of_construction')->nullable();
            $table->decimal('ground_area',9,2)->nullable();
            $table->decimal('total_floor_area',9,2)->nullable();
            $table->integer('revenue_room_rentals')->nullable();
            $table->integer('revenue_general_services')->nullable();
            $table->integer('revenue_utilities')->nullable();
            $table->integer('revenue_parking')->nullable();
            $table->integer('income_input_money')->nullable();
            $table->integer('income_update_house_contract')->nullable();
            $table->integer('other_revenue')->nullable();
            $table->integer('bad_debt')->nullable();
            $table->integer('fee_maintenance_management')->nullable();
            $table->integer('fee_utilities')->nullable();
            $table->integer('fee_repair')->nullable();
            $table->integer('fee_intact_reply')->nullable();
            $table->integer('fee_property_management')->nullable();
            $table->integer('fee_recruitment_rental')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('damage_insurance')->nullable();
            $table->integer('other_fees')->nullable();
            $table->integer('house_price')->nullable();
            $table->integer('personal_money_spent')->nullable();
            $table->decimal('interest', 4, 2)->nullable();
            $table->integer('year')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('simulation');
    }
}

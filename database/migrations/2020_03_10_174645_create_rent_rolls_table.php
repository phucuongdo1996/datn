<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentRollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_rolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->text('floor_code')->nullable();
            $table->text('room_code')->nullable();
            $table->text('room_status')->nullable();
            $table->text('tenant')->nullable();
            $table->decimal('contract_area', 20, 2)->default(0.00);
            $table->bigInteger('monthly_rent')->default(0);
            $table->bigInteger('monthly_service')->default(0);
            $table->bigInteger('deposit')->default(0);
            $table->decimal('deposit_monthly', 20, 1)->default(0.0);
            $table->integer('real_estate_type_id')->nullable();
            $table->integer('contract_type')->nullable();
            $table->bigInteger('key_money')->default(0);
            $table->decimal('key_money_monthly', 20, 1)->default(0.0);
            $table->date('contract_signing_date')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->bigInteger('money_update')->default(0);
            $table->integer('cancellation_notice')->default(0);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('rent_rolls');
    }
}

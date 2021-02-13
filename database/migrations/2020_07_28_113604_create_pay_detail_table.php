<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pay_code');
            $table->bigInteger('user_id');
            $table->date('captured_at');
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->integer('member_status');
            $table->integer('amounts_by_member')->default(FLAG_ZERO);
            $table->integer('total_sub')->default(FLAG_ZERO);
            $table->integer('amounts_by_sub_user')->default(FLAG_ZERO);
            $table->integer('amount_basic')->default(FLAG_ZERO);
            $table->integer('discount')->default(FLAG_ZERO);
            $table->integer('discount_value')->default(FLAG_ZERO);
            $table->integer('tax')->default(FLAG_ZERO);
            $table->integer('total_amount')->default(FLAG_ZERO);
            $table->boolean('check_done')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('pay_detail');
    }
}

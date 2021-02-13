<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiedRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verified_registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->comment('email');
            $table->string('password')->comment('password');
            $table->tinyInteger('role')->comment('0 - manager, 1 - trader, 2 - expert');
            $table->string('verified_token', 25)->comment('verified token');
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
        Schema::dropIfExists('verified_register');
    }
}

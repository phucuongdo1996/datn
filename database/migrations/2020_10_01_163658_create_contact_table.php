<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('house_name');
            $table->text('user_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('note');
            $table->text('person_in_charge')->nullable();
            $table->tinyInteger('state')->nullable()->comment('1 - not_response, 2 - processing, 3 - processed, 4 - done');
            $table->integer('estimated_amount')->default(0);
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
        Schema::dropIfExists('contacts');
    }
}

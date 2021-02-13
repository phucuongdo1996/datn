<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_sub_user');
            $table->boolean('change_property')->default(false);
            $table->boolean('change_sub_user')->default(false);
            $table->boolean('change_plan')->default(false);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('sub_user_permissions');
    }
}

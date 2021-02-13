<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnInUserSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_specialty', function (Blueprint $table) {
            $table->renameColumn('user_id', 'profile_id');
        });
        Schema::table('profile_qualification', function (Blueprint $table) {
            $table->renameColumn('user_id', 'profile_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_specialty', function (Blueprint $table) {
            $table->renameColumn('profile_id', 'user_id');
        });
        Schema::table('profile_qualification', function (Blueprint $table) {
            $table->renameColumn('profile_id', 'user_id');
        });
    }
}

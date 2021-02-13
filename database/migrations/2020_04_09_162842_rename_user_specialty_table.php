<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameUserSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('user_specialties', 'profile_specialty');
        Schema::rename('user_qualifications', 'profile_qualification');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('profile_specialty', 'user_specialties');
        Schema::rename('profile_qualification', 'user_qualifications');
    }
}

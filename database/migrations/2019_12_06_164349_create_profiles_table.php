<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique();
            $table->string('person_charge_name')->nullable();
            $table->string('person_charge_name_kana')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_thumbnail')->nullable();
            $table->tinyInteger('gender')->comment('0 - women, 1 - man')->nullable();
            $table->date('birthday')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_town')->nullable();
            $table->string('address_building')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_representative')->nullable();
            $table->string('business_name')->nullable();
            $table->string('website_business_name')->nullable();
            $table->string('website_business_name_other')->nullable();
            $table->string('introduction')->nullable();
            $table->tinyInteger('trader')->nullable();
            $table->tinyInteger('qualification')->nullable();
            $table->tinyInteger('answer')->nullable();
            $table->string('notification')->nullable();
            $table->string('license_number')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralImagesPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_images_property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->string('image_name');
            $table->string('image_name_thumbnail');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->dropColumn('preview_image_1')->nullable();
            $table->dropColumn('preview_image_2')->nullable();
            $table->dropColumn('preview_image_3')->nullable();
            $table->dropColumn('preview_image_4')->nullable();
            $table->dropColumn('preview_image_5')->nullable();
            $table->dropColumn('preview_image_6')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_images_property');
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->string('preview_image_1')->nullable();
            $table->string('preview_image_2')->nullable();
            $table->string('preview_image_3')->nullable();
            $table->string('preview_image_4')->nullable();
            $table->string('preview_image_5')->nullable();
            $table->string('preview_image_6')->nullable();
        });
    }
}

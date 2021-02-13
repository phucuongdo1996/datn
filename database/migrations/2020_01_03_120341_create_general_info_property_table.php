<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralInfoPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_info_property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->boolean('status_confirm')->default(false);
            $table->string('traffic')->nullable();
            $table->integer('price')->nullable()->default(FLAG_ZERO);
            $table->string('details_of_each_floor_area')->nullable();
            $table->string('near_road')->nullable();
            $table->string('area_used')->nullable();
            $table->string('notes', 1000)->nullable();
            $table->string('memo_broker', 1000)->nullable();
            $table->boolean('display_house_name')->default(false);
            $table->boolean('display_apartment_number')->default(false);
            $table->boolean('display_room_number')->default(false);
            $table->boolean('display_ground_area')->default(false);
            $table->boolean('display_total_area_floors')->default(false);
            $table->boolean('display_details_of_each_floor_area')->default(false);
            $table->boolean('display_area_rent')->default(false);
            $table->boolean('display_area_may_rent')->default(false);
            $table->boolean('display_area_rental_operating')->default(false);
            $table->boolean('display_near_road')->default(false);
            $table->boolean('display_area_used')->default(false);
            $table->boolean('display_notes')->default(false);
            $table->string('map_image_1')->nullable();
            $table->string('map_image_2')->nullable();
            $table->string('preview_image_1')->nullable();
            $table->string('preview_image_2')->nullable();
            $table->string('preview_image_3')->nullable();
            $table->string('preview_image_4')->nullable();
            $table->string('preview_image_5')->nullable();
            $table->string('preview_image_6')->nullable();
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
        Schema::dropIfExists('general_info_property');
    }
}

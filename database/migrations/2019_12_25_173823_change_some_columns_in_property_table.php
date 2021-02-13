<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnsInPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn('date_registration_revenue');
            $table->dropColumn('net_profit');
            $table->integer('detail_real_estate_type_id')->nullable()->change();
            $table->string('property_code')->unique()->after('id');
            $table->integer('real_estate_type_id')->nullable()->after('room_number');
            $table->string('repair_fee')->nullable();
            $table->string('recovery_costs')->nullable();
            $table->string('date_year_registration_revenue')->nullable()->after('notes');
            $table->string('date_month_registration_revenue')->nullable()->after('date_year_registration_revenue');
            $table->integer('house_material_id')->charset('')->nullable()->change();
            $table->integer('house_roof_type_id')->charset('')->nullable()->change();
            $table->integer('land_right_id')->charset('')->nullable()->change();
            $table->integer('building_right_id')->charset('')->nullable()->change();
            $table->integer('type_rental_id')->charset('')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            $table->date('date_registration_revenue');
            $table->integer('net_profit');
            $table->integer('detail_real_estate_type_id')->nullable()->change();
            $table->dropColumn('property_code');
            $table->dropColumn('real_estate_type_id');
            $table->dropColumn('repair_fee');
            $table->dropColumn('recovery_costs')->nullable();
            $table->dropColumn('date_year_registration_revenue');
            $table->dropColumn('date_month_registration_revenue');
            $table->string('house_material_id')->nullable()->change();
            $table->string('house_roof_type_id')->nullable()->change();
            $table->string('land_right_id')->nullable()->change();
            $table->string('building_right_id')->nullable()->change();
            $table->string('type_rental_id')->nullable()->change();
        });
    }
}

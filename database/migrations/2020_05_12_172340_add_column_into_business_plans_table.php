<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIntoBusinessPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_plans', function (Blueprint $table) {
            $table->text('destination_address')->nullable()->after('destination_bank');
            $table->text('destination_name')->nullable()->after('destination_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_plans', function (Blueprint $table) {
            $table->dropColumn('destination_address');
            $table->dropColumn('destination_name');
        });
    }
}

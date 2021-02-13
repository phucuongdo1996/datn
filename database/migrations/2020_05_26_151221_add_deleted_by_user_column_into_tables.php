<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedByUserColumnIntoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('article_photos', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('topics', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('taxes', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('property', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('portfolio_analysis', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('repair_history', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('rent_rolls', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('business_plans', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('monthly_balances', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
        Schema::table('general_images_property', function (Blueprint $table) {
            $table->boolean('unblock_status')->default(0)->after('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('article_photos', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('taxes', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('annual_performances', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('portfolio_analysis', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('simple_assessments', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('repair_history', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('rent_rolls', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('business_plans', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('monthly_balances', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('general_info_property', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
        Schema::table('general_images_property', function (Blueprint $table) {
            $table->dropColumn('unblock_status');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLocationProvincesFriendlyUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_provinces', function (Blueprint $table) {
            $table->string('friendly_url')->after('province_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_provinces', function ($table) {
            $table->dropColumn('friendly_url');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quality_control_daily', function (Blueprint $table) {
            $table->integer('box_numbers')->nullable()->after('reject_weight');

        });
        Schema::table('quality_control_daily_values', function (Blueprint $table) {
            $table->integer('box_numbers')->nullable()->after('reject_weight');
            $table->unsignedBigInteger('machine_id')->nullable()->after('product_id');
            $table->foreign('machine_id')->references('id')->on('quality_control_machines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quality_control_daily', function (Blueprint $table) {

        });
    }
};

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
        Schema::table('quality_control_unit_inspection_values', function (Blueprint $table) {
            $table->unsignedBigInteger('machine_id')->nullable()->after('product_id');
            $table->foreign('machine_id')->references('id')->on('quality_control_machines');

        });

        Schema::table('quality_control_testing_values', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->after('machine_id')->nullable();
            $table->foreign('product_id')->references('id')->on('quality_control_products');
        });
        Schema::table('quality_control_reject_values', function (Blueprint $table) {
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
        //
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_control_average_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('period')->default(1);
            $table->unsignedTinyInteger('shift')->default(1);
            $table->string('time')->nullable();
            $table->float('design')->default(0);
            $table->float('average')->default(0);
            $table->timestamps();
        });
        Schema::create('quality_control_average_product_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('quality_control_daily');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreign('machine_id')->references('id')->on('quality_control_machines');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('quality_control_products');
            $table->float('design')->nullable();
            $table->float('average')->nullable();
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
        Schema::dropIfExists('quality_control_average_products');
    }
};

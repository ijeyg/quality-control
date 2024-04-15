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
        Schema::create('quality_control_rejects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->unsignedTinyInteger('period')->default(1);
            $table->unsignedTinyInteger('shift')->default(1);
            $table->string('head_shift_name')->nullable();
            $table->string('head_noonday')->nullable();
            $table->float('line_weight')->nullable();
            $table->float('run_weight')->nullable();
            $table->float('technical_weight')->nullable();
            $table->float('quality_weight')->nullable();
            $table->float('total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('quality_control_reject_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('quality_control_daily');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('quality_control_products');
            $table->float('line_weight')->nullable();
            $table->float('run_weight')->nullable();
            $table->float('technical_weight')->nullable();
            $table->float('quality_weight')->nullable();
            $table->float('total')->nullable();
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
        Schema::dropIfExists('quality_control_rejects');
    }
};

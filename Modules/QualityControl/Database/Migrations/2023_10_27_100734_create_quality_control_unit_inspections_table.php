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
        Schema::create('quality_control_unit_inspections', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->unsignedTinyInteger('period')->default(1);
            $table->unsignedTinyInteger('shift')->default(1);
            $table->unsignedTinyInteger('place')->default(1);
            $table->string('head_shift_name')->nullable();
            $table->string('head_noonday')->nullable();
            $this->extracted($table);
            $table->integer('total_of_total')->default(0);
            $table->integer('total')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('quality_control_unit_inspection_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('quality_control_daily');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('quality_control_products');
            $table->integer('count')->default(0);
            $table->unsignedBigInteger('status_packaging')->default(1);
            $this->extracted($table);
            $table->integer('total')->default(0);
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
        Schema::dropIfExists('quality_control_unit_inspections');
    }

    /**
     * @param Blueprint $table
     * @return void
     */
    public function extracted(Blueprint $table): void
    {
        $table->integer('water')->default(0);
        $table->integer('oil')->default(0);
        $table->integer('pollution')->default(0);
        $table->integer('membrane')->default(0);
        $table->integer('rupture')->default(0);
        $table->integer('humidity')->default(0);
        $table->integer('burn')->default(0);
        $table->integer('wrinkles')->default(0);
        $table->integer('weight')->default(0);
        $table->integer('number')->default(0);
    }
};

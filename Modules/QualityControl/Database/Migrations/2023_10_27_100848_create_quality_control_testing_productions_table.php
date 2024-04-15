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
        Schema::create('quality_control_testings', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedTinyInteger('morning');
            $table->unsignedTinyInteger('night');
            $table->unsignedTinyInteger('period');
            $table->string('head')->nullable();
            $table->tinyText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('quality_control_testing_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('quality_control_daily');
            $table->unsignedBigInteger('machine_id');
            $table->foreign('machine_id')->references('id')->on('quality_control_machines');
            $table->string('time');
            $table->unsignedTinyInteger('water')->nullable();
            $table->unsignedTinyInteger('oil')->nullable();
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
        Schema::dropIfExists('quality_control_testings');
    }
};

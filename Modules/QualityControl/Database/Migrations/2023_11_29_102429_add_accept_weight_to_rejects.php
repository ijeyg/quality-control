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
        Schema::table('quality_control_rejects', function (Blueprint $table) {
            $table->integer('accept_weight')->default(0)->after('run_weight');
        });
        Schema::table('quality_control_reject_values', function (Blueprint $table) {
            $table->integer('accept_weight')->default(0)->after('run_weight');
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

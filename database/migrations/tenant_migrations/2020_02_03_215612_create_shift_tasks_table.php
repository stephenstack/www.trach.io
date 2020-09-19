<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shift_id');
            $table->integer('antibiotic')->nullable()->default(null);
            $table->integer('hospital_illness')->nullable()->default(null);
            $table->integer('vent_ipap')->nullable()->default(null);
            $table->integer('vent_epap')->nullable()->default(null);
            $table->integer('vent_rate')->nullable()->default(null);
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
        Schema::dropIfExists('shift_tasks');
    }
}

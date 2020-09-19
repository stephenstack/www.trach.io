<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->timestamp('time_in')->nullable();
            $table->timestamp('expected_time_out')->nullable();
            $table->timestamp('actual_time_out')->nullable();
            $table->char('duration')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });

        DB::table('shifts')->insert(
            array(
                'id' => 1,
                'user_id' => 0,
                'time_in' => NULL,
                'expected_time_out' => NULL,
                'actual_time_out' => NULL,
                'duration' => NULL,
                'status' => 0
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwakesleepsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'awakesleeps';

    /**
     * Run the migrations.
     * @table awakesleeps
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('shift_id');
            $table->unsignedInteger('status');
            $table->unsignedInteger('sleep_time');
            $table->nullableTimestamps();
        });

        DB::table('awakesleeps')->insert([
            'id' => 1,
            'owner_id' => 0,
            'shift_id' => 0,
            'status' => 1,
            'sleep_time' => 0,
            'created_at' => date("Y-m-d H:i:s"),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}

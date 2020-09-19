<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateO2STable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'o2_s';

    /**
     * Run the migrations.
     * @table o2_s
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedInteger('owner_id');
            $table->integer('shift_id')->nullable()->default(null);
            $table->integer('treatment_time')->nullable()->default(null);
            $table->float('value')->nullable()->default(null);
            $table->unsignedInteger('status');
            $table->nullableTimestamps();
        });
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

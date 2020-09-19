<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'plans';

    /**
     * Run the migrations.
     * @table plans
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('description', 191);
            $table->integer('price')->unsigned()->nullable();
            $table->integer('user_count')->unsigned()->nullable();
            $table->unique(["name"], 'plans_name_unique');
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

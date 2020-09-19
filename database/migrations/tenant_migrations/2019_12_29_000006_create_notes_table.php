<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'notes';

    /**
     * Run the migrations.
     * @table notes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('owner_id')->nullable()->default(null);
            $table->string('owner_name', 100)->nullable()->default(null);
            $table->integer('notecategory_id')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->integer('permissions')->nullable()->default(null);
            $table->longText('note')->nullable()->default(null);
            $table->softDeletes();
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

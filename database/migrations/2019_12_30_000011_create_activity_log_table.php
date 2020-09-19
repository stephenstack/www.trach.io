<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'activity_log';

    /**
     * Run the migrations.
     * @table activity_log
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('log_name', 191)->nullable()->default(null);
            $table->text('description');
            $table->unsignedBigInteger('subject_id')->nullable()->default(null);
            $table->string('subject_type', 191)->nullable()->default(null);
            $table->unsignedBigInteger('causer_id')->nullable()->default(null);
            $table->string('causer_type', 191)->nullable()->default(null);
            $table->text('properties')->nullable()->default(null);
            $table->char('tenant_id', 36)->nullable()->default(null);

            $table->index(["causer_id", "causer_type"], 'causer');

            $table->index(["log_name"], 'activity_log_log_name_index');

            $table->index(["subject_id", "subject_type"], 'subject');
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

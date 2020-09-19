<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sessions';

    /**
     * Run the migrations.
     * @table sessions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id', 191);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('ip_address', 45)->nullable()->default(null);
            $table->text('user_agent')->nullable()->default(null);
            $table->text('payload');
            $table->integer('last_activity');

            $table->unique(["id"], 'sessions_id_unique');
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

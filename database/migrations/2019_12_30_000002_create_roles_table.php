<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'roles';

    /**
     * Run the migrations.
     * @table roles
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('role_name', 50);
            $table->text('role_description');
        });

        DB::table($this->tableName)->insert([
            'id' => '1',
            'role_name' => 'Global Admin',
            'role_description' => 'Global App Administrator'
        ]);
        DB::table($this->tableName)->insert([
            'id' => '2',
            'role_name' => 'Subscription Admin',
            'role_description' => 'Individual Subscription Admin/ Owner'
        ]);
        DB::table($this->tableName)->insert([
            'id' => '3',
            'role_name' => 'Subscription Member',
            'role_description' => 'Individual Subscription Member'
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

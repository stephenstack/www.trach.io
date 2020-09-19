<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'note_categories';

    /**
     * Run the migrations.
     * @table note_categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 50)->nullable()->default(null);
            $table->string('color', 50)->nullable()->default(null);
        });

        DB::table($this->tableName)->insert([
            [
                'id' => 1,
                'name' => 'General',
                'color' => 'blue',
            ],
            [
                'id' => 2,
                'name' => 'Incident',
                'color' => 'red',
            ],
            [
                'id' => 3,
                'name' => 'Accident',
                'color' => 'orange',
            ],
            [
                'id' => 4,
                'name' => 'Other',
                'color' => 'indigo',
            ]
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

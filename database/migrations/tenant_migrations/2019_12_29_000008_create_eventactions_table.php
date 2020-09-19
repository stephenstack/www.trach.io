<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventactionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'eventactions';

    /**
     * Run the migrations.
     * @table eventactions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->string('card_name', 50)->nullable()->default(null);
            $table->string('icon', 50)->nullable()->default(null);
            $table->string('title', 50)->nullable()->default(null);
            $table->mediumText('description')->nullable()->default(null);
            $table->string('btnMethod', 50)->nullable()->default(null);
            $table->char('thresholds');
            $table->integer('status')->nullable()->default(null);
            $table->timestamps();
        });
        DB::table('eventactions')->insert([
            [
                'id' => 1,
                'card_name' => 'o2',
                'icon' => 'icon-o2',
                'title' => 'O2',
                'description' => 'Carer can record O2 administration events',
                'btnMethod' => 'openO2Modal',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '1'
            ],
            [
                'id' => 2,
                'card_name' => 'suction',
                'icon' => 'icon-suction',
                'title' => 'Suction',
                'description' => 'One-click record of suction events for carers',
                'btnMethod' => 'setSuctionEvent',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '60'
            ],
            [
                'id' => 3,
                'card_name' => 'cough',
                'icon' => 'icon-cough',
                'title' => 'Cough Assist',
                'description' => 'One-click record of cough assist events for carers',
                'btnMethod' => 'setCoughEvent',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '0'
            ],
            [
                'id' => 4,
                'card_name' => 'desat',
                'icon' => 'icon-desat',
                'title' => 'Desat',
                'description' => 'Record desat events with desat value for carers',
                'btnMethod' => 'openDesatModal',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '92'
            ],
            [
                'id' => 5,
                'card_name' => 'neb',
                'icon' => 'icon-neb',
                'title' => 'Neb',
                'description' => 'One-click record of nebulizer events for carers',
                'btnMethod' => 'setNebEvent',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '120'
            ],
            [
                'id' => 6,
                'card_name' => 'environment',
                'icon' => 'icon-env',
                'title' => 'Environment',
                'description' => 'Record basic temp and humidity settings in patients surroundings',
                'btnMethod' => 'openEnvironmentModal',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '33.50'
            ],
            [
                'id' => 7,
                'card_name' => 'toilet',
                'icon' => 'icon-toilet',
                'title' => 'Toilet',
                'description' => 'One-click record of toilet events for carers',
                'btnMethod' => 'setToiletEvent',
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '0'
            ],
            [
                'id' => 8,
                'card_name' => 'meds',
                'icon' => 'icon-meds',
                'title' => 'Medication',
                'description' => 'One-click record of medication administration events for carers',
                'btnMethod' => 'setMedsEvent',
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '0'
            ],
            [
                'id' => 9,
                'card_name' => 'awakesleep',
                'icon' => 'icon-awakesleep',
                'title' => 'Awake/Sleep',
                'description' => 'Record when atient woke up, or went back to sleep',
                'btnMethod' => 'setAwakeToggleEvent',
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'thresholds' => '0'
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

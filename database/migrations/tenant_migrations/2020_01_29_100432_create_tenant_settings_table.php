<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('timezone', 100);
            $table->string('timezone_offset', 100);
            $table->string('temp_scale_value', 10)->default('c');
            $table->timestamps();
        });

        DB::table('tenant_settings')->insert(
            array(
                'id' => 1,
                'timezone' => config('app.timezone'),
                'timezone_offset' => '0'
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
        Schema::dropIfExists('tenant_settings');
    }
}

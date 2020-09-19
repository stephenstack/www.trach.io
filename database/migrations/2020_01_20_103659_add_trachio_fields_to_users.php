<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrachioFieldsToUsers extends Migration
{
    public $tableName = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->integer('tenant_user_id')->nullable()->default(null);
            $table->integer('active_status')->nullable()->default(null);
            $table->dateTime('last_login_at')->nullable()->default(null);
            $table->string('last_login_ip', 50)->nullable()->default(null);
            $table->integer('role_id')->nullable()->default(null);
            $table->char('tenant_id', 36)->nullable()->default(null);
            $table->integer('plan_id')->nullable()->default(null);

            $table->foreign('tenant_id', 'tenant_id')
                ->references('id')->on('tenants')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tenant_user_id');
            $table->dropColumn('active_status');
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('role_id');
            $table->dropColumn('tenant_id');
            $table->dropColumn('plan_id');
        });
    }
}

<?php

namespace App\Jobs;

use Mail;
use DB;
use App\Tenant;
use App\Notifications\StandardNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CreateNewTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $tenant_details;
    protected $tenant_id;
    protected $tenant_db_name;
    protected $tenant_db_username;
    protected $tenant_db_password;
    protected $tenant_host_name;

    public function __construct(array $user, $tenant_details)
    {
        $this->user = $user;
        $this->tenant_details = $tenant_details;
        $this->tenant_id = $this->tenant_details->tenant_id;
        $this->tenant_db_name = $this->tenant_details->db_name;
        $this->tenant_db_username = $this->tenant_details->db_username;
        $this->tenant_db_password = $this->tenant_details->db_password;
        $this->tenant_host_name = $this->tenant_details->host_name;
    }


    public function handle()
    {

        $newDBResult = $this->createSchema();
        $newSeedResult = $this->migrateTenantTables();

        if($newDBResult & $newSeedResult) {
            Log::notice($newTenantResult);
            Log::notice($newDBResult);
            Log::notice($newSeedResult);
            Log::info('New Tenant Setup completed. Sending Notification to user.');

            $usermessage = 'You private database has been created, and you can now login and use trach.io.';
            $adminmessage = 'Database for user ' . $this->user['email']. ' has been created.';
            \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($adminmessage, 'New Tenant was created successfully'));
            \Notification::route('mail', $this->user['email'])->notify(new StandardNotification($usermessage, 'trach.io tenant setup is complete.'));

        } else {
            $usermessage = 'Something went wrong when creating your Database for trach.io. Please contact support for more information.';
            $adminmessage = 'Database creation for user ' .$this->user['email']. ' has failed. Check the logs.';
            \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($adminmessage, 'New Tenant creation failed'));
            \Notification::route('mail', $this->user['email'])->notify(new StandardNotification($usermessage, 'trach.io tenant setup failed.'));

        }
    }

    protected function createSchema()
    {
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');
        $createDbQuery = "CREATE DATABASE IF NOT EXISTS  `" . $this->tenant_db_name . "` CHARACTER SET $charset COLLATE $collation;";
        $createUserQuery = "CREATE USER '".$this->tenant_db_username."'@'".$this->tenant_host_name."' IDENTIFIED BY '".$this->tenant_db_password."';";
        $grantQuery = "GRANT ALL PRIVILEGES ON `".$this->tenant_db_name."`.* TO '".$this->tenant_db_username."'@'".$this->tenant_host_name."';";

        try {
            DB::statement($createDbQuery);
            DB::statement($createUserQuery);
            DB::statement($grantQuery);

            $checkForDB = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
            $db = DB::select($checkForDB, [$this->tenant_db_name]);
            if (empty($db)) {
                Log::error('No db exist of that name!');
            } else {
                Log::info('Database, user and privileges successfully created.');
                return true;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }

    protected function migrateTenantTables()
    {
       //artisan migrate --database="0cb418df0d354a62b185b311643e0938" --path="/database/migrations/tenant_migrations" --force
       try {
            \Config::set(['database.connections.tenant.host' => $this->tenant_host_name]);
            \Config::set(['database.connections.tenant.username' => $this->tenant_db_username]);
            \Config::set(['database.connections.tenant.password' => $this->tenant_db_password]);
            \Config::set(['database.connections.tenant.database' => $this->tenant_db_name]);

            DB::connection('tenant');

            Artisan::call('migrate', ['--database' => 'tenant', '--path' => '/database/migrations/tenant_migrations/', '--force' => true, '--no-interaction' => true]);
            Artisan::call('db:seed', ['--database' => 'tenant', '--class' => 'TenantSeeder', '--force' => true, '--no-interaction' => true]);
            Log::info('New Tenant DB Setup & seed completed:  ('.$this->tenant_id.')' . Artisan::output());

            return true;
        } catch (\Exception $e) {
            // send email alert on failures
            Log::error($e->getMessage());
        }
    }



}

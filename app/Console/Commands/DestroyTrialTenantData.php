<?php

namespace App\Console\Commands;

use DB;
use Log;
use App\User;
use App\Subscription;
use App\Tenant;
use Carbon\Carbon;
use App\Notifications\StandardNotification;
use Illuminate\Console\Command;

class DestroyTrialTenantData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:destroy-trial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $results = User::where('tenant_user_id', 1)
                        ->where('role_id', 2)
                        ->whereNotNull('trial_ends_at')
                        ->whereNotNull('tenant_id')
                        ->where('trial_ends_at' , '<=', Carbon::now()->subDays(30)->toDateTimeString())
                        ->get(); // should match all tenant admins

        if($results->count() === 0){
            Log::notice('Tenant Cleanup Task: No trial tenants to clean up!'. $results);
            \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($results, 'No trial tenants to clean up!'));
            exit();
        }

        // str_replace("-", "", $this->tenant_id);
        $results->map(function ($result) {
                $result['db_name'] = str_replace("-", "", $result->tenant_id); // set correct DB name
                $this->deleteTenantSchema($result['db_name']); // delete the DB
                $result->tenant = Tenant::find($result->tenant_id); // attach tenant row to user
                Tenant::destroy($result->tenant_id); // soft delete the tenant row
                 // set tenant_id to none on user field (we can reference null later when user logins to portal)
                $tempuser = User::find($result->id);
                $tempuser->tenant_id = null;
                $tempuser->save();
                return $result;
        });

        Log::notice('Tenant Cleanup Task: Tenant Clean Completed'. $results);

        \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($results, 'Trial Cleanup task completed'));

    }

    protected function deleteTenantSchema($tenant_db_name)
    {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $db = DB::select($query, [$tenant_db_name]);
        if (empty($db)) {
            Log::warning('Tenant Cleanup Task: No db exist of that name - ' . $tenant_db_name );
        } else {

        $query = "DROP DATABASE `" . $tenant_db_name . "`;";
            try {
                DB::statement($query);
                return true;
            } catch (\Exception $e) {
                \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($e->getMessage(), 'Failed to delete tenant DB on trial cleanup'));
                Log::error($e->getMessage());
            }

        }

    }


}

<?php

namespace App\Http\Controllers\Auth;

use DB;
use Log;
use App\User;
use App\Tenant;
use Carbon\Carbon;
use App\Notifications\StandardNotification;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/app';
    protected $tenant_id;
    protected $tenant_host_name;
    protected $tenant_db_username;
    protected $tenant_db_password;
    protected $tenant_db_name;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // create new tenant, as a public website registration implies first user in tenant
        $this->createNewTenant();
        $this->createSchema();
        $this->migrateTenantTables();

        $usermessage = 'You private database has been created, and you can now login and use trach.io.';
        $adminmessage = 'Database for user ' . $data['email']. ' has been created.';
        \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($adminmessage, 'New Tenant was created successfully'));
        \Notification::route('mail', $data['email'])->notify(new StandardNotification($usermessage, 'trach.io tenant setup is complete.'));

        // dd($this->tenant_db_name);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tenant_user_id' => 1, // assumed to always be first user int he tenant for the intial public page registration
            'role_id' => '2',
            'active_status' => 1,
            'plan_id' => 1,
            'trial_ends_at' => Carbon::now()->addDays(7),
            'tenant_id' => $this->tenant_id
        ]);
    }

    protected function createNewTenant()
    {
        try {
            $tenant = new Tenant;
            $this->tenant_id = Str::uuid();
            $this->tenant_host_name = 'localhost';
            $this->tenant_db_name = str_replace("-", "", $this->tenant_id);
            $this->tenant_db_username = 'trachuser_' . Str::random(10);
            $this->tenant_db_password = Str::random(40);

            $tenant->id = $this->tenant_id;
            $tenant->host = $this->tenant_host_name;
            $tenant->username = $this->tenant_db_username;
            $tenant->password = $this->tenant_db_password;
            $tenant->database = $this->tenant_db_name;

            $tenant->save();
            return $this->tenant_id;
         } catch (\Exception $e) { // It's actually a QueryException but this works too
            \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($e->getMessage(), 'Tenant Registration Exception Notification'));

            if ($e->getCode() == 23000) {
                Log::error('The UUID for the new registered user was not unique');
                Log::error($e->getMessage());
            } else{
                Log::error($e->getMessage());
            }
        }
    }


    protected function createSchema()
    {
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_unicode_ci');
        $query = "CREATE DATABASE IF NOT EXISTS  `" . $this->tenant_db_name . "` CHARACTER SET $charset COLLATE $collation;";
        $query2 = "CREATE USER '".$this->tenant_db_username."'@'".$this->tenant_host_name."' IDENTIFIED BY '".$this->tenant_db_password."';";
        $query3 = "GRANT ALL PRIVILEGES ON `".$this->tenant_db_name."`.* TO '".$this->tenant_db_username."'@'".$this->tenant_host_name."';";

        try {
            DB::statement($query);
            DB::statement($query2);
            DB::statement($query3);
            return true;
        } catch (\Exception $e) {
            \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($e->getMessage(), 'Tenant Registration Exception Notification'));
            Log::error($e->getMessage());
        }

    }

    /**
     * Creates a new database schema.

    * @param  string $schemaName The new schema name.
    * @return bool
    */
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
            Log::notice('New Tenant DB Setup & registration ('.$this->tenant_id.')' . Artisan::output());

            return true;
        } catch (\Exception $e) {
            \Notification::route('mail', 'admin@trach.io')->notify(new StandardNotification($e->getMessage(), 'Tenant Registration Exception Notification'));
            Log::error($e->getMessage());
        }
    }

}
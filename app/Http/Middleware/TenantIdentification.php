<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Config;
use DB;
use Session;
use App\User;
use App\Models\Override\TenantDatabaseNotification;
use App\Tenant;
use App\TenantSetting;

class TenantIdentification
{
    public function handle($request, Closure $next)
    {
    //    See here https://divinglaravel.com/understanding-how-laravel-configures-database-connections
    //    & Here https://stackoverflow.com/questions/42762180/laravel-model-not-using-assigned-connection-second-connection-in-a-multi-tenan

        $userTenant = User::with('tenant')->find(Auth::id())->tenant;
        $userRoleId = User::find(Auth::id())->role_id;

        \Config::set(['database.connections.tenant.database' => $userTenant->host]);
        \Config::set(['database.connections.tenant.username' => $userTenant->username]);
        \Config::set(['database.connections.tenant.password' => $userTenant->password]);
        \Config::set(['database.connections.tenant.database' => $userTenant->database]);

        $timezone = TenantSetting::select('timezone', 'timezone_offset')->first();
        Session::put('tenant_id', $userTenant->id);
        Session::put('role_id', $userRoleId);
        Session::put('timezone', $timezone->timezone);
        Session::put('timezone_offset', $timezone->timezone_offset);
        Config::set('app.timezone', $timezone->timezone);

        DB::purge('tenant');

        DB::reconnect('tenant');

        return $next($request);
    }
}
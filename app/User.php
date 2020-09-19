<?php

namespace App;

use App\Role;
use App\Shift;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Override\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, SoftDeletes, Billable;

    protected $connection = 'mysql';

    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'last_login_ip', 'tenant_user_id', 'active_status', 'tenant_id', 'role_id', 'trial_ends_at', 'plan_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'trial_ends_at',
    ];

    protected $with = ['plan'];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

}

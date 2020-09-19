<?php

namespace App;

use App\Role;
use App\Shift;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantUser extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'users';
    protected $with = ['plan'];

    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'last_login_ip', 'active_status',  'role_id', 'plan_id', 'tenant_id',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

}

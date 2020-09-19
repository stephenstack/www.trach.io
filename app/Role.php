<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tenantusers()
    {
        return $this->hasMany(TenantUser::class, 'role_id');
    }

}

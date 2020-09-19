<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantSetting extends Model
{
    protected $fillable = ['timezone'];
    protected $connection = 'tenant';

}

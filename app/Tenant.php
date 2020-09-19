<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes;

    protected $casts = [
        'id' => 'string'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

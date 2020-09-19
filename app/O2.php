<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class O2 extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        O2::observe(new \App\Observers\UserActionsObserver);
    }

    protected $connection = 'tenant';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

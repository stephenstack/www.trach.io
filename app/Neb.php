<?php

namespace App;

use Config;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Neb extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        Neb::observe(new \App\Observers\UserActionsObserver);
    }

    protected $connection = 'tenant';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


}

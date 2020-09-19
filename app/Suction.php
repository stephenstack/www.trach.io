<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suction extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        Suction::observe(new \App\Observers\UserActionsObserver);
    }


    protected $guarded = [];
    protected $connection = 'tenant';

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Med extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        Med::observe(new \App\Observers\UserActionsObserver);
    }

    protected $connection = 'tenant';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

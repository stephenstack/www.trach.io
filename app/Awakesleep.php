<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Awakesleep extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        Awakesleep::observe(new \App\Observers\UserActionsObserver);
    }

    protected $guarded = [];
    protected $connection = 'tenant';

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

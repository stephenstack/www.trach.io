<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cough extends BaseModel
{
    public static function boot()
    {
        parent::boot();
        Cough::observe(new \App\Observers\UserActionsObserver);
    }

    protected $guarded = [];
    protected $connection = 'tenant';

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

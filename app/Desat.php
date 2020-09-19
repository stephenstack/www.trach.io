<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desat extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        Desat::observe(new \App\Observers\UserActionsObserver);
    }


    protected $connection = 'tenant';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

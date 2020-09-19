<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteComment extends BaseModel
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        NoteComment::observe(new \App\Observers\UserActionsObserver);
    }

    protected $guarded = [];
    protected $connection = 'tenant';

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

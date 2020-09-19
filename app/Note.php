<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();
        Note::observe(new \App\Observers\UserActionsObserver);
    }


    protected $guarded = [];
    protected $connection = 'tenant';

    public function category()
    {
        return $this->belongsTo(NoteCategory::class, 'notecategory_id');
    }

    public function comments()
    {
        return $this->hasMany('App\NoteComment');
    }

}

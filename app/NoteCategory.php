<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteCategory extends BaseModel
{
    protected $guarded = [];
    protected $connection = 'tenant';

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

}

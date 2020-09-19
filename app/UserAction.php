<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAction extends BaseModel
{
    protected $connection = 'tenant';
    protected $fillable = ['user_id', 'shift_id', 'action', 'action_model', 'action_id'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
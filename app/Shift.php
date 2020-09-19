<?php

namespace App;

use App\ShiftTask;
use Illuminate\Database\Eloquent\Model;

class Shift extends BaseModel
{

    public static function boot()
    {
        parent::boot();
        Shift::observe(new \App\Observers\UserActionsObserver);
    }

    protected $fillable = ['user_id', 'time_in', 'expected_timeout', 'actual_time_out', 'status'];
    protected $connection = 'tenant';
    protected $casts = [
        'status' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shift_task()
    {
        return $this->belongsTo(ShiftTask::class, 'shift_id');
    }

}

<?php

namespace App;

use App\Shift;
use Illuminate\Database\Eloquent\Model;

class ShiftTask extends BaseModel
{
    public static function boot()
    {
        parent::boot();
        ShiftTask::observe(new \App\Observers\UserActionsObserver);
    }

    protected $fillable = ['shift_id', 'antibiotic', 'hospital_illness', 'vent_ipap', 'vent_epap', 'vent_rate'];
    protected $connection = 'tenant';

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

}

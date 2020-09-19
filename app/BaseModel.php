<?php
namespace App;

use Config;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
	/******************
	 * Common properties, accessors and mutators here */


    public function getCreatedAtAttribute($value)
    {

        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(Config::get('app.timezone'))
            ->toDateTimeString();
    }

    public function getUpdatedAtAttribute($value)
    {

        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(Config::get('app.timezone'))
            ->toDateTimeString();
    }

}